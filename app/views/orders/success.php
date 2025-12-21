<?php
// Сначала все логические операции - ДО ЛЮБОГО ВЫВОДА
$orderId = $_GET['order_id'] ?? null;

// Проверяем, что order_id передан и является числом
if (!$orderId || !ctype_digit($orderId)) {
    var_dump($orderId); exit;
    header("Location: /");
    exit;
}

$order = null;

if (isset($_SESSION['user_id'])) {
    global $pdo;
    
    // Проверяем, что заказ принадлежит пользователю
    $stmt = $pdo->prepare("SELECT ID_Orders FROM Orders WHERE ID_Orders = ? AND Users_ID = ?");
    $stmt->execute([$orderId, $_SESSION['user_id']]);
    $result = $stmt->fetch();
    
    if (!$result) {
        // Заказ не принадлежит пользователю или не существует
        header("Location: /");
        exit;
    }
    
    // Получаем детали заказа
    $stmt = $pdo->prepare("SELECT * FROM Orders WHERE ID_Orders = ?");
    $stmt->execute([$orderId]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$order) {
        header("Location: /");
        exit;
    }
} else {
    // Если пользователь не авторизован, но order_id есть
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM Orders WHERE ID_Orders = ?");
    $stmt->execute([$orderId]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$order) {
        header("Location: /");
        exit;
    }
}

// Определяем маппинг статусов
$statusLabels = [
    'pending' => 'На рассмотрении',
    'processing' => 'В Процессе',
    'shipped' => 'Отправлен',
    'delivered' => 'Доставлен',
    'cancelled' => 'Отменён'
];
?>

<?php include "app/views/layout.php"; ?>

<h1>Заказ успешно оформлен!</h1>

<p>Номер вашего заказа: <b><?= htmlspecialchars($orderId) ?></b></p>
<p>Сумма заказа: <?= number_format((float)$order['TotalAmount'], 2, ',', ' ') ?> ₽</p>
<p>Статус: <?= htmlspecialchars($statusLabels[$order['Status']] ?? $order['Status']) ?></p>

<p>Спасибо за покупку! Мы свяжемся с вами для подтверждения.</p>

<a href="/products">Вернуться в каталог</a>