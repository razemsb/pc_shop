<?php
$user = "root";
$password = "root";
$host = "localhost";
$db = "pc_shop";

// Создание соединения
$conn = new mysqli($host, $user, $password, $db);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка соединения: ".$conn->connect_error);
}
?>