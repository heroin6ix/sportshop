<?php
class Users {
    public static function findByEmail($email) { //Функция найти по почте
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM Users WHERE Email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function findByLogin($login) { //Функция найти по логину
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM Users WHERE Login = ?");
        $stmt->execute([$login]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function findByFullname($fullname) { //Функция найти по фио
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM Users WHERE FullName = ?");
        $stmt->execute([$fullname]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function findByPhone($phone) { //Функция найти по телефону
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM Users WHERE Phone = ?");
        $stmt->execute([$phone]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function findById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM Users WHERE ID_Users = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function update($id, $login, $fullname, $phone, $email) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Users SET Login = ?,  FullName = ?, Phone = ?, Email = ? WHERE ID_Users = ?");
        return $stmt->execute([$login, $fullname, $phone, $email, $id]);
    }
    public static function create($login, $fullname, $phone, $email, $hashedPassword) { //Создать юзера
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO Users (Login, FullName, Phone, Email, Password, Role) VALUES (?, ?, ?, ?, ?, 'user')");
        $stmt->execute([$login, $fullname, $phone, $email, $hashedPassword]);
    }

}
?>