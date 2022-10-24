<?php
require_once('./DAO/Product.php');
require_once('./DTO/ProductDTO.php');
require_once('./DTO/ProductInCartDTO.php');
require_once('./DAO/ProductInCart.php');


$idProduct = $_REQUEST['idProduct'];
$idAccount = $_REQUEST['idAccount'];
$count = $_REQUEST['count'];
$color = $_REQUEST['color'];

$productInCart = new ProductInCart();
if ($idAccount == null || $idAccount == -1)
    header("Location:login.php");
$productInCart->SetIdProduct($idProduct)->SetCount($count)->SetColor($color)->SetIdAccount($idAccount);
if (ProductInCartDTO::getInstance()->IsExistProductInCart($productInCart)) {
    $productInCartOld = ProductInCartDTO::getInstance()->GetProductInCartByIdAccountAndIdProduct($productInCart);
    $productInCartOld->SetCount($productInCart->GetCount() + $productInCartOld->GetCount());
    if (ProductInCartDTO::getInstance()->UpdateProductInCart($productInCartOld))
        echo "true";
} else
if (ProductInCartDTO::getInstance()->CreateProductInCart($productInCart)) {
    echo "true";
} else
    echo "false";
