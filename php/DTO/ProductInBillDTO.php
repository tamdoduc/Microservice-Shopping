<?php
require_once('./DAO/ProductInBill.php');
require_once('DataProvider.php');
class ProductInBillDTO
{
    public static $_instance = null;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new ProductInBillDTO();
        }
        return self::$_instance;
    }

    function GetProductInBill($idBill, $idProduct)
    {
        $query = "Select * from ProductInBill where idBill='$idBill' and idProduct='$idProduct'";
        $result = DataProvider::getInstance()->Execute($query);

        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $row = $result->fetch_assoc();
            $productInBill = new ProductInBill();
            $productInBill->SetIdBill($row["idBill"])
                ->SetIdProduct($row["idProduct"])
                ->SetCount($row["count"])
                ->SetColor($row["color"])
                ->SetIdEvalute($row["idEvalute"]);
            return $productInBill;
        } else
            return null;
    }
    function GetListProductInBill($idBill)
    {
        $query = "Select * from ProductInBill where idBill='$idBill'";
        $result = DataProvider::getInstance()->Execute($query);

        $listProductInBill = array();
        $row = mysqli_num_rows($result);
        while ($row = $result->fetch_assoc()) {
            $productInBill = new ProductInBill();
            $productInBill->SetIdBill($row["idBill"])
                ->SetIdProduct($row["idProduct"])
                ->SetCount($row["count"])
                ->SetColor($row["color"])
                ->SetIdEvalute($row["idEvalute"]);
            array_push($listProductInBill, $productInBill);
        }
        return $listProductInBill;
    }
    function CreateProductInBill($productInBill)
    {
        $idBill = $productInBill->GetIdBill();
        $idProduct = $productInBill->GetIdProduct();
        $count = $productInBill->GetCount();
        $color = $productInBill->GetColor();

        $query = "INSERT INTO ProductInBill (idProduct, count,idBill,color)
        values('$idProduct', '$count','$idBill','$color')";
        $result = DataProvider::getInstance()->Execute($query);
        echo "<br>" . $query . "<br>";
        return $result;
    }
    function UpdateProductInBill($productInBill)
    {
        $idBill = $productInBill->GetIdBill();
        $idProduct = $productInBill->GetIdProduct();
        $idEvalute = $productInBill->GetIdEvalute();
        $color = $productInBill->GetColor();

        $query = "Update ProductInBill set idEvalute='$idEvalute'
         where idBill='$idBill' and idProduct='$idProduct' and color='$color'";
        $result = DataProvider::getInstance()->Execute($query);

        return $result;
    }
    function CheckExistProduct($idProduct)
    {
        $query = "select * from ProductInBill where idProduct='$idProduct' limit 1";
        $result = DataProvider::getInstance()->Execute($query);
        $row = mysqli_num_rows($result);
        if ($row > 0)
            return true;
        else return false;
    }
}
