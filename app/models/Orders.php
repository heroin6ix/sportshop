<?php

class Orders {
    public static function calculateCartTotal() {
        $total = 0;

        global $pdo;
        foreach($_SESSION['cart'] as $productId => $qty) {
            $product = Products::findById($productId);
            if (!$product) continue;
            $total +=$product['Price'] * $qty;
        }
    }
    public static function all() {
        global $pdo;

        $stmt = $pdo->query("SELECT * FROM Orders");
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>