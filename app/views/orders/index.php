<?php include "app/views/layout.php"; ?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Мои заказы</h1>
        <a href="/products" class="btn btn-outline-secondary">
            <i class="fas fa-shopping-bag me-1"></i> Продолжить покупки
        </a>
    </div>

    <?php if (empty($orders)): ?>
        <div class="text-center py-5">
            <div class="text-muted mb-3">
                <i class="fas fa-box-open fa-4x"></i>
            </div>
            <h3>У вас нет заказов</h3>
            <p class="text-muted mb-4">Оформите первый заказ в нашем магазине</p>
            <a href="/products" class="btn btn-primary px-4 py-2">
                <i class="fas fa-shopping-cart me-2"></i> Каталог товаров
            </a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>№ заказа</th>
                        <th>Дата</th>
                        <th>Статус</th>
                        <th>Сумма</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $order): ?>
                    <tr>
                        <td class="fw-bold">#<?= $order['ID_Orders'] ?></td>
                        <td><?= date('d.m.Y', strtotime($order['OrderDate'])) ?></td>
                        <td>
                            <?php
                            $statusLabels = [
                                'pending' => 'На рассмотрении',
                                'processing' => 'В процессе',
                                'shipped' => 'Отправлен',
                                'delivered' => 'Доставлен',
                                'cancelled' => 'Отменён'
                            ];
                            $statusClass = match($order['Status']) {
                                'pending' => 'bg-warning text-dark',
                                'processing' => 'bg-info text-white',
                                'shipped' => 'bg-primary text-white',
                                'delivered' => 'bg-success text-white',
                                'cancelled' => 'bg-danger text-white',
                                default => 'bg-secondary text-white'
                            };
                            ?>
                            <span class="badge <?= $statusClass ?>">
                                <?= $statusLabels[$order['Status']] ?? $order['Status'] ?>
                            </span>
                        </td>
                        <td class="fw-bold"><?= number_format((float)$order['TotalAmount'], 0, ',', ' ') ?> ₽</td>
                        <td>
                            <!-- Можно добавить "Повторить заказ" или "Отменить" -->
                            <span class="text-muted">Подробности</span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>