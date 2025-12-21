<?php include "app/views/layout.php"; ?>

<div class="container my-4">
    <h1 class="mb-4">Корзина</h1>

    <?php if (empty($products)): ?>
        <div class="text-center py-5">
            <div class="text-muted mb-3">
                <i class="fas fa-shopping-cart fa-3x"></i>
            </div>
            <h3>Ваша корзина пуста</h3>
            <p class="text-muted mb-4">Добавьте товары из каталога</p>
            <a href="/products" class="btn btn-primary px-4 py-2">
                <i class="fas fa-shopping-bag me-2"></i>Перейти в каталог
            </a>
        </div>
    <?php else: ?>
        <form action="/cart/update" method="POST">
            <div class="table-responsive mb-4">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Товар</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Сумма</th>
                            <th class="text-end">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $p): 
                            $qty = $_SESSION['cart'][$p['ID_Products']];
                            $sum = $p['Price'] * $qty;
                        ?>
                        <tr>
                            <td>
                                <div>
                                    <h6 class="mb-1"><?= htmlspecialchars($p['ProductName']) ?></h6>
                                    <small class="text-muted"><?= htmlspecialchars($p['Description']) ?></small>
                                </div>
                            </td>
                            <td><?= $p['Price'] ?> ₽</td>
                            <td>
                                <input type="number" 
                                       name="qty[<?= $p['ID_Products'] ?>]" 
                                       value="<?= $qty ?>" 
                                       min="1" 
                                       class="form-control form-control-sm w-75">
                            </td>
                            <td><strong><?= $sum ?> ₽</strong></td>
                            <td class="text-end">
                                <!-- Пока оставим пустым, можно добавить "удалить" позже -->
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <a href="/products" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Продолжить покупки
                    </a>
                </div>
                <div class="col-md-6 mb-4">
                    <div class "card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Итого к оплате</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Товары (<?= count($products) ?>):</span>
                                <span class="fw-bold"><?= $total ?> ₽</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Доставка:</span>
                                <span>Бесплатно</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fs-4 fw-bold text-primary">
                                <span>Итого:</span>
                                <span><?= $total ?> ₽</span>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <button type="submit" class="btn btn-warning w-100 mb-2">
                                <i class="fas fa-sync-alt me-1"></i> Обновить корзину
                            </button>
                            <a href="/checkout" class="btn btn-success w-100">
                                <i class="fas fa-check-circle me-1"></i> Оформить заказ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>