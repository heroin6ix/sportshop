<?php
class MainController {
    public function index() {
        $pageTitle = "Главная";
        require "app/views/main/index.php";
    }
}
?>