<?php
require_once('./DAO/DetailBill.php');
require_once('DataProvider.php');
class DetailBillDTO
{
    public static $_instance = null;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new DetailBillDTO();
        }

        return self::$_instance;
    }

    function GetDetailBill($id)
    {
        $query = "Select * from DetailBill where id ='$id'";

        $result = DataProvider::getInstance()->Execute($query);

        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $row = $result->fetch_assoc();
            $detailBill = new DetailBill();
            $detailBill->SetId($row["id"])
                ->SetIdBill($row["idBill"])
                ->SetTotalPrice($row["totalPrice"])
                ->SetState($row["state"])
                ->SetDiscount($row["discount"])
                ->SetIdAddress($row["idAddress"]);
            return $detailBill;
        } else
            return null;
    }
    function CreateDetailBill($detailBill)
    {
        $idBill = $detailBill->GetIdBill();
        $totalPrice = $detailBill->GetTotalPrice();
        $state = $detailBill->GetState();
        $discount = $detailBill->GetDiscount();

        $query = "Insert into DetailBill (idBill, totalPrice, state,discount) 
         Values('$idBill','$totalPrice','$state','$discount')";
        $result = DataProvider::getInstance()->Execute($query);
        echo $query;
        return $result;
    }

    function UpdateDetailBill($detailBill)
    {
        $id = $detailBill->GetId();
        $idBill = $detailBill->GetIdBill();
        $totalPrice = $detailBill->GetTotalPrice();
        $state = $detailBill->GetState();
        $discount = $detailBill->GetDiscount();
        $idAddress = $detailBill->GetIdAddress();

        $query = "Update detailBill Set idBill='$idBill',totalPrice='$totalPrice',state = '$state',
        discount='$discount',
        idAddress='$idAddress' where id='$id'";
        $result = DataProvider::getInstance()->Execute($query);

        return $result;
    }
    function GetNewestDetailBill()
    {
        $query = "Select * from DetailBill order by id desc";

        $result = DataProvider::getInstance()->Execute($query);

        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $row = $result->fetch_assoc();
            $detailBill = new DetailBill();
            $detailBill->SetId($row["id"])
                ->SetIdBill($row["idBill"])
                ->SetTotalPrice($row["totalPrice"])
                ->SetState($row["state"])
                ->SetDiscount($row["discount"])
                ->SetIdAddress($row["idAddress"]);
            return $detailBill;
        } else
            return null;
    }
}
