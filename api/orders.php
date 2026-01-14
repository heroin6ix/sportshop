<?php // order history
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonResponse(['error' => 'Method not allowed'], 405);
}

$userId = $_GET['user_id'] ?? null;

if (!$userId) {
    jsonResponse(['error' => 'User ID is required'], 400);
}

$stmt = $pdo->prepare("
    SELECT ID_Orders, OrderDate, Status, TotalAmount, Address
    FROM Orders
    WHERE Users_ID = ?
    ORDER BY OrderDate DESC
");
$stmt->execute([$userId]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

jsonResponse($orders);