<?php
require_once('./DAO/Color.php');
require_once('DataProvider.php');
class ColorDTO
{
    public static $_instance = null;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new ColorDTO();
        }

        return self::$_instance;
    }

    function GetColor($id)
    {
        $query = "Select * from Color where id='$id'";
        $result = DataProvider::getInstance()->Execute($query);

        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $row = $result->fetch_assoc();
            $color = new Color();
            $color->SetId($row["id"])
                ->SetIdProduct($row["idProduct"])
                ->SetNameColor($row["nameColor"]);
            return $color;
        } else
            return null;
    }
    function GetListColor($idProduct)
    {
        $query = "Select * from Color where idProduct='$idProduct'";
        $result = DataProvider::getInstance()->Execute($query);

        $listColor = array();
        $row = mysqli_num_rows($result);
        while ($row = $result->fetch_assoc()) {
            $color = new Color();
            $color->SetId($row["id"])
                ->SetIdProduct($row["idProduct"])
                ->SetNameColor($row["nameColor"]);
            array_push($listColor, $color);
        }
        return $listColor;
    }

    function CreateColor($color)
    {
        $idProduct = $color->GetIdProduct();
        $nameColor = $color->GetNameColor();

        $query = "INSERT INTO Color (idProduct, nameColor)
        values('$idProduct', '$nameColor')";
        $result = DataProvider::getInstance()->Execute($query);

        return $result;
    }
    function UpdateColor($color)
    {
        $id = $color->GetId();
        $idProduct = $color->GetIdProduct();
        $nameColor = $color->GetNameColor();

        $query = "Update Color set 'idProduct'='$idProduct','nameColor'='$nameColor' 
         where id = '$id'";
        $result = DataProvider::getInstance()->Execute($query);

        return $result;
    }
    function DeleteColorByIdProduct($idProduct)
    {
        $query = "Delete from Color where idProduct='$idProduct'";
        $result = DataProvider::getInstance()->Execute($query);
        return $result;
    }
}
