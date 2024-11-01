<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require 'db.php'; // Подключение к базе данных

$cartPc = isset($_SESSION['cart_pc']) ? $_SESSION['cart_pc'] : [];
$cartComponents = isset($_SESSION['cart_components']) ? $_SESSION['cart_components'] : [];

// Получение данных о товарах из базы данных
$products = [];
$query = "SELECT ID, Name, Img, Price FROM catalog";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $products[$row['ID']] = [
        'Name' => $row['Name'],
        'Img' => $row['Img'],
        'Price' => $row['Price']
    ];
}

// Получение данных о готовых ПК
$queryPc = "SELECT ID, Name, Img, Price FROM pc"; // Предполагается, что ПК находятся в таблице pc
$resultPc = mysqli_query($conn, $queryPc);

while ($rowPc = mysqli_fetch_assoc($resultPc)) {
    $products[$rowPc['ID']] = [
        'Name' => $rowPc['Name'],
        'Img' => $rowPc['Img'],
        'Price' => $rowPc['Price']
    ];
}

$totalPc = 0;
$totalComponents = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    
    // Удаление товара из корзины ПК
    if (isset($cartPc[$productId])) {
        unset($cartPc[$productId]);
        $_SESSION['cart_pc'] = $cartPc;
    }
    // Удаление товара из корзины комплектующих
    if (isset($cartComponents[$productId])) {
        unset($cartComponents[$productId]);
        $_SESSION['cart_components'] = $cartComponents;
    }

    header('Location: buylist.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="css/buylist.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
</head>
<body>
<header>
<nav>
    <div class="left_buttons">
        <button onclick="window.location.href='main.php';" class="btn4">Главная страница</button>
        <button onclick="window.location.href='catalog.php';" class="btn">Готовые ПК</button>
        <button onclick="window.location.href='catalog_tovarov.php';" class="btn">Каталог комплектующих</button>
    </div>
</nav>
</header>

<div class="cart-container">
    <h1>Содержимое корзины</h1>
    
    <div class="cart-section">
        <h2>Готовые ПК</h2>
        <?php if (empty($cartPc)): ?>
            <p>Корзина ПК пуста.</p>
        <?php else: ?>
            <ul class="cart-list">
                <?php foreach ($cartPc as $productId => $item): ?>
                    <?php $totalPc += $products[$productId]['Price'] * $item['quantity']; ?>
                    <li class="cart-item">
                        <img src="<?= htmlspecialchars($products[$productId]['Img']) ?>" alt="<?= htmlspecialchars($products[$productId]['Name']) ?>" class="product-image">
                        <div class="product-details">
                            <p>Товар: <strong><?= htmlspecialchars($products[$productId]['Name']) ?></strong></p>
                            <p>Количество: <?= htmlspecialchars($item['quantity']) ?></p>
                            <p>Цена за единицу: <?= htmlspecialchars($products[$productId]['Price']) ?>₽</p>
                            <p>Общая цена: <?= htmlspecialchars($products[$productId]['Price'] * $item['quantity']) ?>₽</p>
                        </div>
                        <form action="" method="POST" class="remove-form">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($productId) ?>">
                            <button type="submit" class="remove-button">Удалить</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    
    <div class="cart-section">
        <h2>Компоненты</h2>
        <?php if (empty($cartComponents)): ?>
            <p>Корзина компонентов пуста.</p>
        <?php else: ?>
            <ul class="cart-list">
                <?php foreach ($cartComponents as $productId => $item): ?>
                    <?php $totalComponents += $products[$productId]['Price'] * $item['quantity']; ?>
                    <li class="cart-item">
                        <img src="<?= htmlspecialchars($products[$productId]['Img']) ?>" alt="<?= htmlspecialchars($products[$productId]['Name']) ?>" class="product-image">
                        <div class="product-details">
                            <p>Товар: <strong><?= htmlspecialchars($products[$productId]['Name']) ?></strong></p>
                            <p>Количество: <?= htmlspecialchars($item['quantity']) ?></p>
                            <p>Цена за единицу: <?= htmlspecialchars($products[$productId]['Price']) ?>₽</p>
                            <p>Общая цена: <?= htmlspecialchars($products[$productId]['Price'] * $item['quantity']) ?>₽</p>
                        </div>
                        <form action="" method="POST" class="remove-form">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($productId) ?>">
                            <button type="submit" class="remove-button">Удалить</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="total-summary">
        <p>Всего к оплате за ПК: <span class="total-amount"><?= htmlspecialchars($totalPc) ?>₽</span></p>
        <p>Всего к оплате за компоненты: <span class="total-amount"><?= htmlspecialchars($totalComponents) ?>₽</span></p>
        <p>Общая сумма: <span class="total-amount"><?= htmlspecialchars($totalPc + $totalComponents) ?>₽</span></p>
    </div>
    
    <button class="order-button" onclick="alert('Функция заказа временно не работает')">Заказать</button>
</div>

<footer>
    <p>&copy; 2024 enigma-hub. Все права защищены.</p>
</footer>
</body>
</html>