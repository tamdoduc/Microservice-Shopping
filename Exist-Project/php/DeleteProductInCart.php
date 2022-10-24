<?php
require_once('./DAO/Product.php');
require_once('./DTO/ProductDTO.php');
require_once('./DTO/ProductInCartDTO.php');
require_once('./DAO/ProductInCart.php');


$idProduct = $_REQUEST['idProduct'];
$idAccount = $_REQUEST['idAccount'];
$color = $_REQUEST['color'];

$productInCart = new ProductInCart();
$productInCart->SetIdProduct($idProduct)->SetColor($color)->SetIdAccount($idAccount);

if (ProductInCartDTO::getInstance()->DeleteProductInCart($idAccount, $idProduct,$color)) {
    echo "true";
} else
    echo "false";
