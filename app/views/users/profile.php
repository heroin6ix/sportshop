<?php include "app/views/layout.php"; ?>

<div class="container my-4">
    <h1 class="mb-4">Личный кабинет</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Мои данные</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td style="width: 30%;"><strong>Логин:</strong></td>
                            <td><?= htmlspecialchars($user['Login'] ?? '—') ?></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;"><strong>Имя:</strong></td>
                            <td><?= htmlspecialchars($user['FullName'] ?? '—') ?></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;"><strong>Номер телефона:</strong></td>
                            <td><?= htmlspecialchars($user['Phone'] ?? '—') ?></td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td><?= htmlspecialchars($user['Email'] ?? '—') ?></td>
                        </tr>
                        <tr>
                            <td><strong>Роль:</strong></td>
                            <td>
                                <?php if (!empty($_SESSION['role'])): ?>
                                    <span class="badge <?= $_SESSION['role'] === 'admin' ? 'bg-danger' : 'bg-secondary' ?>">
                                        <?= $_SESSION['role'] === 'admin' ? 'Администратор' : 'Пользователь' ?>
                                    </span>
                                <?php else: ?>
                                    Пользователь
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <div class="mt-3">
                        <a href="/profile/edit" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-1"></i> Редактировать профиль
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Мои заказы</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($orders) && count($orders) > 0): ?>
                        <p>Всего заказов: <strong><?= count($orders) ?></strong></p>
                        <ul class="list-unstyled">
                            <?php foreach (array_slice($orders, 0, 3) as $order): ?>
                            <li class="mb-2">
                                <a href="/orders/index#order-<?= $order['ID_Orders'] ?>" class="text-decoration-none">
                                    Заказ #<?= $order['ID_Orders'] ?> — 
                                    <span class="text-primary"><?= number_format((float)$order['TotalAmount'], 0, ',', ' ') ?> ₽</span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="/orders/index" class="btn btn-sm btn-outline-secondary">Все заказы →</a>
                    <?php else: ?>
                        <p class="text-muted">У вас пока нет заказов.</p>
                        <a href="/products" class="btn btn-sm btn-primary">Выбрать товары</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>