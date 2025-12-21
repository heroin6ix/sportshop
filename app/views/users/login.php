<?php include "app/views/layout.php"; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white text-center">
                    <h4><i class="fas fa-sign-in-alt me-2"></i>Вход в аккаунт</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <form method="POST" action="/login/action">
                        <div class="mb-3">
                            <label class="form-label">Логин</label>
                            <input type="text" class="form-control" name="login" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Пароль</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success bg-success">
                                <i class="fas fa-sign-in-alt me-2"></i>Войти
                            </button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <p class="mb-0 " >Нет аккаунта? <a href="/register">Зарегистрируйтесь</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>