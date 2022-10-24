<?php
require_once('./DAO/Product.php');
require_once('./DTO/ProductDTO.php');
require_once('./DTO/ProductInFavoriteDTO.php');
require_once('./DAO/ProductInFavorite.php');


$idProduct = $_REQUEST['idProduct'];
$idAccount = $_REQUEST['idAccount'];
$color = $_REQUEST['color'];

$productInFavorite = new ProductInFavorite();
if ($idAccount == null || $idAccount == -1)
    header("Location:login.php");
$productInFavorite->SetIdProduct($idProduct)->SetColor($color)->SetIdAccount($idAccount);

if (ProductInFavoriteDTO::getInstance()->IsExistProductInFavorite($productInFavorite)) {
    echo "true";
} else {
    if (ProductInFavoriteDTO::getInstance()->CreateProductInFavorite($productInFavorite))
        echo "true";
    else
        echo "false";
}
