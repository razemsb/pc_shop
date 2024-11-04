<?php
session_start();
require 'db.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: main.php');
    exit();
}

$components = [];
$pcs = [];
$users = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['type'])) {
    if ($_POST['type'] === 'component') {
        $id = intval($_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $price = floatval($_POST['price']);
        $img = mysqli_real_escape_string($conn, $_POST['img']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        
        $updateQuery = "UPDATE catalog SET Name='$name', Price='$price', Img='$img', Category='$category' WHERE ID=$id";
        mysqli_query($conn, $updateQuery);
    } elseif ($_POST['type'] === 'pc') {
        $id = intval($_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $diss1 = mysqli_real_escape_string($conn, $_POST['diss1']);
        $diss2 = mysqli_real_escape_string($conn, $_POST['diss2']);
        $price = floatval($_POST['price']);
        $img = mysqli_real_escape_string($conn, $_POST['img']);
        
        $updateQuery = "UPDATE pc SET Name='$name', Diss1='$diss1', Diss2='$diss2', Price='$price', Img='$img' WHERE ID=$id";
        mysqli_query($conn, $updateQuery);
    }
}

if (isset($_POST['delete_id']) && isset($_POST['delete_type'])) {
    if ($_POST['delete_type'] === 'component') {
        $delete_id = intval($_POST['delete_id']);
        $deleteQuery = "DELETE FROM catalog WHERE ID=$delete_id";
        mysqli_query($conn, $deleteQuery);
    } elseif ($_POST['delete_type'] === 'pc') {
        $delete_id = intval($_POST['delete_id']);
        $deleteQuery = "DELETE FROM pc WHERE ID=$delete_id";
        mysqli_query($conn, $deleteQuery);
    }
}

$query = "SELECT ID, Name, Price, Img, Category FROM catalog";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $components[] = $row;
}

$query = "SELECT ID, Name, Diss1, Diss2, Price, Img FROM pc";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $pcs[] = $row;
}

$query = "SELECT ID, Login, Email, is_admin FROM users";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админка - Управление сайтом</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<header>
    <h1>Админка</h1>
    <nav>
        <button class="nav-button" onclick="window.location.href='main.php';">Главная</button>
        <button class="nav-button" onclick="showSection('edit-components')">Редактирование комплектующих</button>
        <button class="nav-button" onclick="showSection('edit-pcs')">Редактирование ПК</button>
        <button class="nav-button" onclick="showSection('manage-users')">Управление пользователями</button>
        <button class="nav-button" onclick="showSection('add-component')">Добавление комплектующих</button>
        <button class="nav-button" onclick="showSection('add-pc')">Добавление ПК</button>
    </nav>
</header>

<div id="edit-components" class="section">
    <h2>Редактирование комплектующих</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Цена</th>
                <th>Изображение</th>
                <th>Категория</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($components as $component): ?>
                <tr>
                    <form action="" method="POST">
                        <td><?= htmlspecialchars($component['ID']) ?></td>
                        <td><input type="text" name="name" value="<?= htmlspecialchars($component['Name']) ?>" required></td>
                        <td><input type="number" name="price" value="<?= htmlspecialchars($component['Price']) ?>" step="100" required></td>
                        <td><input type="text" name="img" value="<?= htmlspecialchars($component['Img']) ?>" required></td>
                        <td><input type="text" name="category" value="<?= htmlspecialchars($component['Category']) ?>" required></td>
                        <td>
                            <input type="hidden" name="id" value="<?= htmlspecialchars($component['ID']) ?>">
                            <input type="hidden" name="type" value="component">
                            <button type="submit">Сохранить</button>
                        <input type="hidden" name="delete_id" value="<?= htmlspecialchars($component['ID']) ?>">
                        <input type="hidden" name="delete_type" value="component">
                        <button type="submit" class="delete" onclick="return confirm('Вы уверены, что хотите удалить этот компонент?');">Удалить</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="edit-pcs" class="section">
    <h2>Редактирование ПК</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Описание 1</th>
                <th>Описание 2</th>
                <th>Цена</th>
                <th>Изображение</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pcs as $pc): ?>
                <tr>
                    <form action="" method="POST">
                        <td><?= htmlspecialchars($pc['ID']) ?></td>
                        <td><input type="text" name="name" value="<?= htmlspecialchars($pc['Name']) ?>" required></td>
                        <td><input type="text" name="diss1" value="<?= htmlspecialchars($pc['Diss1']) ?>" required></td>
                        <td><input type="text" name="diss2" value="<?= htmlspecialchars($pc['Diss2']) ?>" required></td>
                        <td><input type="number" name="price" value="<?= htmlspecialchars($pc['Price']) ?>" step="1000" required></td>
                        <td><input type="text" name="img" value="<?= htmlspecialchars($pc['Img']) ?>" required></td>
                        <td>
                            <input type="hidden" name="id" value="<?= htmlspecialchars($pc['ID']) ?>">
                            <input type="hidden" name="type" value="pc">
                            <button type="submit">Сохранить</button>
                        <input type="hidden" name="delete_id" value="<?= htmlspecialchars($pc['ID']) ?>">
                        <input type="hidden" name="delete_type" value="pc">
                        <button type="submit" class="delete" onclick="return confirm('Вы уверены, что хотите удалить этот ПК?');">Удалить</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="manage-users" class="section">
    <h2>Управление пользователями</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Логин</th>
                <th>Email</th>
                <th>Админ</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['ID']) ?></td>
                    <td><?= htmlspecialchars($user['Login']) ?></td>
                    <td><?= htmlspecialchars($user['Email']) ?></td>
                    <td><?= $user['is_admin'] ? 'Да' : 'Нет' ?></td>
                    <td>
                        <form action="delete_user.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($user['ID']) ?>">
                            <button type="submit" class="delete">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="add-component" class="section">
    <h2>Добавление комплектующих</h2>
    <form action="add_component.php" method="POST">
        <label>Имя: <input type="text" name="name" required></label><br>
        <label>Цена: <input type="number" name="price" step="100" required></label><br>
        <label>Изображение: <input type="text" name="img" required></label><br>
        <label>Категория: <input type="text" name="category" required></label><br>
        <button type="submit">Добавить</button>
    </form>
</div>

<div id="add-pc" class="section">
    <h2>Добавление ПК</h2>
    <form action="add_pc.php" method="POST">
        <label>Название: <input type="text" name="name" required></label><br>
        <label>Описание 1: <input type="text" name="diss1" required></label><br>
        <label>Описание 2: <input type="text" name="diss2" required></label><br>
        <label>Цена: <input type="number" name="price" step="1000" required></label><br>
        <label>Картинка: <input type="text" name="img" required></label><br>
        <button type="submit">Добавить</button>
    </form>
</div>

<script src="script/section.js"></script>
</body>
</html>
