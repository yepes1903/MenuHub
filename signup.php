<?php
    session_start();
    include "connection.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="icon" type="image/png" href="images/si.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    .btn-container {
        display: flex;
        justify-content: center;
    }
    .btn {
      border-radius: 30px;
      color: #fff;
      border: none;
      background-color: var(--primary-color);
      height: 60px;
      width: 220px;
      transition: 0.5s;
      cursor: pointer;
      font-size: 16px;
      text-transform: capitalize;
      position: relative;
      overflow: hidden;
    }
    .btn:hover {
      transform: translateY(-3px);
    background-color: #fff;
    border: 1px solid var(--primary-color);
    color: var(--primary-color);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .message {
        text-align: center;
        font-size: 16px;
    }
    .links {
        text-align: center;
        margin-top: 20px;
    }
  </style>
</head>

<body class="login-body">
  <div class="background-animation"></div>
  <div class="login-container">
    <div class="login-wrapper">
      <div class="login-form">
        <div class="login-header">
          <h1>Registrate</h1>
          <p>Crea una cuenta para continuar</p>
        </div>

        <?php
          if (isset($_POST['register'])) {
            $name = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $cpass = $_POST['cpass'];

            $check = "SELECT * FROM users WHERE email='{$email}'";
            $res = mysqli_query($conn, $check);
            $passwd = password_hash($pass, PASSWORD_DEFAULT);
            $key = bin2hex(random_bytes(12));

            if (mysqli_num_rows($res) > 0) {
              echo "<div class='message'>
                <p>Este correo ya está en uso, utiliza otro por favor!</p>
              </div><br>";
              echo "<div class='btn-container'>
                    <a href='javascript:self.history.back()'><button class='btn'>Volver</button></a>
                  </div>";
            } else {
              if ($pass === $cpass) {
                $sql = "INSERT INTO users(username,email,password) VALUES('$name','$email','$passwd')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                  echo "<div class='message'>
                    <p>¡Te registraste exitosamente!</p>
                  </div><br>";
                  echo "<div class='btn-container'>
                          <a href='login.php'><button class='btn'>Inicia sesión</button></a>
                        </div>";
                } else {
                  echo "<div class='message'>
                      <p>Hubo un error al registrar el usuario.</p>
                    </div><br>";
                  echo "<div class='btn-container'>
                          <a href='javascript:self.history.back()'><button class='btn'>Volver</button></a>
                        </div>";
                }
              } else {
                echo "<div class='message'>
                  <p>Las contraseñas no coinciden.</p>
                </div><br>";
                echo "<div class='btn-container'>
                        <a href='signup.php'><button class='btn'>Volver a intentar</button></a>
                      </div>";
              }
            }
          } else {
        ?>

        <form action="#" method="POST">
          <div class="form-box">
            <div class="input-container">
              <i class="fa fa-user icon"></i>
              <input class="input-field" type="text" placeholder="Usuario" name="username" required>
            </div>

            <div class="input-container">
              <i class="fa fa-envelope icon"></i>
              <input class="input-field" type="email" placeholder="Correo Electrónico" name="email" required>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field password" type="password" placeholder="Contraseña" name="password" required>
              <i class="fa fa-eye-slash toggle icon"></i>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field" type="password" placeholder="Confirmar Contraseña" name="cpass" required>
            </div>
          </div>

          <div class="btn-container">
            <input type="submit" name="register" id="submit" value="Registrar" class="btn">
          </div>
          <div class="links">
            ¿Ya tienes una cuenta? <a href="login.php">Inicia Sesión</a>
          </div>
        </form>

        <?php } ?>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const background = document.querySelector('.background-animation');
      
      function createParticle() {
          const particle = document.createElement('div');
          particle.classList.add('particle');
          
          // Tamaño aleatorio
          const size = Math.random() * 10 + 2;
          particle.style.width = `${size}px`;
          particle.style.height = `${size}px`;
          
          // Posición horizontal aleatoria
          particle.style.left = `${Math.random() * 100}%`;
          
          // Estilo aleatorio
          particle.style.background = `rgba(255,255,255,${Math.random() * 0.3 + 0.1})`;
          
          // Animación
          particle.style.animation = `particleAnimation ${Math.random() * 10 + 5}s linear infinite`;
          
          background.appendChild(particle);
          
          // Eliminar la partícula después de la animación
          setTimeout(() => {
              particle.remove();
          }, 15000);
      }
      
      // Crear partículas cada 200ms
      setInterval(createParticle, 200);
    });

    const toggle = document.querySelector(".toggle"),
      input = document.querySelector(".password");
    toggle.addEventListener("click", () => {
      if (input.type === "password") {
        input.type = "text";
        toggle.classList.replace("fa-eye-slash", "fa-eye");
      } else {
        input.type = "password";
        toggle.classList.replace("fa-eye", "fa-eye-slash");
      }
    });
  </script>
</body>

</html>
