<?php
require_once('./DTO/DetailBillDTO.php');
require_once('./DAO/DetailBill.php');

$idDetailBill = $_REQUEST["idDetailBill"];
$detailBill = DetailBillDTO::getInstance()->GetDetailBill($idDetailBill);
$state = $detailBill->GetState();
if ($state == "Đang chờ xác nhận") {
    $state = "Đang giao hàng";
    $detailBill->SetState($state);
}
DetailBillDTO::getInstance()->UpdateDetailBill($detailBill);
$detailBill = DetailBillDTO::getInstance()->GetDetailBill($idDetailBill);
if ($detailBill->GetState() == "Đang giao hàng") 
    echo "true";
else
    echo "false";
