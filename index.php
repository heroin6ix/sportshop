<?php
session_start();
require_once "config/db.php";
require_once "core/Router.php";

$router = new Router();

// Регистрируем маршруты
//Основная и каталог
$router->add("/", "MainController@index");
$router->add("/products", "ProductsController@index");

//регистрация
$router->add("/register", "UsersController@register");
$router->add("/register/action", "UsersController@registerAction");

//логин
$router->add("/login", "UsersController@login");
$router->add("/login/action", "UsersController@loginAction");

//профиль
$router->add("/profile", "UsersController@profile");
$router->add("/profile/edit", "UsersController@editProfile");
$router->add("/profile/update", "UsersController@updateProfile");

//корзина
$router->add("/cart", "CartController@index");
$router->add("/cart/add", "CartController@add");
$router->add("/cart/update", "CartController@update");
$router->add("/cart/remove", "CartController@remove");
$router->add("/cart/clear", "CartController@clear");


//Оформление заказа
$router->add("/checkout", "CheckoutController@index");
$router->add("/checkout/action", "CheckoutController@action");

//Заказы
$router->add("/orders/success", "OrdersController@success");
$router->add("/orders/index", "OrdersController@index");

// Админ-панель
$router->add("/admin", "AdminController@index");
$router->add("/admin/products", "AdminController@products");
$router->add("/admin/products/create", "AdminController@createProductForm");
$router->add("/admin/products/store", "AdminController@storeProduct");
$router->add("/admin/products/edit", "AdminController@editProductForm");
$router->add("/admin/products/update", "AdminController@updateProduct");
$router->add("/admin/products/delete", "AdminController@deleteProduct");

$router->add("/admin/orders", "AdminController@orders");
$router->add("/admin/orders/update-status/", "AdminController@updateOrderStatus");


//выход
$router->add("/logout", "UsersController@logout");


// Запускаем роутер

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($uri);