<?php include "app/views/layout.php"; ?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Каталог товаров</h1>
        <?php if (!empty($_SESSION['user_id'])): ?>
            <a href="/cart" class="btn btn-outline-primary position-relative">
                <i class="fas fa-shopping-cart me-1"></i> Корзина
                <?php if (!empty($_SESSION['cart'])): ?>
                    <span class="badge bg-danger ms-1"><?= count($_SESSION['cart']) ?></span>
                <?php endif; ?>
            </a>
        <?php endif; ?>
    </div>

    <?php if (empty($products)): ?>
        <div class="text-center py-5">
            <div class="text-muted mb-3">
                <i class="fas fa-box-open fa-3x"></i>
            </div>
            <h3>Товары не найдены</h3>
            <p class="text-muted">В данный момент каталог пуст.</p>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($products as $p): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($p['ProductName']) ?></h5>
                        <p class="card-text text-muted small"><?= htmlspecialchars($p['Description']) ?></p>
                        <div class="mt-auto">
                            <p class="h5 mb-2"><?= $p['Price'] ?> ₽</p>
                            <form method="POST" action="/cart/add">
                                <input type="hidden" name="product_id" value="<?= $p['ID_Products'] ?>">
                                <input type="hidden" name="qty" value="1">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-cart-plus me-1"></i> В корзину
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>