<?php
require_once('./DAO/Account.php');
require_once('DataProvider.php');
class AccountDTO
{
  public static $_instance = null;
  private function __construct()
  {
  }
  public static function getInstance()
  {
    if (self::$_instance == null) {
      self::$_instance = new AccountDTO();
    }

    return self::$_instance;
  }
  public function GetId($userName, $password)
  {
    $query = "SELECT * FROM Account Where username = '$userName' AND password = '$password'";
    $result = DataProvider::getInstance()->Execute($query);

    $row = mysqli_num_rows($result);
    if ($row > 0) {
      $row = $result->fetch_assoc();
      return $row["id"];
    } else {
      return -1;
    }
  }
  public function GetAccount($id)
  {
    $query = "SELECT * FROM Account Where id = '$id'";
    $result = DataProvider::getInstance()->Execute($query);

    $row = mysqli_num_rows($result);
    if ($row > 0) {
      $row = $result->fetch_assoc();
      $account = new Account();
      $account->SetId($row["id"])
        ->SetEmail($row["email"])
        ->SetPassword($row["password"])
        ->SetFullName($row["fullName"])
        ->SetPhoneNumber($row["phoneNumber"])
        ->SetUsername($row["userName"])
        ->SetImageUrl($row["imageURL"])
        ->SetSex($row["sex"])
        ->SetLastIdAddress($row["lastIdAddress"])
        ->SetCoin($row["coin"]);
      return $account;
    } else
      return null;
  }
  public function AccountExists($userName)
  {
    $query = "SELECT * FROM Account Where username = '$userName'";
    $result = DataProvider::getInstance()->Execute($query);
    $row = mysqli_num_rows($result);
    if ($row > 0)
      return true;
    else
      return false;
  }
  public function CreateAccount($account)
  {
    $username = $account->GetUsername();
    $password = $account->GetPassword();
    $fullName = $account->GetFullName();
    $email = $account->GetEmail();
    $phoneNumber = $account->GetPhoneNumber();
    $sex = $account->GetSex();
    $query = "Insert into Account(username, password, email,fullName,phoneNumber,sex) 
    values('$username','$password','$email',
    '$fullName',$phoneNumber,'$sex')";
    $result = DataProvider::getInstance()->Execute($query);

    return $result;
  }
  public function UpdateAccount($account)
  {
    $id = $account->GetId();
    $username = $account->GetUsername();
    $password = $account->GetPassword();
    $fullName = $account->GetFullName();
    $email = $account->GetEmail();
    $phoneNumber = $account->GetPhoneNumber();
    $sex = $account->GetSex();
    $imageUrl = $account->GetImageUrl();
    $coin = $account->GetCoin();
    $lastIdAddress = $account->GetLastIdAddress();
    $query = "Update account Set userName = '$username',
        password = '".$password."',
        fullName = '$fullName',
        email = '$email',
        phoneNumber = $phoneNumber,
        imageURL = '$imageUrl',
        coin = '$coin',
        lastIdAddress ='$lastIdAddress',
        sex = '$sex' Where id= '$id'";
    $result = DataProvider::getInstance()->Execute($query);
    return $result;
  }
}
