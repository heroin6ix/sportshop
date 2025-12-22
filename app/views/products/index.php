<?php include "app/views/layout.php"; ?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Каталог товаров</h1>
        <?php if (!empty($_SESSION['user_id'])): ?>
            <a href="/cart" class="btn btn-outline-primary position-relative">
                <i class="fas fa-shopping-cart me-1"></i> Корзина
                <?php if (!empty($_SESSION['cart'])): ?>
                    <span class="badge bg-danger ms-1"><?= count($_SESSION['cart']) ?></span>
                <?php endif; ?>
            </a>
        <?php endif; ?>
    </div>

    <!-- Форма фильтрации -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="/products">
                <div class="row g-3">
                    <!-- Поиск -->
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="search" 
                               placeholder="Поиск по названию..." 
                               value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                    </div>
                    
                    <!-- Категория -->
                    <div class "col-md-2">
                        <select name="category" class="form-select">
                            <option value="">Все категории</option>
                            <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['ID_Category'] ?>" 
                                <?= ($_GET['category'] ?? '') == $cat['ID_Category'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['CategoryName']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <!-- Бренд -->
                    <div class="col-md-2">
                        <select name="brand" class="form-select">
                            <option value="">Все бренды</option>
                            <?php foreach ($brands as $brand): ?>
                            <option value="<?= $brand['ID_Brands'] ?>" 
                                <?= ($_GET['brand'] ?? '') == $brand['ID_Brands'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($brand['name']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <!-- Наличие -->
                    <div class="col-md-2">
                        <select name="stock" class="form-select">
                            <option value="">Любое наличие</option>
                            <option value="in_stock" <?= ($_GET['stock'] ?? '') === 'in_stock' ? 'selected' : '' ?>>
                                В наличии
                            </option>
                            <option value="low_stock" <?= ($_GET['stock'] ?? '') === 'low_stock' ? 'selected' : '' ?>>
                                Мало на складе
                            </option>
                        </select>
                    </div>
                    
                    <!-- Сортировка -->
                    <div class="col-md-2">
                        <select name="sort" class="form-select" onchange="this.form.submit()">
                            <option value="name_asc" <?= ($_GET['sort'] ?? 'name_asc') === 'name_asc' ? 'selected' : '' ?>>
                                По названию (А-Я)
                            </option>
                            <option value="price_asc" <?= ($_GET['sort'] ?? '') === 'price_asc' ? 'selected' : '' ?>>
                                Сначала дешевые
                            </option>
                            <option value="price_desc" <?= ($_GET['sort'] ?? '') === 'price_desc' ? 'selected' : '' ?>>
                                Сначала дорогие
                            </option>
                        </select>
                    </div>
                </div>
                
                <div class="mt-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-1"></i> Применить фильтры
                    </button>
                    <?php if (!empty(array_filter($_GET))): ?>
                    <a href="/products" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> Сбросить
                    </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <!-- Результаты -->
    <?php if (empty($products)): ?>
        <div class="text-center py-5">
            <div class="text-muted mb-3">
                <i class="fas fa-box-open fa-3x"></i>
            </div>
            <h3>Товары не найдены</h3>
            <p class="text-muted">Попробуйте изменить параметры фильтрации</p>
            <a href="/products" class="btn btn-primary">Сбросить фильтры</a>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($products as $p): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="position-relative">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <a href="/product?id=<?= $p['ID_Products'] ?>" class="text-decoration-none text-dark mb-2">
                            <h5 class="card-title"><?= htmlspecialchars($p['ProductName']) ?></h5>
                        </a>
                        <p class="card-text text-muted small"><?= mb_substr($p['Description'], 0, 60) ?>...</p>
                        <div class="mt-auto">
                        <p class="h5 mb-1"><?= number_format((float)$p['Price'], 0, ',', ' ') ?> ₽</p>
                        
                        <!-- СТАТУС С ИКОНКАМИ (ВСТАВЛЯЕМ СЮДА) -->
                        <?php
                        $stockIcon = 'fa-check-circle text-success';
                        if ($p['Stocks'] <= 5) {
                            $stockIcon = 'fa-exclamation-triangle text-warning';
                        } elseif ($p['Stocks'] <= 0) {
                            $stockIcon = 'fa-times-circle text-danger';
                        }
                        ?>
                        <small class="text-muted mb-2">
                            <i class="fas <?= $stockIcon ?>"></i> 
                            <?= $p['Stocks'] > 0 ? $p['Stocks'] : 'Нет' ?>
                        </small>
                        
                        <?php if ($p['Stocks'] > 0): ?>
                        <form method="POST" action="/cart/add">
                            <input type="hidden" name="product_id" value="<?= $p['ID_Products'] ?>">
                            <input type="hidden" name="qty" value="1">
                            <button type="submit" class="btn btn-success w-100 btn-sm">
                                <i class="fas fa-cart-plus me-1"></i> В корзину
                            </button>
                        </form>
                        <?php endif; ?>
                    </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>