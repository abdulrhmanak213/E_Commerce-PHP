<?php
require_once '../models/BaseModel.php';
require_once '../JWT/jwtToken.php';
class User extends BaseModel
{
    public function getTable(){
        return 'users';
    }
    public function create($array,$conn){
       $firstname =  $array['firstname'];
       $lastname =  $array['lastname'];
       $email =  $array['email'];
       $password =  password_hash($array['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (firstname, lastname, email,password)
                 VALUES ('$firstname', '$lastname', '$email','$password')";

        if ($this->conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function getUserByToken(){
        $jwt = new jwtToken();
        $token = $jwt->getToken();
        $tokenParts = explode('.', $token);
        $payload = base64_decode($tokenParts[1]);
        $email = json_decode($payload)->email;
        return $this->getWhere('email' , $email);
    }




}
            
// (".$array['firstname'].",".$array['lastname'].",".$array['email'].",".password_hash( $array['password'],PASSWORD_BCRYPT ).")";
//        VALUES(".$array['firstname'].",".$array['lastname'].",".$array['email'].",".$array['password'].")";