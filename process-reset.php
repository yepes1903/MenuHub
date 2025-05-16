<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    try {
        // Validate passwords match
        if ($password !== $confirm_password) {
            $_SESSION['error'] = "Las contraseñas no coinciden.";
            header("Location: reset-password.php?token=" . urlencode($token));
            exit();
        }

        // Validate password strength
        if (strlen($password) < 8) {
            $_SESSION['error'] = "La contraseña debe tener al menos 8 caracteres.";
            header("Location: reset-password.php?token=" . urlencode($token));
            exit();
        }

        // Check if token exists and is valid
        $stmt = $conn->prepare("SELECT user_id, expiry FROM password_resets WHERE token = ? AND used = 0");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $reset = $result->fetch_assoc();
        $stmt->close();

        if ($reset && strtotime($reset['expiry']) > time()) {
            // Hash the new password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Update the user's password
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $hashed_password, $reset['user_id']);
            $stmt->execute();
            $stmt->close();
            
            // Mark the token as used
            $stmt = $conn->prepare("UPDATE password_resets SET used = 1 WHERE token = ?");
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $stmt->close();
            
            $_SESSION['success'] = "Tu contraseña ha sido actualizada correctamente.";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['error'] = "El enlace de restablecimiento no es válido o ha expirado.";
            header("Location: recover-password.php");
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error al restablecer la contraseña: " . $e->getMessage();
        header("Location: reset-password.php?token=" . urlencode($token));
        exit();
    }
}
?>
