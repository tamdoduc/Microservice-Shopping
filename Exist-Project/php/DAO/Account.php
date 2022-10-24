<?php
class Account {
        private $id;
        private $username;
        private $password;
        private $fullName;
        private $email;
        private $phoneNumber;
        private $imageUrl;
        private $sex;
        private $coin;
        private $lastIdAddress;

        public function __construct()
        {
            
        }
        function SetLastIdAddress($lastIdAddress){
            $this->lastIdAddress = $lastIdAddress;
            return $this;
        }
        function GetLastIdAddress(){
            return $this->lastIdAddress;
        }
        function SetCoin($coin)
        {
            $this->coin = $coin;
            return $this;
        }
        function GetCoin()
        {
            return $this->coin;
        }
        public function SetId($id) {
            $this->id = $id;
            return $this;
        }
        public function GetId() {
            return $this->id;
        }

        public function SetUsername($username) {
            $this->username = $username;
            return $this;
        }
        public function GetUsername() {
            return $this->username;
        }

        public function SetSex($sex) {
            $this->sex = $sex;
            return $this;
        }
        function GetSex() {
            return $this->sex;
        }

        function SetFullName($fullname) {
            $this->fullName = $fullname;
            return $this;   
        }
        function GetFullName() {
            return $this->fullName;
        }

        function SetEmail($email) {
            $this->email = $email;
            return $this;
        }
        function GetEmail() {
            return $this->email;
        }

        function SetPassword($password) {
            $this->password = $password;
            return $this;
        }
        function GetPassword() {
            return $this->password;
        }

        function SetPhoneNumber($phoneNumber){
            $this->phoneNumber = $phoneNumber;
            return $this;
        }
        function GetPhoneNumber() {
            return $this->phoneNumber;
        }

        function SetImageUrl($imageUrl){
            $this->imageUrl = $imageUrl;
            return $this;
        }

        function GetImageUrl() {
            return $this->imageUrl;
        }
    }
