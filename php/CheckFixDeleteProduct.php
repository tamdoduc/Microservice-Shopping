<?php 
require_once('./DTO/BillDTO.php');
require_once('./DAO/Bill.php');
require_once('./DTO/ProductInBillDTO.php');
require_once('./DAO/ProductInBill.php');
require_once('./DTO/ProductInCartDTO.php');
require_once('./DAO/ProductInCart.php');
require_once('./DTO/ProductInFavoriteDTO.php');
require_once('./DAO/ProductInFavorite.php');

$idProduct = $_REQUEST["idProduct"];
$c1 = ProductInCartDTO::getInstance()->CheckExistProduct($idProduct);
$c2 = ProductInFavoriteDTO::getInstance()->CheckExistProduct($idProduct);
$c3 = ProductInBillDTO::getInstance()->CheckExistProduct($idProduct);

if ($c1 || $c2 || $c3)
    echo "false";
else 
    echo "true";