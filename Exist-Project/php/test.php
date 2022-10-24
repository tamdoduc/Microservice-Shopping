<?php
require_once('./DTO/DetailBillDTO.php');
require_once('./DAO/DetailBill.php');

echo "<script>alert('2222')</script>";
$idDetailBill = $_REQUEST["idDetailBill"];
$detailBill = DetailBillDTO::getInstance()->GetDetailBill($idDetailBill);
$state = $detailBill->GetState();
if ($state == "Đang chờ xác nhận") {
    $state = "Đã hủy";
    $detailBill->SetState($state);
}
DetailBillDTO::getInstance()->UpdateDetailBill($detailBill);
echo "<script>alert('2222')</script>";
echo $state;
