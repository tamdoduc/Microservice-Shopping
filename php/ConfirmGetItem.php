<?php
require_once('./DTO/DetailBillDTO.php');
require_once('./DAO/DetailBill.php');
require_once('./DTO/BillDTO.php');
require_once('./DAO/Bill.php');
require_once('./DTO/ProductInBillDTO.php');
require_once('./DAO/ProductInBill.php');
require_once('./DTO/ProductDTO.php');
require_once('./DAO/Product.php');

$idDetailBill = $_REQUEST["idDetailBill"];
$detailBill = DetailBillDTO::getInstance()->GetDetailBill($idDetailBill);
$state = $detailBill->GetState();
if ($state == "Đang giao hàng") {
    $state = "Đã giao hàng";
    $detailBill->SetState($state);
}
DetailBillDTO::getInstance()->UpdateDetailBill($detailBill);
$detailBill = DetailBillDTO::getInstance()->GetDetailBill($idDetailBill);

if ($detailBill->GetState() == "Đã giao hàng") 
    echo "true";
else
    echo "false";

$idBill = $detailBill->GetIdBill();
$listProductInBill = ProductInBillDTO::getInstance()->GetListProductInBill($idBill);
for ($i = 0; $i < count($listProductInBill); $i++)
{
    $product = ProductDTO::GetProduct($listProductInBill[$i]->GetIdProduct());
    $product->SetCountSold($product->GetCountSold()+$listProductInBill[$i]->GetCount());
    ProductDTO::getInstance()->UpdateProduct($product);
    //$product->GetCountSold();
}
