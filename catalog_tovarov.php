<?php
session_start();
require_once('db.php');
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

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
$categories = [];
$sql = "SELECT DISTINCT category FROM catalog";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['category'];
    }
}

$selectedCategory = isset($_POST['category']) ? $_POST['category'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/catalog_tovarov.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров</title>
</head>
<body>
<header>
<nav>
    <div class="left_buttons">
        <button onclick="window.location.href='main.php';" class="btn4">Главная страница</button>
        <button onclick="window.location.href='catalog.php';" class="btn4">Готовые ПК</button>
    </div>
    <button class="roum" onclick="window.location.href='buylist.php';">
        Корзина <?= $totalItems > 0 ? "($totalItems)" : "" ?>
    </button>
</nav>
</header>

<h1>Выбор категории</h1>
<form method="POST" action="">
    <select name="category" onchange="this.form.submit()" class="styled-select">
        <option value="">-- Выберите категорию --</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= htmlspecialchars($category) ?>" <?= $selectedCategory === $category ? 'selected' : '' ?>>
                <?= htmlspecialchars($category) ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<h2>Товары</h2>
<?php
if ($selectedCategory) {

    $stmt = $conn->prepare("SELECT ID, Name, Img, Price FROM catalog WHERE Category = ?");
    $stmt->bind_param("s", $selectedCategory);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0): ?>
        <ul>
            <?php while ($product = $result->fetch_assoc()): ?>
            <li>
              <img src="<?= htmlspecialchars($product['Img']) ?>" alt="<?= htmlspecialchars($product['Name']) ?>" class="product-image">
              <strong><?= htmlspecialchars($product['Name']) ?></strong><br>
              <p style="padding:20px;">Цена: <?= htmlspecialchars($product['Price']) ?>₽</p>
              <form action="add_to_cart.php" method="POST" style="display:inline;">
                  <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['ID']) ?>">
                  <input type="hidden" name="category" value="<?= htmlspecialchars($selectedCategory) ?>">
                  <button type="submit" class="add-button">Добавить в корзину</button>
              </form>
            </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>В выбранной категории нет товаров.</p>
    <?php endif;
    $stmt->close();
} else {
    echo "<p>Пожалуйста, выберите категорию для отображения товаров.</p>";
}

$conn->close();
?>
</body>
</html>
