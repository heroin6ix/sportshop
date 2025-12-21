<?php include "app/views/layout.php"; ?>

<h1>Вход</h1>

<form action="/login/action" method="POST">
    Логин:<br>
    <input type="text" name="login" required><br><br>
    Пароль:
    <input type="text" name="password" required><br><br>
    <button type="submit">Войти</button>
</form>