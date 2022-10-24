<?php

class Evalute{
    private $id;
    private $idAccount;
    private $star;
    private $idProduct;
    private $comment;
    private $time;

    function SetId( $id ){
        $this->id = $id;
        return $this;
    }
    function GetId(){
        return $this->id;
    }

    function SetIdAccount( $idAccount ){
        $this->idAccount = $idAccount;
        return $this;
    }
    function GetIdAccount(){
        return $this->idAccount;
    }

    function SetStar( $star ){
        $this->star = $star;
        return $this;
    }
    function GetStar(){
        return $this->star;
    }

    function SetIdProduct( $idProduct ){
        $this->idProduct = $idProduct;
        return $this;
    }
    function GetIdProduct(){
        return $this->idProduct;
    }
    function SetComment( $comment ){
        $this->comment = $comment;
        return $this;
    }
    function GetComment(){
        return $this->comment;
    }
    function SetTime($time){
        $this->time = $time;
        return $this;
    }
    function GetTime(){
        return $this->time;
    }
}