<?php

class ProductInBill{
    private $idBill;
    private $idProduct;
    private $count;
    private $idEvalute;
    private $color;
    
    function SetColor($color)
    {
        $this->color = $color;
        return $this;
    }
    function GetColor()
    {
        return $this->color;
    }
    function SetIdBill( $idBill ){
        $this->idBill = $idBill;
        return $this;
    }
    
    function SetIdProduct( $idProduct ){
        $this->idProduct = $idProduct;
        return $this;
    }
    function SetCount( $count ){
        $this->count = $count;
        return $this;
    }
    function SetIdEvalute( $idEvalute ){
        $this->idEvalute = $idEvalute;
        return $this;
    }
    function GetIdBill(){
        return $this->idBill;
    }
    function GetIdProduct()
    {
        return $this->idProduct;
    }
    function GetCount(){
        return $this->count;
    }
    function GetIdEvalute(){
        return $this->idEvalute;
    }
}