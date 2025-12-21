<?php include "app/views/layout.php"; ?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Редактировать товар</h1>
        <a href="/admin/products" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Назад к списку
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="/admin/products/update">
                <input type="hidden" name="id" value="<?= htmlspecialchars($product['ID_Products']) ?>">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Название товара <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" 
                               value="<?= htmlspecialchars($product['ProductName']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Цена (₽) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="price" step="0.01" min="0.01"
                                   value="<?= $product['Price'] ?>" required>
                            <span class="input-group-text">₽</span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Остаток на складе <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="stocks" min="0"
                               value="<?= $product['Stocks'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Категория <span class="text-danger">*</span></label>
                        <select class="form-select" name="category_id" required>
                            <option value="">Выберите категорию</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['ID_Category'] ?>" 
                                    <?= ($cat['ID_Category'] == $product['Category_ID']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['CategoryName']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Бренд <span class="text-danger">*</span></label>
                        <select class="form-select" name="brand_id" required>
                            <option value="">Выберите бренд</option>
                            <?php foreach ($brands as $brand): ?>
                                <option value="<?= $brand['ID_Brands'] ?>" 
                                    <?= ($brand['ID_Brands'] == $product['Brands_ID']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($brand['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Описание</label>
                    <textarea class="form-control" name="description" rows="4"><?= htmlspecialchars($product['Description']) ?></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Сохранить изменения
                    </button>
                    <a href="/admin/products" class="btn btn-secondary">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</div>