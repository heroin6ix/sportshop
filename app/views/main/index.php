<?php include "app/views/layout.php"; ?>

<div class="container my-4">
    <h1 class="text-center mb-4">Добро пожаловать в SportShop!</h1>
    
    <div class="row">
        <div class="col-md-8">
            <div class="alert alert-info">
                <h4>🌟 Лучшие спортивные товары — по лучшим ценам!</h4>
                <p>У нас вы найдете всё для тренировок, бега, командных видов спорта и экстрима.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>🛒 Ваша корзина</h5>
                    <?php if (!empty($_SESSION['cart'])): ?>
                        <p>Товаров: <?= count($_SESSION['cart']) ?></p>
                        <a href="/cart" class="btn btn-primary">Перейти в корзину</a>
                    <?php else: ?>
                        <p class="text-muted">Пуста</p>
                        <a href="/products" class="btn btn-outline-primary">Выбрать товары</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mt-5 mb-3">Популярные товары</h2>
    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach (array_slice($products, 0, 4) as $p): ?>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h6><?= htmlspecialchars($p['ProductName']) ?></h6>
                        <p class="text-muted"><?= mb_substr($p['Description'], 0, 50) ?>...</p>
                        <p><strong><?= $p['Price'] ?> ₽</strong></p>
                        <form method="POST" action="/cart/add">
                            <input type="hidden" name="product_id" value="<?= $p['ID_Products'] ?>">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-sm btn-success">В корзину</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted">Товары временно недоступны.</p>
        <?php endif; ?>
    </div>

    <div class="text-center mt-4">
        <a href="/products" class="btn btn-lg btn-outline-primary">Перейти в каталог →</a>
    </div>
</div>