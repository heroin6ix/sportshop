<?php include "app/views/layout.php"; ?>

<h1>Корзина</h1>


<?php if (empty($products)): ?>
    <p>Корзина пуста</p>
<?php else: ?>

<form action="/cart/update" method="POST">

    <table border="1" cellpadding="10">
        <tr>
            <th>Товар</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Сумма</th>
        </tr>
    
        <?php foreach ($products as $p): 
            $qty = $_SESSION['cart'][$p['ID_Products']];
            $sum = $p['Price'] * $qty;
        ?>

        <tr>
            <td><?= htmlspecialchars($p['ProductName']) ?></td>
            <td><?= $p['Price'] ?></td>
            <td> <!-- Изменение количества -->
                <input type="number" name="qty[<?= $p['ID_Products'] ?>]" value="<?= $qty ?>" min="0">
            </td>
            <td><?= $sum ?> ₽</td>
        </tr>
        <?php endforeach; ?>
    </table>   
    <p><b>Итого: <?=$total ?> ₽</b></p>
    <button type="submit">Обновить корзину</button>
</form><br>
<form action="/checkout">
    <button type="submit">Оформить заказ</button>
</form>
<?php endif; ?>