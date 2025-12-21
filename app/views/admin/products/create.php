<?php include "app/views/layout.php"; ?>
<h1>Добавить товар</h1>
<form method="POST" action="/admin/products/store">
    Название: <input type="text" name="name" required><br><br>
    Цена: <input type="number" step="0.01" name="price" min="0.01" required><br><br>
    Остаток: <input type="number" name="stocks" min="0" required><br><br>
    Категория:
    <select name="category_id" required>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['ID_Category'] ?>"><?= htmlspecialchars($cat['CategoryName']) ?></option>
        <?php endforeach; ?>
    </select><br><br>
    Бренд:
    <select name="brand_id" required>
        <?php foreach ($brands as $brand): ?>
            <option value="<?= $brand['ID_Brands'] ?>"><?= htmlspecialchars($brand['name']) ?></option>
        <?php endforeach; ?>
    </select><br><br>
    Описание: <textarea name="description"></textarea><br><br>
    <button type="submit">Создать</button>
    <a href="/admin/products">Отмена</a>
</form>