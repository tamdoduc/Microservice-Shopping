<?php

class ImageProduct{
    private $id;
    private $imageURL="";
    private $idProduct;

    function SetId($id){
        $this->id = $id;
        return $this;
    }
    function GetId(){
        return $this->id;
    }

    function SetImageURL($imageURL) {
        $this->imageURL = $imageURL;
        return $this;
    }
    function GetImageURL(){
        return $this->imageURL;
    }

    function SetIdProduct( $idProduct ){
        $this->idProduct = $idProduct;
        return $this;
    }
    function GetIdProduct(){
        return $this->idProduct;
    }
}