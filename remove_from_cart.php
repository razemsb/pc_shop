<?php
if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // текущая корзина
    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

    // удаление товаров
    if (isset($cart[$productId])) {
        unset($cart[$productId]);
    }

    // сохранения корзины
    setcookie('cart', json_encode($cart), time() + (86400 * 30), "/");

    header('Location: buylist.php');
    exit();
} else {
    header('Location: buylist.php?error=1');
    exit();
}
