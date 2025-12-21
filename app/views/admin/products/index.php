<?php include "app/views/layout.php"; ?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Управление товарами</h1>
        <a href="/admin/products/create" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> Добавить товар
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger mb-3"><?= htmlspecialchars($_SESSION['error']) ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if (empty($products)): ?>
                <div class="text-center text-muted py-4">Нет товаров</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>Остаток</th>
                                <th>Категория</th>
                                <th>Бренд</th>
                                <th class="text-end">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $p): ?>
                            <?php
                            $stockClass = $p['Stocks'] > 10 ? 'success' : ($p['Stocks'] > 0 ? 'warning' : 'danger');
                            $stockText = $p['Stocks'] > 0 ? $p['Stocks'] : 'Нет';
                            ?>
                            <tr>
                                <td><?= $p['ID_Products'] ?></td>
                                <td><?= htmlspecialchars($p['ProductName']) ?></td>
                                <td class="fw-bold text-primary"><?= number_format((float)$p['Price'], 0, ',', ' ') ?> ₽</td>
                                <td><span class="badge bg-<?= $stockClass ?>"><?= $stockText ?></span></td>
                                <td><?= htmlspecialchars($p['Category_ID'] ?? '—') ?></td>
                                <td><?= htmlspecialchars($p['Brands_ID'] ?? '—') ?></td>
                                <td class="text-end">
                                    <a href="/admin/products/edit?id=<?= $p['ID_Products'] ?>" 
                                       class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/admin/products/delete?id=<?= $p['ID_Products'] ?>" 
                                       class="btn btn-sm btn-outline-danger" data-confirm="Удалить товар?">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>