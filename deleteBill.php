<?php
    require_once "connection.php";
    $idBill = $_GET['id'];
    $sql = "DELETE FROM bill WHERE bill_id='$idBill'";
    $conn->query($sql);
    header('location: listBill.php');
    die;
?>