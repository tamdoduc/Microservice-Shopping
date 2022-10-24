<?php
require_once('./DAO/Product.php');
require_once('./DTO/ProductDTO.php');
require_once('./DTO/ProductInFavoriteDTO.php');
require_once('./DAO/ProductInFavorite.php');


$idProduct = $_REQUEST['idProduct'];
$idAccount = $_REQUEST['idAccount'];
$color = $_REQUEST['color'];

$productInFavorite = new ProductInFavorite();
$productInFavorite->SetIdProduct($idProduct)->SetColor($color)->SetIdAccount($idAccount);

if (ProductInFavoriteDTO::getInstance()->DeleteProductInFavorite($productInFavorite)) {
    echo "true";
} else
    echo "false";
