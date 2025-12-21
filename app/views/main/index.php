<?php include "app/views/layout.php"; ?>

<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Добро пожаловать в SportShop!</h1>
        <p class="lead text-muted">Лучшие спортивные товары — по лучшим ценам</p>
    </div>

    <div class="row mb-5">
        <div class="col-md-8">
            <div class="alert alert-info">
                <h5><i class="fas fa-star me-2"></i> Почему выбирают нас?</h5>
                <ul class="mb-0">
                    <li>Бесплатная доставка от 3000 ₽</li>
                    <li>Гарантия возврата 14 дней</li>
                    <li>Поддержка 24/7</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i> Ваша корзина</h5>
                </div>
                <div class="card-body text-center">
                    <?php if (!empty($_SESSION['cart'])): ?>
                        <p class="mb-2">Товаров: <strong><?= count($_SESSION['cart']) ?></strong></p>
                        <a href="/cart" class="btn btn-primary">Перейти в корзину</a>
                    <?php else: ?>
                        <p class="text-muted mb-2">Пуста</p>
                        <a href="/products" class="btn btn-outline-primary">Выбрать товары</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mb-4">Популярные товары</h2>
    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach (array_slice($products, 0, 4) as $p): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title"><?= htmlspecialchars($p['ProductName']) ?></h6>
                        <p class="card-text text-muted small"><?= mb_substr($p['Description'], 0, 50) ?>...</p>
                        <div class="mt-auto">
                            <p class="h5 mb-2"><?= $p['Price'] ?> ₽</p>
                            <form method="POST" action="/cart/add">
                                <input type="hidden" name="product_id" value="<?= $p['ID_Products'] ?>">
                                <input type="hidden" name="qty" value="1">
                                <button type="submit" class="btn btn-success btn-sm w-100">
                                    <i class="fas fa-cart-plus me-1"></i> В корзину
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-muted text-center">Товары временно недоступны.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="text-center mt-4">
        <a href="/products" class="btn btn-lg btn-outline-primary">
            Перейти в каталог <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>
</div>

<!-- Bootstrap JS (нужен для модальных окон, выпадающих меню и т.д.) -->
<script src="https "://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>