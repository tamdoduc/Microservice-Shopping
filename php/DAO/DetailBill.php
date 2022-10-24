<?php

class DetailBill
{
    private $id;
    private $idBill;
    private $totalPrice;
    private $state;
    private $discount;
    private $idAddress;

    function SetIdAddress($idAddress)
    {
        $this->idAddress = $idAddress;
        return $this;
    }
    function GetIdAddress()
    {
        return $this->idAddress;
    }
    function SetId($id)
    {
        $this->id = $id;
        return $this;
    }
    function SetIdBill($idBill)
    {
        $this->idBill = $idBill;
        return $this;
    }
    function SetTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }
    function SetState($state)
    {
        $this->state = $state;
        return $this;
    }
    function SetDiscount($discount)
    {
        $this->discount = $discount;
        return $this;
    }

    function GetId()
    {
        return $this->id;
    }
    function GetIdBill()
    {
        return $this->idBill;
    }
    function GetTotalPrice()
    {
        return $this->totalPrice;
    }
    function GetState()
    {
        return $this->state;
    }
    function GetDiscount()
    {
        return $this->discount;
    }
}
