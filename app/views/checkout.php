<?php include "app/views/layout.php";
$payment = '' 
?>

<h1>Оформление заказа</h1>

<form action="/checkout/action" method="POST">
    Адрес доставки:<br>
    <input type="text" name="address" required><br><br>
    Комментарий к заказу: <br>
    <input type="text" name="comment" required><br><br>
    Метод оплаты:
    <input type="radio" name="payment" value="OnlineCard" required> Картой онлайн
    <input type="radio" name="payment" value="UponReceipt">При получении
    <br><br>
    <button type="submit">Оформить заказ</button>
</form>