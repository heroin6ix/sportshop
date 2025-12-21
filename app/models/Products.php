<?php

class Products {

    //Создать товар
    public static function create($name, $price, $stocks, $categoryId, $brandId, $description) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO Products (ProductName,  Price, Stocks, Category_ID, Brands_ID, Description) values (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $price, $stocks, $categoryId, $brandId, $description]);
        return $pdo->lastInsertId();
    }
    //Обновить(изменить товар)
    public static function update($id, $name, $price, $stocks, $categoryId, $brandId, $description) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Products SET ProductName = ?, Price = ?, Stocks = ?, Category_ID = ?, Brands_ID = ?, Description = ? WHERE ID_Products = ?");
        return $stmt->execute([$name, $price, $stocks, $categoryId, $brandId, $description, $id]);
    }
    //удалить товар
    public static function delete($id) {
        global $pdo;
        // Сначала удалим связанные записи в OrderItem (если нужно) или просто удалим товар
        $stmt = $pdo->prepare("DELETE FROM Products WHERE ID_Products = ?");
        return $stmt->execute([$id]);
    }
    //Найти
    public static function find($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM Products WHERE ID_Products = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //всё
    public static function all() {
        global $pdo;
        return $pdo->query("SELECT * FROM Products ORDER BY ProductName")->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>