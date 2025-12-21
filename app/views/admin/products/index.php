<?php include "app/views/layout.php"; ?>
<h1>Товары</h1>
<a href="/admin/products/create">Добавить товар</a>
<?php if (!empty($_SESSION['error'])): ?>
    <p style="color:red"><?= htmlspecialchars($_SESSION['error']) ?></p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<table border="1" cellpadding="8">
    <tr><th>ID</th><th>Название</th><th>Цена</th><th>Остаток</th><th>Действия</th></tr>
    <?php foreach ($products as $p): ?>
    <tr>
        <td><?= $p['ID_Products'] ?></td>
        <td><?= htmlspecialchars($p['ProductName']) ?></td>
        <td><?= $p['Price'] ?> ₽</td>
        <td><?= $p['Stocks'] ?></td>
        <td>
            <a href="/admin/products/edit?id=<?= $p['ID_Products'] ?>">Редактировать</a>
            <a href="/admin/products/delete?id=<?= $p['ID_Products'] ?>" onclick="return confirm('Удалить?')">Удалить</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>