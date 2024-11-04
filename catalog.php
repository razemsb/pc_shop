<?php
require_once('db.php');
session_start();
$totalItems = 0;

if (isset($_SESSION['cart_pc'])) {
    foreach ($_SESSION['cart_pc'] as $item) {
        $totalItems += $item['quantity'];
    }
}

if (isset($_SESSION['cart_components'])) {
    foreach ($_SESSION['cart_components'] as $item) {
        $totalItems += $item['quantity'];
    }
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ID, Name, Diss1, Diss2, Price, Img FROM pc";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="css/catalog.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог готовых ПК</title>
</head>
<body>
<header class="header">
    <nav class="nav-bar">
        <div class="nav-left">
            <a href="main.php" class="nav-link">На главную</a>
            <a href="catalog_tovarov.php" class="nav-link">Каталог комплектующих</a>
        </div>
        <button class="cart-btn" onclick="window.location.href='buylist.php';">
            Корзина <?= $totalItems > 0 ? "($totalItems)" : "" ?>
        </button>
    </nav>
</header>
<h1 class="zagolovok">Каталог готовых ПК</h1>
<main class="main-content">
    <div class="product-grid">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-card">';
                echo '<img src="' . htmlspecialchars($row['Img']) . '" alt="' . htmlspecialchars($row['Name']) . '" class="product-image">';
                echo '<h2 class="product-title">' . htmlspecialchars($row['Name']) . '</h2>';
                echo '<p class="product-description">' . htmlspecialchars($row['Diss1']) . '</p>';
                echo '<ul class="product-features">';
                
                $featuresArray = explode(',', $row['Diss2']);
                foreach ($featuresArray as $feature) {
                    echo '<li>' . htmlspecialchars(trim($feature)) . '</li>';
                }
                
                echo '</ul>';
                echo '<p class="product-price">Цена: ' . htmlspecialchars(number_format($row['Price'], 2, ',', ' ')) . '₽</p>';
                echo '<form action="add_to_cart.php" method="POST">';
                echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($row['ID']) . '">';
                echo '<input type="hidden" name="category" value="pcs">';
                echo '<button class="buy-button" type="submit">Добавить в корзину</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo '<p>Товары не найдены.</p>';
        }
        ?>
    </div>
</main>

<footer class="footer">
    <p>&copy; 2024 Enigma Hub. Все права защищены.</p>
</footer>

<?php
$conn->close();
?>
</body>
</html>
