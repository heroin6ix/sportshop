<?php

class CheckoutController {
    //Показать страничку
    public function index() {

        // Если корзина пустая — возвращаем в корзину
        if (empty($_SESSION['cart'])) {
            header("Location: /cart");
            exit;
        }

        $pageTitle = "Заказ";
        require "app/views/checkout.php";
    }
    //Создание заказа
    public function action() {
        if (empty($_SESSION['cart'])) {header("Location /cart"); exit; }

        global $pdo;

         $userId = $_SESSION['user_id'] ?? null;

        $address = $_POST['address'] ?? '';
        $payment = $_POST['payment'] ?? '';
        $comment = $_POST['comment'] ?? '';
        
        if ($address === '' || $payment === '' ) {
            echo "Заполните обязательные поля";
            return;
        }

        $pdo->beginTransaction();
        
        try {
            $total = 0;

            foreach($_SESSION['cart'] as $productId => $qty) {
                $stmt = $pdo->prepare("SELECT Price FROM Products where ID_Products = ?");
                $stmt->execute([$productId]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                $total += $product['Price'] * $qty;
            }
            //вставить запись в Orders
            $stmt = $pdo->prepare("INSERT INTO Orders (Users_ID, OrderDate, Status, TotalAmount, PaymentMethod, Address, Comment) 
                VALUES(?, NOW(), 'pending', ?, ?, ?, ? )");
            $stmt->execute([$userId, $total, $payment, $address, $comment]);

            $orderId = $pdo->lastInsertId();

            foreach ($_SESSION['cart'] as $productId => $qty) {
                $stmt = $pdo->prepare("INSERT INTO  OrderItem (Orders_ID, Products_ID, Quantity) VALUES(?, ?, ?)");
                $stmt->execute([$orderId, $productId, $qty]);

                //уменьшить stocks
                $stmt = $pdo->prepare("UPDATE Products SET Stocks = Stocks - ? WHERE ID_Products = ?");
                $stmt->execute([$qty, $productId]);
            }
            $pdo->commit();
            
            unset($_SESSION['cart']);
            header("Location: /orders/success?order_id=" . $orderId);
            exit;
            
        } catch (Exception $e) {
            $pdo->rollBack();
             echo "<pre>";
    echo "SQL / PDO ошибка:\n";
    echo $e->getMessage();
    echo "</pre>";
        }
    }
} 