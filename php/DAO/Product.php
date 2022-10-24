<?php

class Product{
    private $id;
    private $nameProduct;
    private $idAccount;
    private $price;
    private $countSold=0;
    private $countAvailable=0;
    private $decribe;
    private $idTypeProduct=0;
    private $countStar=0;
    private $type;

    function SetId( $id ){
        $this->id = $id;
        return $this;
    }
    function SetIdAccount( $idAccount ){
        $this->idAccount = $idAccount;
        return $this;
    }
    function SetNameProduct( $nameProduct ){
        $this->nameProduct = $nameProduct;
        return $this;
    }
    function SetPrice( $price ){
        $this->price = $price;
        return $this;
    }
    function SetCountSold( $countSold ){
        $this->countSold = $countSold;
        return $this;
    }
    function SetDecribe( $decribe ){
        $this->decribe = $decribe;
        return $this;
    }
    function SetCountAvailable( $countAvailable ){
        $this->countAvailable = $countAvailable;
        return $this;
    }
    function SetIdTypeProduct( $idTypeProduct ){
        $this->idTypeProduct = $idTypeProduct;
        return $this;
    }
    function SetCountStar($star) {
        $this->countStar = $star;
        return $this;
    }
    function SetType($type){
        $this->type = $type;
        return $this;
    }

    
    function GetId(){
        return $this->id;
    }
    function GetIdAccount()
    {
        return $this->idAccount;
    }
    function GetNameProduct(){
        return $this->nameProduct;
    }
    function GetPrice(){
        return $this->price;
    }
    function GetCountSold(){
        return $this->countSold;
    }
    function GetCountAvailable(){
        return $this->countAvailable;
    }
    function GetDecribe(){
        return $this->decribe;
    }
    function GetIdTypeProduct(){
        return $this->idTypeProduct;
    }
    function GetCountStar(){
        return $this->countStar;
    }
    function GetType(){
        return $this->type;
    }
}