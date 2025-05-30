<<<<<<< HEAD
<?php
    session_start();
    include "connection.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - MenuHub</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #1e40af;
            --accent-color: #3b82f6;
            --text-color: #1e293b;
            --light-text: #64748b;
            --white: #ffffff;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-400: #94a3b8;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            overflow: hidden;
            z-index: -1;
        }

        .background-animation::before,
        .background-animation::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.5;
        }

        .background-animation::before {
            background: radial-gradient(circle at 20% 70%, rgba(255,255,255,0.3) 0%, transparent 50%);
            animation: moveGradient 15s ease infinite;
        }

        .background-animation::after {
            background: radial-gradient(circle at 80% 30%, rgba(255,255,255,0.2) 0%, transparent 60%);
            animation: moveGradient 20s ease-in-out infinite alternate;
        }

        @keyframes moveGradient {
            0% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.2) rotate(180deg); }
            100% { transform: scale(1) rotate(360deg); }
        }

        @keyframes particleAnimation {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.7;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            background: var(--gray-50);
        }

        .login-container {
            width: 100%;
            max-width: 650px;
            z-index: 10;
        }

        .login-wrapper {
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 25px 45px rgba(0,0,0,0.1);
            padding: 40px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        .login-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 50px rgba(0,0,0,0.15);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            color: var(--text-color);
            font-size: 28px;
            margin-bottom: 10px;
        }

        .login-header p {
            color: var(--light-text);
            font-size: 16px;
        }

        .input-container {
            display: flex;
            width: 100%;
            margin-bottom: 20px;
            position: relative;
        }

        .icon {
            padding: 15px;
            background: var(--gray-100);
            color: var(--accent-color);
            min-width: 50px;
            text-align: center;
            border-radius: 10px 0 0 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-field {
            width: 100%;
            padding: 15px;
            border: 2px solid var(--gray-200);
            border-left: none;
            border-radius: 0 10px 10px 0;
            font-size: 16px;
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--accent-color);
        }

        .toggle.icon {
            border-radius: 0 10px 10px 0;
            cursor: pointer;
            border-left: none;
        }

        .btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 10px;
            background: var(--accent-color);
            color: var(--white);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }

        .links {
            text-align: center;
            margin-top: 20px;
            color: var(--light-text);
            font-size: 14px;
        }

        .links a {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .links a:hover {
            color: var(--primary-color);
        }

        .message {
            text-align: center;
            background: var(--gray-100);
            color: var(--text-color);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid var(--accent-color);
        }

        .btn-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        @media (max-width: 600px) {
            .login-wrapper {
                padding: 20px;
            }

            .login-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="background-animation"></div>
    <div class="login-container">
        <div class="login-wrapper">
            <div class="login-header">
                <h1>Únete a <span style="color: var(--accent-color);">MenuHub</span></h1>
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

                if (mysqli_num_rows($res) > 0) {
                    echo "<div class='message'>
                        <p>Este correo ya está en uso, utiliza otro por favor!</p>
                    </div>";
                    echo "<div class='btn-container'>
                        <a href='javascript:self.history.back()'><button class='btn'>Volver</button></a>
                    </div>";
                } else {
                    if ($pass === $cpass) {
                        $sql = "INSERT INTO users(username,email,password) VALUES('$name','$email','$passwd')";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            echo "<div class='message' style='border-left-color: #22c55e;'>
                                <p>¡Te registraste exitosamente!</p>
                            </div>";
                            echo "<div class='btn-container'>
                                <a href='login.php'><button class='btn'>Iniciar sesión</button></a>
                            </div>";
                        } else {
                            echo "<div class='message' style='border-left-color: #ef4444;'>
                                <p>Hubo un error al registrar el usuario.</p>
                            </div>";
                            echo "<div class='btn-container'>
                                <a href='javascript:self.history.back()'><button class='btn'>Volver</button></a>
                            </div>";
                        }
                    } else {
                        echo "<div class='message' style='border-left-color: #ef4444;'>
                            <p>Las contraseñas no coinciden.</p>
                        </div>";
                        echo "<div class='btn-container'>
                            <a href='javascript:self.history.back()'><button class='btn'>Volver a intentar</button></a>
                        </div>";
                    }
                }
            } else {
            ?>

            <form action="#" method="POST">
                <div class="input-container">
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <input class="input-field" type="text" placeholder="Usuario" name="username" required>
                </div>

                <div class="input-container">
                    <div class="icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input class="input-field" type="email" placeholder="Correo Electrónico" name="email" required>
                </div>

                <div class="input-container">
                    <div class="icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input class="input-field password" type="password" placeholder="Contraseña" name="password" required>
                    <div class="icon toggle">
                        <i class="fas fa-eye-slash"></i>
                    </div>
                </div>

                <div class="input-container">
                    <div class="icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input class="input-field" type="password" placeholder="Confirmar Contraseña" name="cpass" required>
                </div>

                <button type="submit" name="register" class="btn">
                    Crear Cuenta
                </button>

                <div class="links">
                    ¿Ya tienes una cuenta? <a href="login.php">Inicia Sesión</a>
                </div>
            </form>

            <?php } ?>
        </div>
    </div>

    <script>
        // Animación de partículas
        document.addEventListener('DOMContentLoaded', () => {
            const background = document.querySelector('.background-animation');
            
            function createParticle() {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                const size = Math.random() * 10 + 2;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.background = `rgba(255,255,255,${Math.random() * 0.3 + 0.1})`;
                particle.style.animation = `particleAnimation ${Math.random() * 10 + 5}s linear infinite`;
                
                background.appendChild(particle);
                
                setTimeout(() => {
                    particle.remove();
                }, 15000);
            }
            
            setInterval(createParticle, 200);
        });

        // Toggle de contraseña
        const toggle = document.querySelector(".toggle"),
            input = document.querySelector(".password");
        
        toggle.addEventListener("click", () => {
            if (input.type === "password") {
                input.type = "text";
                toggle.querySelector("i").classList.replace("fa-eye-slash", "fa-eye");
            } else {
                input.type = "password";
                toggle.querySelector("i").classList.replace("fa-eye", "fa-eye-slash");
            }
        });
    </script>
