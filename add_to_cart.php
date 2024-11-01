<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('db.php'); // Подключение к базе данных

// Проверка, был ли отправлен ID продукта и категория
if (isset($_POST['product_id']) && isset($_POST['category'])) {
    $productId = (int)$_POST['product_id'];
    $category = $_POST['category'];

    // Защита от SQL-инъекций через подготовку запроса
    if ($category === 'pcs') {
        // Если продукт из столбца PC, используем таблицу pc
        if ($stmt = $conn->prepare("SELECT * FROM pc WHERE ID = ?")) {
            $stmt->bind_param('i', $productId);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
        }
    } else {
        // Если продукт из столбца комплектующих, используем таблицу catalog
        if ($stmt = $conn->prepare("SELECT * FROM catalog WHERE ID = ?")) {
            $stmt->bind_param('i', $productId);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
        }
    }

    if ($product) {
        if (!isset($_SESSION['cart_components'])) {
            $_SESSION['cart_components'] = [];
        }
        if (!isset($_SESSION['cart_pc'])) {
            $_SESSION['cart_pc'] = [];
        }

        // Определение типа корзины
        $cartKey = $category === 'pcs' ? 'cart_pc' : 'cart_components';
        $product['quantity'] = 1;

        // Добавление в корзину
        if (isset($_SESSION[$cartKey][$productId])) {
            $_SESSION[$cartKey][$productId]['quantity']++;
        } else {
            $_SESSION[$cartKey][$productId] = $product;
        }

        // Закрытие подготовленного запроса
        $stmt->close();
    } else {
        echo "Продукт не найден.";
    }

    header('Location: buylist.php');
    exit();
} else {
    header('Location: buylist.php');
    exit();
}
?>
