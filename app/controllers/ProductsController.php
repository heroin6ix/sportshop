<?php

require_once "app/models/Products.php";

class ProductsController {
    public function index() {
        $products = Products::all();

        $pageTitle = "Каталог товаров";
        require "app/views/products/index.php";
    }
}
?>