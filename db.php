<?php
$user = "root";
$password = "root";
$host = "localhost";
$db = "pc_shop";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Ошибка соединения: ".$conn->connect_error);
}
?>