</body>
</html>
=======
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
  <div class="container">
    <div class="form-box box">


      <header>Registrate</header>
      <hr>

      <form action="#" method="POST">


        <div class="form-box">

          <?php

          session_start();

          include "connection.php";

          if (isset($_POST['register'])) {

            $name = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $cpass = $_POST['cpass'];


            $check = "select * from users where email='{$email}'";

            $res = mysqli_query($conn, $check);

            $passwd = password_hash($pass, PASSWORD_DEFAULT);

            $key = bin2hex(random_bytes(12));




            if (mysqli_num_rows($res) > 0) {
              echo "<div class='message'>
        <p>This email is used, Try another One Please!</p>
        </div><br>";

              echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";


            } else {

              if ($pass === $cpass) {

                $sql = "insert into users(username,email,password) values('$name','$email','$passwd')";

                $result = mysqli_query($conn, $sql);

                if ($result) {

                  echo "<div class='message'>
      <p>You are register successfully!</p>
      </div><br>";

                  echo "<a href='login.php'><button class='btn'>Login Now</button></a>";

                } else {
                  echo "<div class='message'>
        <p>This email is used, Try another One Please!</p>
        </div><br>";

                  echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
                }

              } else {
                echo "<div class='message'>
      <p>Password does not match.</p>
      </div><br>";

                echo "<a href='signup.php'><button class='btn'>Go Back</button></a>";
              }
            }
          } else {

            ?>

            <div class="input-container">
              <i class="fa fa-user icon"></i>
              <input class="input-field" type="text" placeholder="Usuario" name="username" required>
            </div>

            <div class="input-container">
              <i class="fa fa-envelope icon"></i>
              <input class="input-field" type="email" placeholder="Correo Electronico" name="email" required>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field password" type="password" placeholder="Contraseña" name="password" required>
              <i class="fa fa-eye icon toggle"></i>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field" type="password" placeholder="Confirmar Contraseña" name="cpass" required>
              <i class="fa fa-eye icon"></i>
            </div>

          </div>


          <center><input type="submit" name="register" id="submit" value="Registrar" class="btn"></center>


          <div class="links">
            Ya tiene una cuenta? <a href="login.php">Inicie Sesion</a>
          </div>

        </form>
      </div>
      <?php
          }
          ?>
  </div>

  <script>
    const toggle = document.querySelector(".toggle"),
      input = document.querySelector(".password");
    toggle.addEventListener("click", () => {
      if (input.type === "password") {
        input.type = "text";
        toggle.classList.replace("fa-eye-slash", "fa-eye");
      } else {
        input.type = "password";
      }
    })
  </script>
</body>

</html>
>>>>>>> 8b75c44c7f26b56c2e4a3f1f5f8c993fc734508d
