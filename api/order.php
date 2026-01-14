<?php // work with one order
require_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];

/*--------------------------------------------------
    GET /api/order?id=30 - get details of one order
--------------------------------------------------*/
if ($method === 'GET') {
    $orderId = $_GET['id'] ?? null;

    if (!$orderId) {
        jsonResponse(['error' => 'Order ID is required'], 400);
    }

    $stmt = $pdo->prepare("
        SELECT ID_Orders, OrderDate, Status, TotalAmount, Address, Comment
        FROM Orders 
        WHERE ID_Orders = ?
    ");
    $stmt->execute([$orderId]);
    $order = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($order)) {
        jsonResponse(['error' => 'Order not found'], 404);
    }

    // get order items
    $stmt = $pdo->prepare("
        SELECT p.ProductName, p.Price, oi.Quantity
        FROM OrderItem oi
        JOIN Products p ON oi.Products_ID = p.ID_Products
        WHERE oi.Orders_ID = ?
    ");
    $stmt->execute([$orderId]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    jsonResponse ([
        'order' => $order[0],
        'items' => $items
    ]);
}

/*--------------------------------------------------
    POST /api/order - create a new order
--------------------------------------------------*/
if ($method === 'POST') {
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

        // add into OrderItem
        foreach ($items as $item) { 
            $stmt = $pdo->prepare("
                INSERT INTO OrderItem (Orders_ID, Products_ID, Quantity)
                VALUES (?, ?, ?)
            ");
            $stmt->execute([$orderId, $item['product_id'], $item['qty']]);
        }

        $pdo ->commit();
        jsonResponse(['success' => true, 'order_id' => $orderId]);

    } catch (Exception $e) {
        $pdo->rollBack();
        jsonResponse([
            'error' => 'Order failed'], 500);
    }
}
jsonResponse(['error' => 'Method not allowed'], 405);