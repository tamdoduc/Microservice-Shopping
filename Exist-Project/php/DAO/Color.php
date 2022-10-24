<?php

class Color{
    private $id;
    private $nameColor;
    private $idProduct;

    function SetId($id){
        $this->id = $id;
        return $this;
    }
    function GetId(){
        return $this->id;
    }

    function SetNameColor($nameColor) {
        $this->nameColor = $nameColor;
        return $this;
    }
    function GetNameColor(){
        return $this->nameColor;
    }

    function SetIdProduct( $idProduct ){
        $this->idProduct = $idProduct;
        return $this;
    }
    function GetIdProduct(){
        return $this->idProduct;
    }
}