<?php include "app/views/layout.php"; ?>

<h1>Редактировать товар</h1>

<form method="POST" action="/admin/products/update">
    <input type="hidden" name="id" value="<?= htmlspecialchars($product['ID_Products']) ?>">

    <label>
        Название:<br>
        <input type="text" name="name" value="<?= htmlspecialchars($product['ProductName']) ?>" required>
    </label><br><br>

    <label>
        Цена (₽):<br>
        <input type="number" step="0.01" name="price" value="<?= $product['Price'] ?>" min="0.01" required>
    </label><br><br>

    <label>
        Остаток:<br>
        <input type="number" name="stocks" value="<?= $product['Stocks'] ?>" min="0" required>
    </label><br><br>

    <?php if (!empty($categories)): ?>
    <label>
        Категория:<br>
        <select name="category_id" required>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['ID_Category'] ?>" 
                    <?= ($cat['ID_Category'] == $product['Category_ID']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['CategoryName']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br><br>
    <?php endif; ?>

    <?php if (!empty($brands)): ?>
    <label>
        Бренд:<br>
        <select name="brand_id" required>
            <?php foreach ($brands as $brand): ?>
                <option value="<?= $brand['ID_Brands'] ?>" 
                    <?= ($brand['ID_Brands'] == $product['Brands_ID']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($brand['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br><br>
    <?php endif; ?>

    <label>
        Описание:<br>
        <textarea name="description" rows="5" style="width: 300px;"><?= htmlspecialchars($product['Description']) ?></textarea>
    </label><br><br>

    <button type="submit">Сохранить</button>
    <a href="/admin/products">Отмена</a>
</form>