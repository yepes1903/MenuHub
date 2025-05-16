<?php
session_start();
include("connection.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['item_id']) || !isset($data['quantity'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

$item_id = (int)$data['item_id'];
$quantity = (int)$data['quantity'];

try {
    // Get menu item details
    $stmt = $conn->prepare("SELECT * FROM menu_items WHERE id = ?");
    $stmt->execute([$item_id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        // If no item in database, use sample data
        $sample_items = [
            1 => ['id' => 1, 'name' => 'Bruschetta', 'price' => 8.99],
            2 => ['id' => 2, 'name' => 'Carpaccio', 'price' => 12.99],
            3 => ['id' => 3, 'name' => 'Spaghetti Carbonara', 'price' => 16.99],
            4 => ['id' => 4, 'name' => 'Fettuccine Alfredo', 'price' => 15.99],
            5 => ['id' => 5, 'name' => 'Margherita', 'price' => 14.99],
            6 => ['id' => 6, 'name' => 'Quattro Formaggi', 'price' => 17.99]
        ];
        
        if (!isset($sample_items[$item_id])) {
            http_response_code(404);
            echo json_encode(['error' => 'Item not found']);
            exit;
        }
        
        $item = $sample_items[$item_id];
    }

    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add or update item in cart
    $cart_item = [
        'id' => $item['id'],
        'name' => $item['name'],
        'price' => $item['price'],
        'quantity' => $quantity
    ];

    // Check if item already exists in cart
    $found = false;
    foreach ($_SESSION['cart'] as &$existing_item) {
        if ($existing_item['id'] === $item['id']) {
            $existing_item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = $cart_item;
    }

    // Calculate cart totals
    $total_items = 0;
    $total_price = 0;
    foreach ($_SESSION['cart'] as $cart_item) {
        $total_items += $cart_item['quantity'];
        $total_price += $cart_item['price'] * $cart_item['quantity'];
    }

    echo json_encode([
        'success' => true,
        'message' => 'Item added to cart',
        'cart_count' => $total_items,
        'cart_total' => $total_price
    ]);

} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
