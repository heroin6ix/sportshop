<?php include "app/views/layout.php"; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white text-center">
                    <h4><i class="fas fa-user-plus me-2"></i>Регистрация</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <form method="POST" action="/register/action">
                        <div class="mb-3">
                            <label class="form-label">Логин</label>
                            <input type="text" class="form-control" name="login" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Имя</label>
                            <input type="text" class="form-control" name="fullname" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Номер телефона</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Пароль (мин. 6 символов)</label>
                            <input type="password" class="form-control" name="password" minlength="6" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Подтвердите пароль</label>
                            <input type="password" class="form-control" name="password_confirm" minlength="6" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">
                                Я соглашаюсь с <a href="#" target="_blank">условиями использования</a> 
                                и <a href="#" target="_blank">политикой конфиденциальности</a>
                            </label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-user-plus me-2"></i>Зарегистрироваться
                            </button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <p class="mb-0">Уже есть аккаунт? <a href="/login">Войдите</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>