<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['idAccount'] = -1;
    unset($_SESSION['idAccount']);
    header("Location:login.php");
?>