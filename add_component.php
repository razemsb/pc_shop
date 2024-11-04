<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $img = mysqli_real_escape_string($conn, $_POST['img']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    $query = "INSERT INTO catalog (Name, Price, Img, Category) VALUES ('$name', '$price', '$img', '$category')";
    
    if (mysqli_query($conn, $query)) {

        header('Location: admin.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
