<?php
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
$user_login = $_SESSION['user_login'] ?? null;
$is_admin = $_SESSION['is_admin'] ?? false;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="css/main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enigma Hub - Главная</title>
</head>
<body>
<header class="header">
    <nav class="nav-bar">
        <div class="nav-left">
            <a href="catalog.php" class="nav-link">Каталог ПК</a>
            <a href="catalog_tovarov.php" class="nav-link">Каталог Комплектующих</a>
            <a href="#about" class="nav-link">О нас</a>
        </div>
        <div class="nav-right">
            <?php if ($user_login): ?>
                <span class="user-name"><?= htmlspecialchars($user_login) ?></span>
                <a href="session_destroy.php" class="btn logout-btn">Выйти</a>
                <?php if ($is_admin): ?>
                    <a href="admin.php" class="btn admin-btn">Админ</a>
                <?php endif; ?>
            <?php else: ?>
                <a href="index.html" class="btn register-btn">Регистрация/Авторизация</a>
            <?php endif; ?>
            <button class="btn logout-btn" onclick="window.location.href='buylist.php';">
                Корзина <?= $totalItems > 0 ? "($totalItems)" : "" ?>
            </button>
        </div>
    </nav>
</header>
<main class="main-content">
    <section class="welcome-section">
        <h1>Добро пожаловать в Enigma Hub</h1>
        <p>Лучшие компьютеры и комплектующие для вас.</p>
        <button class="btn explore-btn" onclick="window.location.href='catalog.php';">Исследовать каталог</button>
    </section>
    <section class="info-section">
        <h2 id="about">Почему выбирают нас?</h2>
        <div class="info-grid">
            <div class="info-item">
                <h3>Широкий выбор</h3>
                <p>У нас вы найдете готовые ПК, а также все необходимые компоненты для сборки вашего идеального компьютера.</p>
            </div>
            <div class="info-item">
                <h3>Качество и надежность</h3>
                <p>Мы работаем только с проверенными производителями и гарантируем высокое качество всех товаров.</p>
            </div>
            <div class="info-item">
                <h3>Конкурентные цены</h3>
                <p>Мы предлагаем лучшие цены на рынке, чтобы вы могли получить отличные товары по доступной стоимости.</p>
            </div>
            <div class="info-item">
                <h3>Отличное обслуживание</h3>
                <p>Наша команда всегда готова помочь вам с выбором и ответить на все ваши вопросы.</p>
            </div>
        </div>
    </section>
    <section class="catalog-section">
        <h2>Исследуйте наш каталог</h2>
        <p>Мы предлагаем разнообразные модели компьютеров, видеокарт, процессоров, материнских плат, оперативной памяти, SSD и других компонентов. Независимо от того, собираете ли вы новый ПК или ищете обновление для существующей системы, у нас есть все необходимое.</p>
        <p>Не пропустите наши акции и распродажи, чтобы сэкономить на покупке. Подписывайтесь на нашу рассылку, чтобы первыми узнавать о новых поступлениях и специальных предложениях.</p>
    </section>
</main>
<footer class="footer">
    <p>&copy; 2024 Enigma Hub. Все права защищены.</p>
</footer>
</body>
</html>
