<?php

class CartController {
    //показ корзины
    public function index() {
        //Если корзины нет - создаем пустую
        $cart = $_SESSION['cart'] ?? [];

        //Массив товаров
        $products = [];
        $total = 0;

        //Если корзина не пустая
        if (!empty($cart)) {
            $ids = array_keys($cart); // Получаем ID всех товаров в корзине
            $placeholders = implode(',', array_fill(0, count($ids), '?')); // Превращаем массив ID в строку "1,2,3"

            global $pdo;

            $stmt = $pdo->prepare("SELECT * FROM Products WHERE ID_Products in ($placeholders)");
            $stmt->execute($ids);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Считаем итоговую сумму
            foreach ($products as $p) {
                $qty = $cart[$p['ID_Products']];
                $total +=$p['Price'] * $qty;
            }
        }
        require "app/views/cart/index.php";
    }
    //Добавление товара в корзину
    public function add() {
        // Получаем данные из формы
        $productId = (int)$_POST['product_id'];
        $qty = max (1, (int)$_POST['qty']);

        // Если корзины ещё нет — создаём
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Если товар уже есть — увеличиваем количество
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $qty;
        } else {
            $_SESSION['cart'][$productId] = $qty;
        }

        //Возвращаем пользователя в корзину
        header("Location: /cart");
        exit;
    }
    // Обновление корзины (изменение количества / удаление)
    public function update() {
        if (!isset($_POST['qty']) || !is_array($_POST['qty'])) {
        // Если нет данных — просто возвращаемся в корзину
        header("Location: /cart");
        exit;
    }
        // Проходим по всем переданным количествам
        foreach ($_POST['qty'] as $productId => $qty) {
            $productId = (int)$productId;
            $qty = (int)$qty;

        // Если количество 0 — удаляем товар
        if ($qty <= 0) {
            unset($_SESSION['cart'][$productId]);
        } else {
            $_SESSION['cart'][$productId] = $qty;
            }
        }
        header("Location: /cart");
        exit;
    }

} 
