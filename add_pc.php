<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $diss1 = mysqli_real_escape_string($conn, $_POST['diss1']);
    $diss2 = mysqli_real_escape_string($conn, $_POST['diss2']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $img = mysqli_real_escape_string($conn, $_POST['img']);

    $query = "INSERT INTO pc (Name, Diss1, Diss2, Price, Img) VALUES ('$name', '$diss1', '$diss2', '$price', '$img')";
    
    if (mysqli_query($conn, $query)) {

        header('Location: admin.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
