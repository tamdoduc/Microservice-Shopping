<?php

class ProductInCart{
    private $idProduct;
    private $idAccount;
    private $count;
    private $color;
    function SetIdProduct( $idProduct ){
        $this->idProduct = $idProduct;
        return $this;
    }
    function SetCount( $count ){
        $this->count = $count;
        return $this;
    }
    function SetIdAccount( $idAccount ){
        $this->idAccount = $idAccount;
        return $this;
    }
    function SetColor( $color ){
        $this->color = $color;
        return $this;
    }
    function GetIdProduct()
    {
        return $this->idProduct;
    }
    function GetCount(){
        return $this->count;
    }
    function GetColor()
    {
        return $this->color;
    }
    function GetIdAccount(){
        return $this->idAccount;
    }
}