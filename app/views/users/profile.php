<?php include "app/views/layout.php"; ?>
<h1>Профиль</h1>
<p>Логин: <?= htmlspecialchars($user['Login']) ?> </p>
<p>Имя: <?= htmlspecialchars($user['FullName']) ?> </p>
<p>Номер телефона: <?= htmlspecialchars($user['Phone']) ?> </p>
<p>Email: <?= htmlspecialchars($user['Email']) ?> </p>
<a href="/profile/edit">Редактировать</a>