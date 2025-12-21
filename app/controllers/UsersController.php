<?php
require_once "app/models/Users.php";
class UsersController { 
    public function register() { //Показать форму регистрации
        $pageTitle = "Регистрация"; 
        require "app/views/users/register.php";
    }
    public function registerAction() { //Обработать данных из регистрации

        global $pdo;

        $login = $_POST['login']; //Получаем данные из формы
        $fullname = $_POST['fullname']; 
        $phone = $_POST['phone'];
        $email = $_POST['email']; 
        $password = $_POST['password'];


        if (Users::findByLogin($login)) { //Проверяем, что логина не существует
            echo "Пользователь с таким логином уже существует!";
            return;
        }
        if (Users::findByFullname($fullname)) { //Проверяем, что ФИО не существует
            echo "Пользователь с таким именем уже существует!";
            return;
        }
        if (Users::findByPhone($phone)) { //Проверяем, что телефона не существует
            echo "Пользователь с таким номером телефона уже существует!";
            return;
        }
        if (Users::findByEmail($email)) { //Проверяем, что почты не существует
            echo "Пользователь с таким email уже существует!";
            return;
        }

        
        $hashed = password_hash($password, PASSWORD_DEFAULT); //хеш пароля
        
        Users::create($login, $fullname, $phone, $email, $hashed); // добавляем юзера

        require "app/views/main/index.php";

    }
    public function login() { //показать форму входа
        $pageTitle = "Вход";
        require "app/views/users/login.php";
    }
    public function loginAction() { // обработка входа
        session_start();

        $login = $_POST['login'];
        $password = $_POST['password'];

        $user = Users::findByLogin($login); //ищем юзера по логину

        if (!$user || !password_verify($password, $user['Password'])) {
            echo "Неверный логин или пароль!";
            return;
        }
    
        $_SESSION['user_id'] = $user['ID_Users'];
        $_SESSION['role'] = $user['Role'];
    
        require "app/views/main/index.php";

    }
    public function profile() { //показать профиль
        if (empty($_SESSION['user_id'])) {
            header("Location: /login"); exit;
        }
        $user = Users::findById($_SESSION['user_id']);
        $pageTitle = "Личный кабинет";
        require "app/views/users/profile.php";
    }
    public function editProfile() { //редактировать профиль
        if (empty($_SESSION['user_id'])) {
            header("Location: /login"); exit;
        }
        $user = Users::findById($_SESSION['user_id']);
        $pageTitle = "Редактирование профиля";
        require "app/views/users/edit_profile.php";
    }
    public function updateProfile() { //обновить профиль
        global $pdo;
        if (empty($_SESSION['user_id'])) { 
            header("Location: /login"); exit; }

        $login = $_POST['login'];
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
            // Тут можно добавить валидацию
        
        Users::update($_SESSION['user_id'], $login, $fullname, $phone, $email);
        header("Location: /profile"); exit;
}
    public function logout() {
        session_destroy();
        session_start(); 
        $_SESSION['success'] = "Вы успешно вышли из аккаунта.";
        header("Location: /");
        exit;
    }
}
?>