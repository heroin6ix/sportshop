<?php include "app/views/layout.php"; ?>

<div class="container my-4">
    <h1 class="mb-4">Управление заказами</h1>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>№</th>
                            <th>Дата</th>
                            <th>Пользователь</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                            <th>Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Нет заказов</td>
                            </tr>
                        <?php else: ?>
                            <?php
                            $statusLabels = [
                                'pending' => 'На рассмотрении',
                                'processing' => 'В процессе',
                                'shipped' => 'Отправлен',
                                'delivered' => 'Доставлен',
                                'cancelled' => 'Отменён'
                            ];
                            $statusColors = [
                                'pending' => 'warning',
                                'processing' => 'info',
                                'shipped' => 'primary',
                                'delivered' => 'success',
                                'cancelled' => 'danger'
                            ];
                            ?>
                            <?php foreach ($orders as $o): ?>
                            <tr>
                                <td class="fw-bold">#<?= $o['ID_Orders'] ?></td>
                                <td><?= date('d.m.Y H:i', strtotime($o['OrderDate'])) ?></td>
                                <td><?= htmlspecialchars($o['user_email'] ?? 'Гость') ?></td>
                                <td class="fw-bold"><?= number_format((float)$o['TotalAmount'], 0, ',', ' ') ?> ₽</td>
                                <td>
                                    <span class="badge bg-<?= $statusColors[$o['Status']] ?? 'secondary' ?>">
                                        <?= $statusLabels[$o['Status']] ?? $o['Status'] ?>
                                    </span>
                                </td>
                                <td>
                                    <form method="POST" action="/admin/orders/update-status/" class="d-inline">
                                        <input type="hidden" name="order_id" value="<?= $o['ID_Orders'] ?>">
                                        <select name="status" class="form-select form-select-sm d-inline w-auto me-2">
                                            <?php foreach ($statusLabels as $statusValue => $statusText): ?>
                                                <option value="<?= $statusValue ?>" 
                                                    <?= $o['Status'] === $statusValue ? 'selected' : '' ?>>
                                                    <?= $statusText ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>