<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? "SportShop" ?></title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <nav>
        <a href="/">Главная</a> 
        <a href="/products">Каталог</a>

        <?php if (!empty($_SESSION['user_id'])): ?>
            <a href="/profile">Личный кабинет</a>
            <a href="/cart">Корзина</a>
            <a href="/orders/index">Заказы</a>

            <!-- 🔑 Админ-панель (только для role = 'admin') -->
            <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="/admin">Админ-панель</a>
            <?php endif; ?>

            <a href="/logout">Выйти</a>
        <?php else: ?>
            <a href="/login">Вход</a>
            <a href="/register">Регистрация</a>
        <?php endif; ?>
    </nav>

    <main style="margin-top: 20px; padding: 0 15px;">
        <!-- Сюда будет подключаться контент -->