<?php include "app/views/layout.php"; ?>

<div class="container my-5">
    <div class="text-center py-5">
        <div class="mb-4">
            <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                 style="width: 100px; height: 100px; font-size: 3rem;">
                <i class="fas fa-check"></i>
            </div>
        </div>
        <h1 class="mb-3">Заказ успешно оформлен!</h1>
        <p class="lead text-muted mb-4">Спасибо за покупку в SportShop</p>
        
        <?php if (!empty($orderId)): ?>
        <div class="card border-success max-w-500 mx-auto mb-4">
            <div class="card-body">
                <h4 class="card-title text-success mb-3">Детали заказа</h4>
                <div class="mb-2">
                    <span class="text-muted">Номер заказа:</span>
                    <span class="fw-bold fs-4">#<?= htmlspecialchars($orderId) ?></span>
                </div>
                <?php if (!empty($order)): ?>
                <div class="mb-2">
                    <span class="text-muted">Сумма заказа:</span>
                    <span class="fw-bold fs-4"><?= number_format((float)$order['TotalAmount'], 0, ',', ' ') ?> ₽</span>
                </div>
                <div class="mb-2">
                    <span class="text-muted">Адрес доставки:</span>
                    <span class="fw-bold"><?= htmlspecialchars($order['Address']) ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <p class="text-muted mb-4">
            Наш менеджер свяжется с вами в ближайшее время для подтверждения заказа.<br>
            Спасибо, что выбрали SportShop!
        </p>
        
        <div class="d-flex justify-content-center gap-3">
            <a href="/products" class="btn btn-primary px-4 py-2">
                <i class="fas fa-shopping-bag me-2"></i>Продолжить покупки
            </a>
            <a href="/orders/index" class="btn btn-outline-primary px-4 py-2">
                <i class="fas fa-history me-2"></i>Мои заказы
            </a>
        </div>
    </div>
</div>

<style>
    .max-w-500 { max-width: 500px; }
</style>