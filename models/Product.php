<?php
require_once('../models/BaseModel.php');


class Product extends BaseModel
{
    public function getTable(){
        return 'products';
    }

    public function create($array,$conn){
        $name =  $array['name'];
        $price =  $array['price'];
        $phone =  $array['phone'];
        $quantity = $array['quantity'];
        $description = $array['description'];
        $user_id = $array['user_id'];
        $sql = "INSERT INTO products (name, price, phone,quantity,description,user_id)
                 VALUES ('$name', '$price', '$phone','$quantity','$description', '$user_id')";
        if ($this->conn->query($sql) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function update($id,$array,$conn){
        $name =  $array['name'];
        $price =  $array['price'];
        $phone =  $array['phone'];
        $quantity = $array['quantity'];
        $description = $array['description'];
        $sql = "
         UPDATE ". $this->table ."
         SET  name = ' $name ' , price =  '$price' , phone = '$phone' , quantity = '$quantity' , description = '$description'
         WHERE id=".$id."";
        if ($this->conn->query($sql) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

}