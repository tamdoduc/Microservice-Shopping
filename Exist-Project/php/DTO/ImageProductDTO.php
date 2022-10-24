<?php
require_once('./DAO/ImageProduct.php');
require_once('DataProvider.php');
class ImageProductDTO
{
    public static $_instance = null;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new ImageProductDTO();
        }

        return self::$_instance;
    }

    function GetImageProduct($id)
    {
        $query = "Select * from ImageProduct where id='$id'";
        $result = DataProvider::getInstance()->Execute($query);

        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $row = $result->fetch_assoc();
            $imageProduct = new ImageProduct();
            $imageProduct->SetId($row["id"])
                ->SetIdProduct($row["idProduct"])
                ->SetImageURL($row["imageURL"]);
            return $imageProduct;
        } else
            return null;
    }
    function GetListImageProductByIdProduct($idProduct)
    {
        $listImageProduct = array();
        $query = "Select * from ImageProduct where idProduct='$idProduct'";
        $result = DataProvider::getInstance()->Execute($query);

        $row = mysqli_num_rows($result);
        while ($row = $result->fetch_assoc()) {
            $imageProduct = new ImageProduct();
            $imageProduct->SetId($row["id"])
                ->SetIdProduct($row["idProduct"])
                ->SetImageURL($row["imageURL"]);
            array_push($listImageProduct, $imageProduct);
        }
        return $listImageProduct;
    }
    function GetFirstImageProduct($idProduct)
    {
        $query = "Select * from ImageProduct where idProduct='$idProduct' limit 1";
        $result = DataProvider::getInstance()->Execute($query);
        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $row = $result->fetch_assoc();
            $imageProduct = new ImageProduct();
            $imageProduct->SetId($row["id"])
                ->SetIdProduct($row["idProduct"])
                ->SetImageURL($row["imageURL"]);
            //  echo $imageProduct->GetImageURL()."<br>";
            return $imageProduct;
        } else
            return null;
    }
    function CreateImageProduct($imageProduct)
    {

        $idProduct = $imageProduct->GetIdProduct();
        $imageURL = $imageProduct->GetImageURL();

        $query = "INSERT INTO ImageProduct (idProduct, imageURL)
        values('$idProduct', '$imageURL')";
        $result = DataProvider::getInstance()->Execute($query);
        return $result;
    }
    function UpdateImageProduct($imageProduct)
    {
        $id = $imageProduct->GetId();
        $idProduct = $imageProduct->GetIdProduct();
        $imageURL = $imageProduct->GetImageURL();

        $query = "Update ImageProduct set 'idProduct'='$idProduct','imageURL'='$imageURL' 
         where id = '$id'";
        $result = DataProvider::getInstance()->Execute($query);

        return $result;
    }
    function GetListImagesProduct($imageProduct)
    {
        $imageProducts = array();
        $query = "Select * from ImageProduct where idProduct='0'";
        $result = DataProvider::getInstance()->Execute($query);

        $row = mysqli_num_rows($result);
        while ($row = $result->fetch_assoc()) {
            $imageProduct = new ImageProduct();
            $imageProduct->SetId($row["id"])
                ->SetImageURL($row["imageURL"]);
            array_push($imageProducts, $imageProduct);
        }
        return $imageProducts;
    }
    function DeleteImageProductByIdProduct($idProduct)
    {
        $query = "Delete from ImageProduct where idProduct='$idProduct'";
        $result = DataProvider::getInstance()->Execute($query);
        return $result;
    }
    function SetNewIdProduct($oldIdProduct, $idProduct)
    {
        $query = "Update ImageProduct set idProduct='$idProduct' where idProduct='$oldIdProduct'";
        echo "<br>" . $query . "<br>";
        $result = DataProvider::getInstance()->Execute($query);
        return $result;
    }
}
