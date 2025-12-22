<?php

require_once "app/models/Products.php";

class ProductsController {
    public function index() {
    global $pdo;
    
    // Получаем параметры фильтрации
    $search = trim($_GET['search'] ?? '');
    $category = (int)($_GET['category'] ?? 0);
    $brand = (int)($_GET['brand'] ?? 0);
    $stock = $_GET['stock'] ?? '';
    $sort = $_GET['sort'] ?? 'name_asc';
    
    // Базовый запрос
    $sql = "SELECT p.*, c.CategoryName, b.name as BrandName 
            FROM Products p 
            LEFT JOIN Category c ON p.Category_ID = c.ID_Category 
            LEFT JOIN Brands b ON p.Brands_ID = b.ID_Brands 
            WHERE 1=1";
    $params = [];
    
    // Фильтрация по поиску
    if (!empty($search)) {
        $sql .= " AND p.ProductName LIKE ?";
        $params[] = "%$search%";
    }
    
    // Фильтрация по категории
    if ($category > 0) {
        $sql .= " AND p.Category_ID = ?";
        $params[] = $category;
    }
    
    // Фильтрация по бренду
    if ($brand > 0) {
        $sql .= " AND p.Brands_ID = ?";
        $params[] = $brand;
    }
    
    // Фильтрация по наличию
    if ($stock === 'in_stock') {
        $sql .= " AND p.Stocks > 0";
    } elseif ($stock === 'low_stock') {
        $sql .= " AND p.Stocks <= 5 AND p.Stocks > 0";
    }
    
    // Сортировка
    $orderBy = match($sort) {
        'price_asc' => 'p.Price ASC',
        'price_desc' => 'p.Price DESC',
        'name_asc' => 'p.ProductName ASC',
        default => 'p.ProductName ASC'
    };
    $sql .= " ORDER BY $orderBy";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Получаем категории и бренды для фильтров
    $categories = $pdo->query("SELECT ID_Category, CategoryName FROM Category ORDER BY CategoryName")->fetchAll(PDO::FETCH_ASSOC);
    $brands = $pdo->query("SELECT ID_Brands, name FROM Brands ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
    
    $pageTitle = "Каталог товаров";
    require "app/views/products/index.php";
}
}
?>