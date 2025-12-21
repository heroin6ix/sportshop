<?php include "app/views/layout.php"; ?>

<h1>Каталог товаров</h1>

<?php foreach ($products as $p): ?>
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <h3><?= htmlspecialchars($p['ProductName'])?></h3>  <!-- Название товара -->
        <p>Описание:<?= $p['Description'] ?> </p> <!-- Описание -->
        <p>Цена:<?= $p['Price'] ?> ₽</p>  <!-- Цена -->
        <p>Остаток:<?= $p['Stocks'] ?> шт.</p>  <!-- Остаток -->
        
        <!--Форма добавления в корзину -->
        <form action="/cart/add" method="POST">
            <input type="hidden" name="product_id" value="<?= $p['ID_Products'] ?>"><!-- Передаём ID товара -->
            <input type="number" name="qty" value="1" min="1" max="<?= $p['Stocks'] ?>"><!-- Количество -->
            <button type="submit">Добавить в корзину</button> <!-- Кнопка -->
        </form>
    </div>
<?php endforeach; ?>