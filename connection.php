<?php
    $host = "localhost";
    $username ="root";
    $password ="Nam20022003@";
    $dbname ="lpc_24/7";
    try{
        $conn = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
    }catch(PDOException $e){
        echo "Lỗi kết nối CSDL: " . $e->getMessage();
    }
?>