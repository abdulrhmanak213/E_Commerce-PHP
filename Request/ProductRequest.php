<?php
require ('../Traits/HttpResponse.php');

class ProductRequest
{
    use HttpResponse;
    protected  $name, $price, $phone, $quantity,$description;
    public function __construct()
    {

            $this->name = $_POST['name'];
            $this->price = $_POST['price'];
            $this->phone = $_POST['phone'];
            $this->quantity = $_POST['quantity'];
            $this->description = $_POST['description'];
    }

    public function all(){
       $data = [];
        if($this->checkifnull())
            self::failure('check your data',400);

        else{
            $data['name'] = $this->name;
            $data['price'] = $this->price;
            $data['phone'] = $this->phone;
            $data['quantity'] = $this->quantity;
            $data['description'] = $this->description;
            return $data;
        }

    }

    public function checkifnull(){
        if(empty($this->name) || empty($this->price) || empty($this->phone) || empty($this->quantity) || empty($this->description))
            return true;
        return false;
    }

}