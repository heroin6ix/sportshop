<?php

require_once "app/models/Products.php";

class AdminController {
    private function checkAdmin() {
        if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            http_response_code(403);
            echo "Доступ запрещён";
            exit;
        }
    }

    public function index() {
        $this->checkAdmin();
        $pageTitle = "Админ-панель";
        require "app/views/admin/dashboard.php";
    }

    // ========== УПРАВЛЕНИЕ ТОВАРАМИ ==========

    public function products() {
        $this->checkAdmin();
        $products = Products::all();
        $pageTitle = "Товары";
        require "app/views/admin/products/index.php";
    }

    public function createProductForm() {
        $this->checkAdmin();
        // Если есть таблицы категорий и брендов — загрузи их
        global $pdo;
        $categories = $pdo->query("SELECT ID_Category, CategoryName FROM Category")->fetchAll(PDO::FETCH_ASSOC);
        $brands = $pdo->query("SELECT ID_Brands, name FROM Brands")->fetchAll(PDO::FETCH_ASSOC);
        $pageTitle = "Добавить товар";
        require "app/views/admin/products/create.php";
    }

    public function storeProduct() {
        $this->checkAdmin();
        $name = trim($_POST['name'] ?? '');
        $price = (float)($_POST['price'] ?? 0);
        $stocks = (int)($_POST['stocks'] ?? 0);
        $categoryId = (int)($_POST['category_id'] ?? 0);
        $brandId = (int)($_POST['brand_id'] ?? 0);
        $description = trim($_POST['description'] ?? '');

        if (empty($name) || $price <= 0 || $stocks < 0 || $categoryId <= 0 || $brandId <= 0) {
            $_SESSION['error'] = "Все поля обязательны. Цена и остаток должны быть корректными.";
            header("Location: /admin/products/create");
            exit;
        }

        Products::create($name, $price, $stocks, $categoryId, $brandId, $description);
        header("Location: /admin/products");
        exit;
    }

    public function editProductForm() {
         $this->checkAdmin();
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: /admin/products");
            exit;
        }
        $product = Products::find($id);
        if (!$product) {
            header("Location: /admin/products");
            exit;
        }

        global $pdo;
        $categories = $pdo->query("SELECT ID_Category, CategoryName FROM Category")->fetchAll(PDO::FETCH_ASSOC);
        $brands = $pdo->query("SELECT ID_Brands, name FROM Brands")->fetchAll(PDO::FETCH_ASSOC);

        $pageTitle = "Редактировать товар";
        require "app/views/admin/products/edit.php";
    }

    public function updateProduct() {
        $this->checkAdmin();
        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            header("Location: /admin/products");
            exit;
        }

        $name = trim($_POST['name'] ?? '');
        $price = (float)($_POST['price'] ?? 0);
        $stocks = (int)($_POST['stocks'] ?? 0);
        $categoryId = (int)($_POST['category_id'] ?? 0);
        $brandId = (int)($_POST['brand_id'] ?? 0);
        $description = trim($_POST['description'] ?? '');

        if (empty($name) || $price <= 0 || $stocks < 0 || $categoryId <= 0 || $brandId <= 0) {
            $_SESSION['error'] = "Все поля обязательны.";
            header("Location: /admin/products/edit/$id");
            exit;
        }

        Products::update($id, $name, $price, $stocks, $categoryId, $brandId, $description);
        header("Location: /admin/products");
        exit;
    }

    public function deleteProduct() {
        $this->checkAdmin();

        $id = (int)($_GET['id'] ?? 0);

        if ($id > 0) {
            Products::delete($id);
        }

        header("Location: /admin/products");
        exit;
    }

    // ========== УПРАВЛЕНИЕ ЗАКАЗАМИ ==========

    public function orders() {
        $this->checkAdmin();
        global $pdo;
        $stmt = $pdo->query("
            SELECT o.ID_Orders, o.OrderDate, o.Status, o.TotalAmount, u.email as user_email
            FROM Orders o
            LEFT JOIN Users u ON o.Users_ID = u.ID_Users
            ORDER BY o.OrderDate DESC
        ");
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pageTitle = "Заказы";
        require "app/views/admin/orders/index.php";
    }

    public function updateOrderStatus() {
            // 🔴 ВРЕМЕННАЯ ОТЛАДКА
        $this->checkAdmin();
        $orderId = (int)($_POST['order_id'] ?? 0);
        $newStatus = $_POST['status'] ?? '';

        $allowed = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        if ($orderId <= 0 || !in_array($newStatus, $allowed)) {
            $_SESSION['error'] = "Недопустимый статус";
            header("Location: /admin/orders");
            exit;
        }

        global $pdo;
        $stmt = $pdo->prepare("UPDATE Orders SET Status = ? WHERE ID_Orders = ?");
        $stmt->execute([$newStatus, $orderId]);

        header("Location: /admin/orders");
        exit;
    }
}