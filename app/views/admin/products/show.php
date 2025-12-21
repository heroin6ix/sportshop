<?php include "app/views/layout.php"; ?>

<div class="container my-4">
    <div class="row">
        <div class="col-md-6">
            <img src="/uploads/products/<?= htmlspecialchars($product['ImagePath']) ?>" 
                 class="img-fluid rounded" 
                 alt="<?= htmlspecialchars($product['ProductName']) ?>"
                 style="max-height: 400px; object-fit: contain;">
        </div>
        <div class="col-md-6">
            <h1><?= htmlspecialchars($product['ProductName']) ?></h1>
            <p class="h2 text-primary"><?= number_format((float)$product['Price'], 0, ',', ' ') ?> ₽</p>
            
            <div class="mb-3">
                <span class="badge bg-<?= $product['Stocks'] <= 5 ? 'danger' : ($product['Stocks'] <= 15 ? 'warning' : 'success') ?>">
                    На складе: <?= $product['Stocks'] > 0 ? $product['Stocks'] : 'Нет в наличии' ?>
                </span>
            </div>
            
            <p class="lead"><?= nl2br(htmlspecialchars($product['Description'])) ?></p>
            
            <form method="POST" action="/cart/add" class="mt-4">
                <input type="hidden" name="product_id" value="<?= $product['ID_Products'] ?>">
                <div class="input-group mb-3" style="max-width: 200px;">
                    <button class="btn btn-outline-secondary" type="button" 
                            onclick="changeQty(-1)">-</button>
                    <input type="number" name="qty" value="1" min="1" max="<?= $product['Stocks'] ?>" 
                           class="form-control text-center" id="quantity">
                    <button class="btn btn-outline-secondary" type="button" 
                            onclick="changeQty(1)">+</button>
                </div>
                <button type="submit" class="btn btn-success btn-lg w-100">
                    <i class="fas fa-cart-plus me-2"></i> Добавить в корзину
                </button>
            </form>
        </div>
    </div>
    
    <div class="mt-5">
        <h2>Характеристики</h2>
        <table class="table table-bordered">
            <tr>
                <th>Категория</th>
                <td><?= htmlspecialchars($product['Category_ID']) ?></td>
            </tr>
            <tr>
                <th>Бренд</th>
                <td><?= htmlspecialchars($product['Brands_ID']) ?></td>
            </tr>
            <tr>
                <th>Артикул</th>
                <td><?= htmlspecialchars($product['ID_Products']) ?></td>
            </tr>
        </table>
    </div>
</div>

<script>
    function changeQty(delta) {
        const input = document.getElementById('quantity');
        let value = parseInt(input.value) + delta;
        if (value < 1) value = 1;
        if (value > <?= $product['Stocks'] ?>) value = <?= $product['Stocks'] ?>;
        input.value = value;
    }
</script>