<?php // API router
require_once 'config.php';

$endpoint = $_GET['endpoint'] ?? '';

switch ($endpoint) {
    case 'login':
        require 'auth.php';
        break;
    case 'products':
        require 'products.php';
        break;
    case 'order':
        require 'order.php';
        break;
    case 'orders':
        require 'orders.php';
        break;
    default:
        jsonResponse(['error' => 'Unknown endpoint'], 404);
}