<?php
require_once('./DAO/Product.php');
require_once('./DTO/ProductDTO.php');
require_once('./DAO/Color.php');
require_once('./DTO/ColorDTO.php');
require_once('./DTO/ImageProductDTO.php');
require_once('./DAO/ImageProduct.php');
error_reporting(E_ALL ^ E_NOTICE);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$idAccount = $_SESSION['idAccount'];
if ($idAccount == null || $idAccount == -1) {
    header("Location:Login.php");
} else {
    if (isset($_GET['idProduct'])) {
        $idProduct = $_GET['idProduct'];
        ProductDTO::getInstance()->DeleteProduct($idProduct);
        ImageProductDTO::getInstance()->DeleteImageProductByIdProduct($idProduct);
        ColorDTO::getInstance()->DeleteColorByIdProduct($idProduct);
        header("Location:yourStore.php");
    }
}
