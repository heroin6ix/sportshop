<?php include "app/views/layout.php"; ?>

<h1>Регистрация</h1>

<form action="/register/action" method="POST">
    Логин:<br>
    <input type="text" name="login" required><br><br>
    Фамилия Имя Отчество:<br>
    <input type="text" name="fullname" required><br><br>
    Номер телефона:<br>
    <input type="text" name="phone" required><br><br>
    Email: <br>
    <input type="text" name="email" required><br><br>
    Пароль:<br>
    <input type="text" name="password" required><br><br>
    <button type="submit">Зарегистрироваться</button>
</form>
