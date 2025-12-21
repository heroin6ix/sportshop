<?php include "app/views/layout.php"; ?>

<h1>Мои заказы</h1>

<?php if (empty($orders)): ?>
    <p>У вас пока нет заказов.</p>
<?php else: ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>№ заказа</th>
                <th>Дата</th>
                <th>Статус</th>
                <th>Сумма</th>
                <th>Оплата</th>
                <th>Адрес</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= htmlspecialchars($order['ID_Orders']) ?></td>
                    <td><?= htmlspecialchars($order['OrderDate']) ?></td>
                    <td>
                        <?php
                        $statusLabels = [
                            'pending'    => 'На рассмотрении',
                            'processing'  => 'В процессе',
                            'shipped'    => 'Отправлен',
                            'delivered'  => 'Доставлен',
                            'cancelled'  => 'Отменён'
                    // добавь другие статусы, если есть
                        ];
                        echo htmlspecialchars($statusLabels[$order['Status']] ?? $order['Status']);
                            ?>
                    </td>
                    <td><?= number_format((float)$order['TotalAmount'], 2, ',', ' ') ?> ₽</td>
                    <td>
                        <?php
                        $paymentLabels = [
                            'OnlineCard' => 'Картой онлайн',
                            'UponReceipt' => 'При получении'
                        ];
                        echo htmlspecialchars($paymentLabels[$order['PaymentMethod']] ?? $order['PaymentMethod']);
                        ?>
                    </td>
                    <td><?= htmlspecialchars($order['Address']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>