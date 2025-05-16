<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (!$email) {
        $_SESSION['error'] = "Por favor, ingresa un correo electrónico válido.";
        header("Location: recover-password.php");
        exit();
    }

    try {
        // Check if email exists in database
        $stmt = $conn->prepare("SELECT id, username FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user) {
            // Generate a unique token
            $token = bin2hex(random_bytes(32));
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            // First check if password_resets table exists
            $table_check = $conn->query("SHOW TABLES LIKE 'password_resets'");
            if ($table_check->num_rows == 0) {
                // Table doesn't exist, create it
                $sql = "CREATE TABLE IF NOT EXISTS password_resets (
                    id INT PRIMARY KEY AUTO_INCREMENT,
                    user_id INT NOT NULL,
                    token VARCHAR(64) NOT NULL,
                    expiry DATETIME NOT NULL,
                    used BOOLEAN DEFAULT 0,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (user_id) REFERENCES users(id)
                )";
                $conn->query($sql);
            }
            
            // Store the token
            $stmt = $conn->prepare("INSERT INTO password_resets (user_id, token, expiry) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $user['id'], $token, $expiry);
            $stmt->execute();
            $stmt->close();
            
            // In a real application, you would send an email here with the reset link
            // For demonstration, we'll just show a success message
            $_SESSION['success'] = "Si hay un correo gmail valido para esta cuenta.";
            
            // For testing purposes, create a direct link
            $_SESSION['reset_link'] = "reset-password.php?token=" . $token;
            
        } else {
            $_SESSION['error'] = "No se encontró ninguna cuenta con ese correo electrónico.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error al procesar la solicitud: " . $e->getMessage();
    }
    
    header("Location: recover-password.php");
    exit();
} else {
    // If someone tries to access this file directly without POST data
    header("Location: recover-password.php");
    exit();
}
?>
