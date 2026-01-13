<?php // making an order
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['error' => 'Method not allowed'], 405);
}

$data = json_decode(file_get_contents('php://input'), true); //get order data

$userId = $data['user_id'] ?? null;
$address = $data['address'] ?? '';
$items = $data['items'] ?? [];

if (!$userId || empty($items)) {
    jsonResponse(['error' => 'Invalid order data'], 400);
}

$pdo ->beginTransaction();

try {
    $total = 0;

    foreach ($items as $item) { // calculate total amount
        $stmt = $pdo->prepare("SELECT Price FROM Products WHERE ID_Products = ?");
        $stmt->execute([$item['product_id']]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        $total += $product['Price'] * $item['qty'];
    }
    // create order
    $stmt = $pdo->prepare("
        INSERT INTO Orders (Users_ID, OrderDate, Status, TotalAmount, Address)
        VALUES (?, NOW(), 'pending', ?, ?)
    ");
    $stmt->execute([$userId, $total, $address]);
    $orderId = $pdo->lastInsertId();

    foreach ($items as $item) { // add into OrderItem
        $stmt = $pdo->prepare("
            INSERT INTO OrderItem (Orders_ID, Products_ID, Quantity)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$orderId, $item['product_id'], $item['qty']]);
    }

    $pdo ->commit();
    jsonResponse(['success' => true, 'order_id' => $orderId]);

} 
catch (Exception $e) {
    $pdo->rollBack();

    jsonResponse([
        'error' => 'Order failed',
        'debug' => $e->getMessage()
    ], 500);
}
