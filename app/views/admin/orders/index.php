<?php include "app/views/layout.php"; ?>
<h1>Заказы</h1>

<table border="1" cellpadding="8">
    <tr>
        <th>№</th>
        <th>Дата</th>
        <th>Пользователь</th>
        <th>Сумма</th>
        <th>Статус</th>
        <th>Действие</th>
    </tr>
    <?php foreach ($orders as $o): ?>
    <tr>
        <td><?= $o['ID_Orders'] ?></td>
        <td><?= $o['OrderDate'] ?></td>
        <td><?= htmlspecialchars($o['user_email'] ?? 'Гость') ?></td>
        <td><?= $o['TotalAmount'] ?> ₽</td>
        <td>
            <?php
            $statusLabels = [
                'pending' => 'На рассмотрении',
                'processing' => 'В процессе',
                'shipped' => 'Отправлен',
                'delivered' => 'Доставлен',
                'cancelled' => 'Отменён'
            ];
            echo $statusLabels[$o['Status']] ?? $o['Status'];
            ?>
        </td>
        <td>
            <form method="POST" action="/admin/orders/update-status/" style="display:inline;">
                <input type="hidden" name="order_id" value="<?= $o['ID_Orders']?>">
                <select name="status">
                    <?php foreach (['pending','processing','shipped','delivered','cancelled'] as $s): ?>
                        <option value="<?= $s ?>" <?= $o['Status'] === $s ? 'selected' : '' ?>>
                            <?= $statusLabels[$s] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Сменить</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
