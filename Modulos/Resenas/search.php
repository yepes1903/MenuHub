<?php
require '../../Connections/db.php';

$query = isset($_GET['q']) ? $_GET['q'] : '';
$results = [];

if (!empty($query)) {
    $searchTerm = '%' . $query . '%';
    $stmt = $conn->prepare("SELECT * FROM resenas WHERE contenido LIKE ? OR nombre LIKE ? ORDER BY fecha DESC");
    $stmt->execute([$searchTerm, $searchTerm]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Obtener imágenes para cada reseña
    foreach ($results as &$resena) {
        $stmt = $conn->prepare("SELECT imagen_path FROM resenas_imagenes WHERE resena_id = ?");
        $stmt->execute([$resena['id']]);
        $resena['imagenes'] = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    unset($resena);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/style_resenas.css" />
    <title>Resultados de búsqueda</title>
</head>
<body>
    <div class="container">
        <section class="reviews-section">
            <h2 class="section-title">Resultados de búsqueda para "<?= htmlspecialchars($query) ?>"</h2>
            
            <?php if (empty($results)): ?>
                <p>No se encontraron reseñas que coincidan con tu búsqueda.</p>
            <?php else: ?>
                <div class="reviews-container">
                    <?php foreach ($results as $resena): ?>
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
            <?php endif; ?>
        </section>
    </div>
    
    <script src="script.js"></script>
</body>
</html>