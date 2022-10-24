<?php

class Address{
    private $id;
    private $fullName;
    private $phoneNumber;
    private $level1;
    private $level2;
    private $level3;
    private $detail;

    function SetId($id)
    {
        $this->id = $id;
        return $this;
    }
    function GetId()
    {
        return $this->id;
    }
    function SetIdAccount($idAccount){
        $this->idAccount = $idAccount;
        return $this;
    }
    function GetAccount() {
        return $this->idAccount;
    }
    function SetFullName($fullName){
        $this->fullName = $fullName;
        return $this;
    }
    function GetFullName() {
        return $this->fullName;
    }
    function SetPhoneNumber($phoneNumber){
        $this->phoneNumber = $phoneNumber;
        return $this;
    }
    function GetPhoneNumber() {
        return $this->phoneNumber;
    }
    function SetLevel1($level1){
        $this->level1 = $level1;
        return $this;
    }
    function GetLevel1() {
        return $this->level1;
    }
    function SetLevel2($level2){
        $this->level2 = $level2;
        return $this;
    }
    function GetLevel2() {
        return $this->level2;
    }
    function SetLevel3($level3){
        $this->level3 = $level3;
        return $this;
    }
    function GetLevel3() {
        return $this->level3;
    }
    function SetDetail($detail){
        $this->detail = $detail;
        return $this;
    }
    function GetDetail() {
        return $this->detail;
    }
}