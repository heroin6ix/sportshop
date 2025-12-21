<?php
class MainController {
    public function index() {
        global $pdo;
        // Получаем первые 10 товаров для отображения на главной
        $stmt = $pdo->query("SELECT ID_Products, ProductName, Description, Price FROM Products LIMIT 10");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pageTitle = "Главная";
        require "app/views/main/index.php";
    }
}
?>