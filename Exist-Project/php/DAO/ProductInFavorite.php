<?php

class ProductInFavorite
{
    private $idAccount;
    private $idProduct;
    private $color;
    function SetIdAccount($idAccount)
    {
        $this->idAccount = $idAccount;
        return $this;
    }
    function SetIdProduct($idProduct)
    {
        $this->idProduct = $idProduct;
        return $this;
    }
    function GetIdAccount()
    {
        return $this->idAccount;
    }
    function GetIdProduct()
    {
        return $this->idProduct;
    }
    function SetColor( $color)
    {
        $this->color = $color;
        return $this;
    }
    function GetColor()
    {
        return $this->color;
    }
}
