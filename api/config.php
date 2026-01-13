<?php // PDO (подключение к бд) + headers(шапки)
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/response.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");