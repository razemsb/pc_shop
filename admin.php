<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require 'db.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: index.php'); 
    exit();
}

$table = isset($_GET['table']) ? $_GET['table'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productImg = $_POST['product_img'];

    $stmt = $conn->prepare("UPDATE $table SET Name = ?, Price = ?, Img = ? WHERE ID = ?");
    $stmt->bind_param('sdsi', $productName, $productPrice, $productImg, $productId);
    
    if ($stmt->execute()) {
        echo "<script>alert('Товар обновлен успешно!')</script>";
    } else {
        echo "<p>Ошибка обновления товара: " . $conn->error . "</p>";
    }
    $stmt->close();
}

$products = [];
if ($table) {
    $query = "SELECT ID, Name, Price, Img FROM $table";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Управление товарами</title>
</head>
<body>
<header>
    <nav>
        <button onclick="window.location.href='main.php';" class="btn">На главную</button>
    </nav>
</header>

<div class="admin-container">
    <?php if (!$table): ?>
        <h1>Выберите таблицу для управления товарами</h1>
        <div class="table-select">
            <button onclick="window.location.href='?table=catalog';">Каталог товаров</button>
            <button onclick="window.location.href='?table=pc';">Готовые ПК</button>
        </div>
    <?php else: ?>
        <h1>Управление товарами (Таблица: <?= htmlspecialchars($table) ?>) <button onclick="window.location.href='?';" class="btn">Сбросить выбор</button><br></h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя товара</th>
                    <th>Цена</th>
                    <th>Изображение</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <form action="" method="POST">
                            <td><?= htmlspecialchars($product['ID']) ?></td>
                            <td><input type="text" name="product_name" value="<?= htmlspecialchars($product['Name']) ?>" required></td>
                            <td><input type="number" name="product_price" value="<?= htmlspecialchars($product['Price']) ?>" step="250" required></td>
                            <td><input type="text" name="product_img" value="<?= htmlspecialchars($product['Img']) ?>" required></td>
                            <td>
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['ID']) ?>">
                                <button type="submit">Сохранить</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
