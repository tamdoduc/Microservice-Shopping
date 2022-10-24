<?php
require_once('./DAO/Bill.php');
require_once('DataProvider.php');
class BillDTO
{
    public static $_instance = null;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new BillDTO();
        }

        return self::$_instance;
    }

    function GetBill($id)
    {
        $query = "SELECT * FROM Bill Where id = '$id'";
        $result = DataProvider::getInstance()->Execute($query);

        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $row = $result->fetch_assoc();
            $bill = new Bill();
            $bill->SetId($row["id"])
                ->SetIdAccount($row["idAccount"])
                ->SetIdDetailBill($row["idDetailBill"])
                ->SetTime($row["time"])
                ->SetIdAccountSeller($row["idAccountSeller"])
                ->SetCode($row["code"]);
            return $bill;
        } else
            return null;
    }
    function CreateBill($bill)
    {
        $idAccount = $bill->GetIdAccount();
        $time = $bill->GetTime();
        $code = $bill->GetCode();
        $idAccountSeller = $bill->GetIdAccountSeller();
        $query = "INSERT INTO bill (idAccount, time, code,idAccountSeller)
         values('$idAccount','$time','$code','$idAccountSeller')";
        echo $query;
        $result = DataProvider::getInstance()->Execute($query);
        return $result;
    }
    function UpdateBill($bill)
    {
        $id = $bill->GetId();
        $idAccount = $bill->GetIdAccount();
        $idDetailBill = $bill->GetIdDetailBill();
        $time = $bill->GetTime();
        $code = $bill->GetCode();
        $idAccountSeller = $bill->GetIdAccountSeller();

        $query = "UPDATE bill SET idAccount='$idAccount',
         idDetailBill='$idDetailBill',
          time='$time',
           code='$code',
           idAccountSeller='$idAccountSeller' where id='$id'";


        $result = DataProvider::getInstance()->Execute($query);
        return $result;
    }
    function GetNewestBill()
    {
        $query = "SELECT * FROM Bill order by id desc";
        $result = DataProvider::getInstance()->Execute($query);
        echo "<br>" . $query . "<br>";
        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $row = $result->fetch_assoc();
            $bill = new Bill();
            $bill->SetId($row["id"])
                ->SetIdAccount($row["idAccount"])
                ->SetIdDetailBill($row["idDetailBill"])
                ->SetTime($row["time"])
                ->SetIdAccountSeller($row["idAccountSeller"])
                ->SetCode($row["code"]);
            return $bill;
        } else
            return null;
    }
    function GetListBillByIdAccount($idAccount)
    {
        $query = "SELECT * FROM Bill Where idAccount = '$idAccount' order by time desc";
        $result = DataProvider::getInstance()->Execute($query);

        $listBill = array();

        $row = mysqli_num_rows($result);
        while (
            $row = $result->fetch_assoc()){
            $bill = new Bill();
            $bill->SetId($row["id"])
                ->SetIdAccount($row["idAccount"])
                ->SetIdDetailBill($row["idDetailBill"])
                ->SetTime($row["time"])
                ->SetIdAccountSeller($row["idAccountSeller"])
                ->SetCode($row["code"]);
            array_push($listBill,$bill);
        }
        return $listBill;
    }
    function GetListBillByIdAccountSeller($idAccountSeller)
    {
        $query = "SELECT * FROM Bill Where idAccountSeller = '$idAccountSeller' order by time desc";
        $result = DataProvider::getInstance()->Execute($query);

        $listBill = array();

        $row = mysqli_num_rows($result);
        while (
            $row = $result->fetch_assoc()){
            $bill = new Bill();
            $bill->SetId($row["id"])
                ->SetIdAccount($row["idAccount"])
                ->SetIdDetailBill($row["idDetailBill"])
                ->SetTime($row["time"])
                ->SetIdAccountSeller($row["idAccountSeller"])
                ->SetCode($row["code"]);
            array_push($listBill,$bill);
        }
        return $listBill;
    }
}
