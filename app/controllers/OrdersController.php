<?php

require "app/models/Orders.php";

class OrdersController {

    public function success() {
        require "app/views/orders/success.php";
    }

    public function index() {
         global $pdo;

        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $userId = $_SESSION['user_id'];

        $stmt = $pdo->prepare("SELECT ID_Orders, OrderDate, Status, TotalAmount,
            PaymentMethod, Address, Comment FROM Orders where Users_ID = ? Order By OrderDate DESC");
        $stmt->execute([$userId]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        
        $pageTitle = "Мои заказы";
        require "app/views/orders/index.php";
    }
}
