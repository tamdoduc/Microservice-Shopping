<?php
require_once('./DAO/ProductInFavorite.php');
require_once('DataProvider.php');
class ProductInFavoriteDTO
{
    public static $_instance = null;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new ProductInFavoriteDTO();
        }

        return self::$_instance;
    }
    function GetProductInFavorite($id)
    {
        $query = "Select * from ProductInFavorite where id='$id'";
        $result = DataProvider::getInstance()->Execute($query);

        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $row = $result->fetch_assoc();
            $productInFavorite = new ProductInFavorite();
            $productInFavorite->SetIdAccount($row["idAccount"])
                ->SetIdProduct($row["idProduct"])
                ->SetColor($row["color"]);
            return $productInFavorite;
        } else
            return null;
    }
    function GetListProductInFavorite($idAccount)
    {
        $query = "Select * from ProductInFavorite where idAccount='$idAccount'";
        $result = DataProvider::getInstance()->Execute($query);
        $listProductInFavorite = array();
        $row = mysqli_num_rows($result);
        while ($row = $result->fetch_assoc()) {
            $productInFavorite = new ProductInFavorite();
            $productInFavorite->SetIdAccount($row["idAccount"])
                ->SetIdProduct($row["idProduct"])
                ->SetColor($row["color"]);
            array_push($listProductInFavorite, $productInFavorite);
        }
        return $listProductInFavorite;
    }
    function CreateProductInFavorite($productInFavorite)
    {
        $idProduct = $productInFavorite->GetIdProduct();
        $idAccount = $productInFavorite->GetIdAccount();
        $color = $productInFavorite->GetColor();

        $query = "INSERT INTO ProductInFavorite (idProduct, color,idAccount)
        values('$idProduct', '$color','$idAccount')";
        $result = DataProvider::getInstance()->Execute($query);
        return $result;
    }
    function CheckExistProduct($idProduct)
    {
        $query = "select * from ProductInFavorite where idProduct='$idProduct' limit 1";
        $result = DataProvider::getInstance()->Execute($query);
        $row = mysqli_num_rows($result);
        if ($row > 0)
            return true;
        else return false;
    }
    function IsExistProductInFavorite($productInFavorite)
    {
        $idProduct = $productInFavorite->GetIdProduct();
        $idAccount = $productInFavorite->GetIdAccount();
        $color = $productInFavorite->GetColor();
        $query = "SELECT * FROM productInFavorite where idProduct='$idProduct' and idAccount='$idAccount' and color='$color'";
        $result = DataProvider::getInstance()->Execute($query);
        $row = mysqli_num_rows($result);
        if ($row > 0)
          return true;
        else
          return false;
    }
    function DeleteProductInFavorite($productInFavorite)
    {
        $idProduct = $productInFavorite->GetIdProduct();
        $idAccount = $productInFavorite->GetIdAccount();
        $color = $productInFavorite->GetColor();
        $query = "Delete FROM productInFavorite where idProduct='$idProduct' and idAccount='$idAccount' and color='$color'";
        $result = DataProvider::getInstance()->Execute($query);
        return $result;
    }
}
