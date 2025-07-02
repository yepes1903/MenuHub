<?php
session_start();
<<<<<<< HEAD
include "connection.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $pass = $_POST['password'];

    if ($conn) {
        $stmt = mysqli_prepare($conn, "SELECT id, username, password FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($pass, $row['password'])) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                header("location: home.php");
                exit();
            } else {
                $mensaje = "Contraseña incorrecta";
            }
        } else {
            $mensaje = "Correo o contraseña inválidos";
        }
    } else {
        $mensaje = "Error de conexión con la base de datos.";
    }
}
?>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="success-message">
            <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            ?>
        </div>
    <?php endif; ?>

<?php
$aviso = $_GET['aviso'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - MenuHub</title>
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

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            background: var(--gray-50);
        }
        
        .success-message {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #d4edda;
            border-bottom: 2px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            text-align: center;
            font-family: 'Montserrat', sans-serif;
            z-index: 1000;
        }

        .login-container {
            width: 100%;
            max-width: 500px;
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

        .remember {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 20px;
            color: var(--light-text);
        }

        .remember .check {
            margin-right: 10px;
            accent-color: var(--accent-color);
        }

        .remember a {
            color: var(--accent-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .remember a:hover {
            color: var(--primary-color);
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
                <h1>¡Bienvenido a <span style="color: var(--accent-color);">MenuHub</span>!</h1>
                <p>Inicia sesión para continuar</p>
            </div>

            <?php if (!empty($mensaje)): ?>
                <div class="message"><?= htmlspecialchars($mensaje) ?></div>
            <?php endif; ?>


            <?php if ($aviso === 'requiere_login'): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                ⚠️ Debes iniciar sesión o crear una cuenta para acceder a esta sección.
            </div>
            <?php endif; ?>

            <form action="#" method="POST" autocomplete="off">
                <div class="input-container">
                    <div class="icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input 
                        class="input-field" 
                        type="email" 
                        placeholder="Correo Electrónico" 
                        name="email" 
                        required
                    >
                </div>
                
                <div class="input-container">
                    <div class="icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input 
                        class="input-field password" 
                        type="password" 
                        placeholder="Contraseña" 
                        name="password" 
                        required
                    >
                    <div class="icon" style="border-radius: 0 10px 10px 0; cursor: pointer;">
                        <i class="fas fa-eye-slash toggle"></i>
                    </div>
                </div>

                <div class="remember">
                    <div>
                        <input type="checkbox" class="check" name="remember_me">
                        <label>Recuérdame</label>
                    </div>
                    <a href="recover-password.php">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" name="login" class="btn">
                    Iniciar Sesión
                </button>

                <div class="links">
                    ¿No tienes una cuenta? <a href="signup.php">Regístrate</a>
                </div> <br>
                <div class="links">
                    O si quieres seguir viendo la pagina puedes <a href="index.php">Volver</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const toggle = document.querySelector(".toggle");
        const input = document.querySelector(".password");
        
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
=======
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="icon" type="images/png" href="images/R.png">
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container">
    <div class="form-box box">

      <?php
      include "connection.php";

      if (isset($_POST['login'])) {

        $email = $_POST['email'];
        $pass = $_POST['password'];

        $sql = "select * from users where email='$email'";

        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {

          $row = mysqli_fetch_assoc($res);

          $password = $row['password'];

          $decrypt = password_verify($pass, $password);


          if ($decrypt) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("location: home.php");


          } else {
            echo "<div class='message'>
                    <p>Contraseña Incorrecta</p>
                    </div><br>";

            echo "<a href='login.php'><button class='btn'>Volver</button></a>";
          }

        } else {
          echo "<div class='message'>
                    <p>Revise si el Email o la contraseña son correctos</p>
                    </div><br>";

          echo "<a href='login.php'><button class='btn'>Volver</button></a>";

        }


      } else {


        ?>

        <header>Logueate</header>
        <hr>
        <form action="#" method="POST">

          <div class="form-box">


            <div class="input-container">
              <i class="fa fa-envelope icon"></i>
              <input class="input-field" type="email" placeholder="Correo Electronico" name="email">
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field password" type="password" placeholder="Contraseña" name="password">
              <i class="fa fa-eye toggle icon"></i>
            </div>

            <div class="remember">
              <input type="checkbox" class="check" name="remember_me">
              <label for="remember">Recuerdame</label>
            </div>

          </div>

          <center><input type="submit" name="login" id="submit" value="Logueate" class="btn"></center>

          <div class="links">
            No tienes una cuenta? <a href="signup.php">Registrate</a>
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
