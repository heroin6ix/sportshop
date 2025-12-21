<?php include "app/views/layout.php"; ?>

<h1>Редактирование профиля</h1>

<form method="POST" action="/profile/update">

    <!-- ЛОГИН -->
    <label>Логин</label><br>
    <input 
        type="text"
        name="login"
        value="<?= htmlspecialchars($user['Login']) ?>"
        required
    >
    <br><br>

    <label>Фамилия Имя Отчество</label><br><!-- Имя -->
    <input
        type="text"
        name="fullname"
        value="<?= htmlspecialchars($user['FullName']) ?>"
        required
    >
    <br><br>

    <label>Номер телефона</label><br> <!-- Номер телефона -->
    <input
        type="text"
        name="phone"
        value="<?= htmlspecialchars($user['Phone']) ?>"
        required
    >
    <br><br>

    <!-- EMAIL -->
    <label>Email</label><br>
    <input
        type="email"
        name="email"
        value="<?= htmlspecialchars($user['Email']) ?>"
        required
    >
    <br><br>
    

    <button type="submit">Сохранить изменения</button>

</form>