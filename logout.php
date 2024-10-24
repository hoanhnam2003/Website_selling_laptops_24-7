<?php
    setcookie("userId", "", time() - 60 * 60);
    setcookie("email", "", time() - 60 * 60);
    setcookie("role", "", time() - 60 * 60);
    header("location: home.php");
?>