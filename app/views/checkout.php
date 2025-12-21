<?php include "app/views/layout.php"; ?>

<div class="container my-4">
    <h1 class="mb-4">Оформление заказа</h1>

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Данные для доставки</h5>
                </div>
                <div class="card-body">
                    <form action="/checkout/action" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Адрес доставки <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control" 
                                   name="address" 
                                   value="<?= htmlspecialchars($_POST['address'] ?? '') ?>" 
                                   required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Комментарий к заказу</label>
                            <textarea class="form-control" 
                                      name="comment" 
                                      rows="3"><?= htmlspecialchars($_POST['comment'] ?? '') ?></textarea>
                            <small class="form-text text-muted">Например: этаж, код домофона, время доставки</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Метод оплаты <span class="text-danger">*</span></label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="payment" 
                                       value="OnlineCard" 
                                       id="paymentOnline" 
                                       required 
                                       <?= (($_POST['payment'] ?? '') === 'OnlineCard') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="paymentOnline">
                                    <i class="fas fa-credit-card me-2"></i>Картой онлайн
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="payment" 
                                       value="UponReceipt" 
                                       id="paymentReceipt" 
                                       required 
                                       <?= (($_POST['payment'] ?? '') === 'UponReceipt') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="paymentReceipt">
                                    <i class="fas fa-hand-holding-usd me-2"></i>При получении
                                </label>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Итого к оплате</h5>
                </div>
                <div class="card-body">
                    <?php 
                    // Пересчитываем сумму на лету (как в корзине)
                    $cartTotal = 0;
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $productId => $qty) {
                            // Найдём товар в $products (если передано)
                            $product = null;
                            foreach ($products ?? [] as $p) {
                                if ($p['ID_Products'] == $productId) {
                                    $product = $p;
                                    break;
                                }
                            }
                            if ($product) {
                                $cartTotal += $product['Price'] * $qty;
                            }
                        }
                    }
                    ?>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Товары (<?= !empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>):</span>
                        <span class="fw-bold"><?= $cartTotal ?> ₽</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Доставка:</span>
                        <span>Бесплатно</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fs-4 fw-bold text-primary">
                        <span>Итого:</span>
                        <span><?= $cartTotal ?> ₽</span>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <button type="submit" class="btn btn-success w-100 py-2 fs-5">
                        <i class="fas fa-check-circle me-2"></i>Подтвердить заказ
                    </button>
                </div>
                </form>
            </div>

            <div class="alert alert-info mt-4">
                <i class="fas fa-shield-alt me-2"></i>
                <strong>Безопасность</strong><br>
                Ваши данные надежно защищены. Мы не храним информацию о платежных картах.
            </div>
        </div>
    </div>
</div>