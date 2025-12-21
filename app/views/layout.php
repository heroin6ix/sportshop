<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? "SportShop" ?></title>
    
    <!-- Bootstrap 5 CSS (с CDN — ничего устанавливать не нужно!) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Твои собственные стили (если будут) -->
    <link href="/css/custom.css" rel="stylesheet">
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