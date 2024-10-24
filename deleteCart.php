<?php
    require_once "connection.php";
    $cartId = $_GET['id'];
    $sql = "DELETE FROM cart WHERE cart_id='$cartId'";
    $conn->query($sql);
    header('location: cart.php');
    die;
?>