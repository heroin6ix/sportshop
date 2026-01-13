<?php // login
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['error' => 'Method not allowed'], 405);
}

$data = json_decode(file_get_contents('php://input'), true);

$login = $data['login'] ?? '';
$password = $data['password'] ?? '';

$stmt = $pdo->prepare("SELECT ID_Users, Login, Password, Role FROM Users WHERE Login = ?");
$stmt->execute([$login]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['Password'])) {
    jsonResponse(['error' => 'Invalid login or password'], 401);
}

//Временный token 
$token = bin2hex(random_bytes(32));

jsonResponse([
    'token' => $token,
    'user' => [
        'id' => $user['ID_Users'],
        'login' => $user['Login'],
        'role' => $user['Role']
    ]
]);

