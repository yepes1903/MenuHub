<?php
require 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review_id']) && isset($_POST['action'])) {
    $review_id = (int)$_POST['review_id'];
    $action = $_POST['action'];
    
    try {
        if ($action === 'increment') {
            $stmt = $conn->prepare("UPDATE resenas SET util_count = util_count + 1 WHERE id = ?");
        } elseif ($action === 'decrement') {
            $stmt = $conn->prepare("UPDATE resenas SET util_count = util_count - 1 WHERE id = ?");
        } else {
            throw new Exception("Acción no válida");
        }
        
        $stmt->execute([$review_id]);
        
        // Obtener el nuevo conteo
        $stmt = $conn->prepare("SELECT util_count FROM resenas WHERE id = ?");
        $stmt->execute([$review_id]);
        $new_count = $stmt->fetchColumn();
        
        echo json_encode(['success' => true, 'new_count' => $new_count]);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Solicitud no válida']);
}
?>