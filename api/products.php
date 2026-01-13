<?php // catalog products   
require_once 'config.php';

$stmt = $pdo->query("
    SELECT ID_Products, ProductName, Price, Stocks
    FROM Products"
);

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

jsonResponse($products);