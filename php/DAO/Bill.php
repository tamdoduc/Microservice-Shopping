<?php

class Bill{
    private $id;
    private $idAccount;
    private $idDetailBill;
    private $time;
    private $code;
    private $idAccountSeller;

    function SetId( $id ){
        $this->id = $id;
        return $this;
    }
    function SetIdAccount( $idAccount ){
        $this->idAccount = $idAccount;
        return $this;
    }
    function SetIdDetailBill( $idDetailBill ){
        $this->idDetailBill = $idDetailBill;
        return $this;
    }
    function SetTime( $time ){
        $this->time = $time;
        return $this;
    }
    function SetCode( $code){
        $this->code = $code;
        return $this;
    }

    function GetId(){
        return $this->id;
    }
    function GetTime(){
        return $this->time;
    }
    function GetIdAccount(){
        return $this->idAccount;
    }
    function GetIdDetailBill(){
        return $this->idDetailBill;
    }
    function GetCode(){
        return $this->code;
    }
    function SetIdAccountSeller($idAccountSeller){
        $this->idAccountSeller = $idAccountSeller;
        return $this;
    }
    function GetIdAccountSeller(){
        return $this->idAccountSeller;
    }
}