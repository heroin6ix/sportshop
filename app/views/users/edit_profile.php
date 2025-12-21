<?php include "app/views/layout.php"; ?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Редактировать профиль</h1>
        <a href="/profile" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Назад
        </a>
    </div>

    <div class "card" style="max-width: 600px;">
        <div class="card-body">
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form method="POST" action="/profile/update">
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
                    <input type="text" class="form-control" name="phone"  required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Новый пароль (оставьте пустым, чтобы не менять)</label>
                    <input type="password" class="form-control" name="password" minlength="6">
                </div>
                <div class="mb-3">
                    <label class="form-label">Подтвердите новый пароль</label>
                    <input type="password" class="form-control" name="password_confirm" minlength="6">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Сохранить изменения
                    </button>
                    <a href="/profile" class="btn btn-secondary">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</div>