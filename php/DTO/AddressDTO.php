<?php
require_once('./DAO/Address.php');
require_once('DataProvider.php');
class AddressDTO
{
    public static $_instance = null;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new AddressDTO();
        }

        return self::$_instance;
    }

    function GetAddress($id)
    {
        $query = "SELECT * FROM Address Where id = '$id'";
        $result = DataProvider::getInstance()->Execute($query);

        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $row = $result->fetch_assoc();
            $address = new Address();
            $address->SetId($row["id"])
                ->SetFullName($row["fullName"])
                ->SetPhoneNumber($row["phoneNumber"])
                ->SetLevel1($row["level1"])
                ->SetLevel2($row["level2"])
                ->SetLevel3($row["level3"])
                ->SetDetail($row["detail"]);
            return $address;
        } else
            return null;
    }

    function CreateAddress($address)
    {
        $fullName = $address->GetFullName();
        $phoneNumber = $address->GetPhoneNumber();
        $level1 = $address->GetLevel1();
        $level2 = $address->GetLevel2();
        $level3 = $address->GetLevel3();
        $detail = $address->GetDetail();

        $query = "INSERT INTO Address (fullName, phoneNumber, level1, level2, level3, detail) 
        VALUES('$fullName','$phoneNumber','$level1','$level2','$level3','$detail')";
        $result = DataProvider::getInstance()->Execute($query);
        echo "<br>".$query."<br>";
        return $result;
    }
    function UpdateAddress($address)
    {
        $id = $address->GetId();
        $fullName = $address->GetFullName();
        $phoneNumber = $address->GetPhoneNumber();
        $level1 = $address->GetLevel1();
        $level2 = $address->GetLevel2();
        $level3 = $address->GetLevel3();
        $detail = $address->GetDetail();

        $query = "Update Address (fullName,phoneNumber, level1, level2, level3, detail) 
        Values('$fullName','$phoneNumber','$level1','$level2','$level3','$detail') where id = '$id'";
        $result = DataProvider::getInstance()->Execute($query);

        return $result;
    }
    function GetNewestAddress()
    {
        $query = "SELECT * FROM address order by id desc";
        $result = DataProvider::getInstance()->Execute($query);

        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $row = $result->fetch_assoc();
            $address = new Address();
            $address->SetId($row["id"])
                ->SetFullName($row["fullName"])
                ->SetPhoneNumber($row["phoneNumber"])
                ->SetLevel1($row["level1"])
                ->SetLevel2($row["level2"])
                ->SetLevel3($row["level3"])
                ->SetDetail($row["detail"]);
            return $address;
        } else
            return null;
    }
}
