<?php
require '../../Connections/db.php';

// Procesar formulario de reseña
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-review'])) {
    $nombre = filter_input(INPUT_POST, 'reviewer-name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'reviewer-email', FILTER_VALIDATE_EMAIL);
    $calificacion = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
    $contenido = filter_input(INPUT_POST, 'review-text', FILTER_SANITIZE_STRING);
    
    if ($nombre && $email && $calificacion && $contenido) {
        try {
            $stmt = $conn->prepare("INSERT INTO resenas (nombre, email, calificacion, contenido) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nombre, $email, $calificacion, $contenido]);
            $resena_id = $conn->lastInsertId();
            
            // Procesar imágenes si se subieron
            if (!empty($_FILES['review-images']['name'][0])) {
                $uploadDir = '../../IMG/Resenas';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                foreach ($_FILES['review-images']['tmp_name'] as $key => $tmp_name) {
                    $fileName = uniqid() . '_' . basename($_FILES['review-images']['name'][$key]);
                    $targetPath = $uploadDir . $fileName;
                    
                    if (move_uploaded_file($tmp_name, $targetPath)) {
                        $stmt = $conn->prepare("INSERT INTO resenas_imagenes (resena_id, imagen_path) VALUES (?, ?)");
                        $stmt->execute([$resena_id, $targetPath]);
                    }
                }
            }
            
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } catch(PDOException $e) {
            $error = "Error al guardar la reseña: " . $e->getMessage();
            echo $error;
        }
    } else {
        $error = "Por favor completa todos los campos correctamente.";
    }
}

// Obtener reseñas de la base de datos
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'recientes';
$estrellas = isset($_GET['estrellas']) ? (int)$_GET['estrellas'] : 0;

$query = "SELECT * FROM resenas";
$params = [];

// Aplicar filtros
switch ($filtro) {
    case 'mejor':
        $query .= " ORDER BY calificacion DESC, fecha DESC";
        break;
    case 'peor':
        $query .= " ORDER BY calificacion ASC, fecha DESC";
        break;
    case 'imagenes':
        $query .= " WHERE id IN (SELECT DISTINCT resena_id FROM resenas_imagenes) ORDER BY fecha DESC";
        break;
    default:
        $query .= " ORDER BY fecha DESC";
}

if ($estrellas > 0 && $estrellas <= 5) {
    $query = strpos($query, 'WHERE') === false ? 
        $query . " WHERE calificacion = ?" : 
        $query . " AND calificacion = ?";
    $params[] = $estrellas;
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$resenas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener imágenes para cada reseña
foreach ($resenas as &$resena) {
    $stmt = $conn->prepare("SELECT imagen_path FROM resenas_imagenes WHERE resena_id = ?");
    $stmt->execute([$resena['id']]);
    $resena['imagenes'] = $stmt->fetchAll(PDO::FETCH_COLUMN);
}
unset($resena);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/style_resenas.css" />
    <title>Módulo de Reseñas</title>
</head>
<body>
    <div class="container">
        <section class="reviews-section">
            <h2 class="section-title">Opiniones de nuestros clientes</h2>

            <div class="filters">
                <div class="filter-group">
                    <span class="filter-label">Filtrar por:</span>
                    <select class="filter-select" id="filter-select">
                        <option value="recientes" <?= $filtro === 'recientes' ? 'selected' : '' ?>>Más recientes</option>
                        <option value="mejor" <?= $filtro === 'mejor' ? 'selected' : '' ?>>Mejor valorados</option>
                        <option value="peor" <?= $filtro === 'peor' ? 'selected' : '' ?>>Peor valorados</option>
                        <option value="imagenes" <?= $filtro === 'imagenes' ? 'selected' : '' ?>>Con imágenes</option>
                    </select>

                    <span class="filter-label">Estrellas:</span>
                    <select class="filter-select" id="stars-select">
                        <option value="0" <?= $estrellas === 0 ? 'selected' : '' ?>>Todas</option>
                        <option value="5" <?= $estrellas === 5 ? 'selected' : '' ?>>5 estrellas</option>
                        <option value="4" <?= $estrellas === 4 ? 'selected' : '' ?>>4 estrellas</option>
                        <option value="3" <?= $estrellas === 3 ? 'selected' : '' ?>>3 estrellas</option>
                        <option value="2" <?= $estrellas === 2 ? 'selected' : '' ?>>2 estrellas</option>
                        <option value="1" <?= $estrellas === 1 ? 'selected' : '' ?>>1 estrella</option>
                    </select>
                </div>

                <div class="search-container">
                    <span class="search-icon">🔍</span>
                    <input
                        type="text"
                        class="search-input"
                        placeholder="Buscar en las reseñas..."
                        id="search-input"
                    />
                </div>
            </div>

            <?php if (isset($error)): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <div class="reviews-container">
                <?php foreach ($resenas as $resena): ?>
                    <div class="review-card">
                        <div class="review-header">
                            <img
                                src="/api/placeholder/150/150"
                                alt="Avatar"
                                class="reviewer-avatar"
                            />
                            <div class="reviewer-info">
                                <div class="reviewer-name"><?= htmlspecialchars($resena['nombre']) ?></div>
                                <div class="review-date"><?= date('d \d\e F, Y', strtotime($resena['fecha'])) ?></div>
                            </div>
                        </div>

                        <div class="rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span class="star" <?= $i > $resena['calificacion'] ? 'style="color: #ddd"' : '' ?>>★</span>
                            <?php endfor; ?>
                        </div>

                        <p class="review-content">
                            <?= nl2br(htmlspecialchars($resena['contenido'])) ?>
                        </p>

                        <?php if (!empty($resena['imagenes'])): ?>
                            <div class="review-images">
                                <?php foreach ($resena['imagenes'] as $imagen): ?>
                                    <img
                                        src="<?= htmlspecialchars($imagen) ?>"
                                        alt="Imagen de reseña"
                                        class="review-image"
                                    />
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="review-actions">
                            <button class="helpful-btn" data-review-id="<?= $resena['id'] ?>">
                                👍 Útil <span class="helpful-count">(<?= $resena['util_count'] ?>)</span>
                            </button>
                            <button class="report-btn">🚩 Reportar</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="pagination">
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">4</button>
                <button class="page-btn">→</button>
            </div>

            <div class="add-review-container">
                <h3 class="form-title">Deja tu opinión</h3>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="reviewer-name">Nombre</label>
                        <input type="text" id="reviewer-name" name="reviewer-name" placeholder="Tu nombre" required />
                    </div>

                    <div class="form-group">
                        <label for="reviewer-email">Correo electrónico</label>
                        <input
                            type="email"
                            id="reviewer-email"
                            name="reviewer-email"
                            placeholder="tu@email.com"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label>Calificación</label>
                        <div class="star-rating-container">
                            <div class="star-rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span class="star" data-rating="<?= $i ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <span>Selecciona tu valoración</span>
                            <input type="hidden" name="rating" id="rating-value" value="5" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="review-text">Tu opinión</label>
                        <textarea
                            id="review-text"
                            name="review-text"
                            rows="5"
                            placeholder="Comparte tu experiencia con este producto..."
                            required
                        ></textarea>
                    </div>

                    <div class="form-group">
                        <label>Añadir imágenes (opcional)</label>
                        <div class="image-upload">
                            <div class="upload-preview">+</div>
                            <div class="upload-preview">+</div>
                            <div class="upload-preview">+</div>
                            <input type="file" class="upload-input" name="review-images[]" multiple accept="image/*">
                        </div>
                    </div>

                    <button type="submit" name="submit-review" class="submit-btn">Publicar reseña</button>
                </form>
            </div>
        </section>
    </div>

    <script>
        // Funcionalidad para el sistema de calificación por estrellas
        const stars = document.querySelectorAll(".star-rating .star");
        const ratingInput = document.getElementById("rating-value");

        stars.forEach((star, index) => {
            star.addEventListener("mouseover", () => {
                for (let i = 0; i <= index; i++) {
                    stars[i].style.color = "var(--orange-primary)";
                }
                for (let i = index + 1; i < stars.length; i++) {
                    stars[i].style.color = "#ddd";
                }
            });

            star.addEventListener("click", () => {
                const rating = star.dataset.rating;
                ratingInput.value = rating;
                star.dataset.selected = true;
                for (let i = 0; i < rating; i++) {
                    stars[i].dataset.selected = true;
                }
                for (let i = rating; i < stars.length; i++) {
                    stars[i].dataset.selected = false;
                }
            });
        });

        const starRating = document.querySelector(".star-rating");
        starRating.addEventListener("mouseout", () => {
            const selectedRating = ratingInput.value;
            stars.forEach((star, index) => {
                if (index < selectedRating) {
                    star.style.color = "var(--orange-primary)";
                } else {
                    star.style.color = "#ddd";
                }
            });
        });

        // Funcionalidad para la carga de imágenes
        const uploadPreviews = document.querySelectorAll(".upload-preview");
        const uploadInput = document.querySelector(".upload-input");

        uploadPreviews.forEach((preview) => {
            preview.addEventListener("click", () => {
                uploadInput.click();
            });
        });

        uploadInput.addEventListener("change", function() {
            const files = this.files;
            uploadPreviews.forEach((preview, index) => {
                if (files[index]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;border-radius:8px;">`;
                    }
                    reader.readAsDataURL(files[index]);
                }
            });
        });

        // Funcionalidad para los botones de útil
        const helpfulBtns = document.querySelectorAll(".helpful-btn");

        helpfulBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                const reviewId = btn.dataset.reviewId;
                const countSpan = btn.querySelector(".helpful-count");
                let count = parseInt(countSpan.textContent.replace(/[()]/g, ""));

                if (!btn.classList.contains("active")) {
                    // Incrementar contador en la base de datos
                    fetch('../../Connections/update_helpful.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `review_id=${reviewId}&action=increment`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            countSpan.textContent = `(${data.new_count})`;
                            btn.classList.add("active");
                            btn.style.color = "var(--orange-primary)";
                        }
                    });
                } else {
                    // Decrementar contador en la base de datos
                    fetch('../../Connections/update_helpful.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `review_id=${reviewId}&action=decrement`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            countSpan.textContent = `(${data.new_count})`;
                            btn.classList.remove("active");
                            btn.style.color = "#777";
                        }
                    });
                }
            });
        });

        // Funcionalidad para los filtros
        const filterSelect = document.getElementById("filter-select");
        const starsSelect = document.getElementById("stars-select");

        function applyFilters() {
            const filtro = filterSelect.value;
            const estrellas = starsSelect.value;
            window.location.href = `?filtro=${filtro}&estrellas=${estrellas}`;
        }

        filterSelect.addEventListener("change", applyFilters);
        starsSelect.addEventListener("change", applyFilters);

        // Funcionalidad para la búsqueda
        const searchInput = document.getElementById("search-input");
        searchInput.addEventListener("keypress", (e) => {
            if (e.key === "Enter") {
                const query = searchInput.value.trim();
                if (query) {
                    window.location.href = `search.php?q=${encodeURIComponent(query)}`;
                }
            }
        });

        // Animación para las tarjetas de reseñas
        const reviewCards = document.querySelectorAll(".review-card");

        function checkIfInView() {
            reviewCards.forEach((card) => {
                const rect = card.getBoundingClientRect();
                const isInView =
                    rect.top >= 0 &&
                    rect.left >= 0 &&
                    rect.bottom <=
                        (window.innerHeight || document.documentElement.clientHeight) &&
                    rect.right <=
                        (window.innerWidth || document.documentElement.clientWidth);

                if (isInView && !card.classList.contains("animated")) {
                    card.style.opacity = "1";
                    card.style.transform = "translateY(0)";
                    card.classList.add("animated");
                }
            });
        }

        window.addEventListener("scroll", checkIfInView);
        window.addEventListener("resize", checkIfInView);
        window.addEventListener("load", checkIfInView);
    </script>
</body>
</html>