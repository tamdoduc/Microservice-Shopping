<?php
require_once('./DAO/Evalute.php');
require_once('DataProvider.php');
class EvaluteDTO
{
    public static $_instance = null;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new EvaluteDTO();
        }

        return self::$_instance;
    }

    function GetEvalute($id)
    {
        $query = "SELECT * FROM Evalute Where id = '$id'";
        $result = DataProvider::getInstance()->Execute($query);

        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $row = $result->fetch_assoc();
            $evalute = new Evalute();
            $evalute->SetId($row["id"])
                ->SetIdAccount($row["idAccount"])
                ->SetStar($row["star"])
                ->SetComment($row["comment"])
                ->SetIdProduct($row["idProduct"]);
            return $evalute;
        } else
            return null;
    }
    function GetNewestEvalute()
    {
        $query = "SELECT * FROM Evalute order by id desc ";
        $result = DataProvider::getInstance()->Execute($query);

        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $row = $result->fetch_assoc();
            $evalute = new Evalute();
            $evalute->SetId($row["id"])
                ->SetIdAccount($row["idAccount"])
                ->SetStar($row["star"])
                ->SetComment($row["comment"])
                ->SetIdProduct($row["idProduct"]);
            return $evalute;
        } else
            return null;
    }
    function GetListEvalute($idProduct)
    {
        $query = "SELECT * FROM Evalute Where idProduct = '$idProduct' order by id desc" ;
        $result = DataProvider::getInstance()->Execute($query);
        $listEvalute = array();
        $row = mysqli_num_rows($result);
        while ($row = $result->fetch_assoc())
        {
            $evalute = new Evalute();
            $evalute->SetId($row["id"])
                ->SetIdAccount($row["idAccount"])
                ->SetStar($row["star"])
                ->SetComment($row["comment"])
                ->SetTime($row["time"])
                ->SetIdProduct($row["idProduct"]);
            array_push($listEvalute,$evalute);
        } 
        return $listEvalute;
    }

    function CreateEvalute($evalute)
    {
        $idAccount = $evalute->GetIdAccount();
        $star = $evalute->GetStar();
        $idProduct = $evalute->GetIdProduct();
        $comment = $evalute->GetComment();
        $time = $evalute->GetTime();

        $query = "Insert into Evalute (idAccount, star, idProduct,comment,time) values('$idAccount','$star','$idProduct','$comment','$time')";

        $result = DataProvider::getInstance()->Execute($query);
        echo "1<br>" . $query . "<br>1";
        return $result;
    }

}
