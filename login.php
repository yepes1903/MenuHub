<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar</title>
    <link rel="icon" type="image/png" href="images/si.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style1.css">
</head>
<body class="login-body">
    <div class="background-animation"></div>
    <div class="login-container">
        <div class="login-wrapper">
            <div class="login-form">
                <div class="login-header">
                    <h1>¡Bienvenido!</h1>
                    <p>Inicia sesión para continuar</p>
                </div>

                <?php
                include "connection.php";

                if (isset($_POST['login'])) {
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $pass = $_POST['password'];

                    $sql = "SELECT * FROM users WHERE email='$email'";
                    $res = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($res) > 0) {
                        $row = mysqli_fetch_assoc($res);
                        $password = $row['password'];

                        if (password_verify($pass, $password)) {
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['username'] = $row['username'];
                            header("location: home.php");
                            exit();
                        } else {
                            echo "<div class='message'>Contraseña Incorrecta</div>";
                        }
                    } else {
                        echo "<div class='message'>Correo o Contraseña Inválidos</div>";
                    }
                }
                ?>

                <form action="#" method="POST">
                    <div class="form-box">
                        <div class="input-container">
                            <i class="fa fa-envelope icon"></i>
                            <input 
                                class="input-field" 
                                type="email" 
                                placeholder="Correo Electrónico" 
                                name="email" 
                                required
                            >
                        </div>
                        
                        <div class="input-container">
                            <i class="fa fa-lock icon"></i>
                            <input 
                                class="input-field password" 
                                type="password" 
                                placeholder="Contraseña" 
                                name="password" 
                                required
                            >
                            <i class="fa fa-eye-slash toggle icon"></i>
                        </div>

                        <div class="remember">
                            <div>
                                <input type="checkbox" class="check" name="remember_me">
                                <label for="remember">Recuérdame</label>
                            </div>
                      
                            <span><a href="#" >¿Olvidaste tu contraseña?</a></span>
           
                        </div>
                    </div>
                    <center>
                        <input 
                            type="submit" 
                            name="login" 
                            id="submit" 
                            value="Iniciar Sesión" 
                            class="btn"
                        >
                    </center>
                  <br>
                    <div class="links">
                        ¿No tienes una cuenta?  <a href="signup.php">Regístrate</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    const toggle = document.querySelector(".toggle"),
      input = document.querySelector(".password");
    toggle.addEventListener("click", () => {
      if (input.type === "password") {
        input.type = "text";
        toggle.classList.replace("fa-eye", "fa-eye-slash");
      } else {
        input.type = "password";
        toggle.classList.replace("fa-eye-slash", "fa-eye");
      }
    })
    
    </script>
</body>
</html>