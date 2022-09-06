<?php

require '../models/User.php';
require '../Traits/HttpResponse.php';
require '../Resources/LoginResource.php';
require '../JWT/jwtToken.php';
require '../database/products.php';

class UserController
{
    use HttpResponse;

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function create($conn)
    {
        $data['firstname'] = $_POST['firstname'];
        $data['lastname'] = $_POST['lastname'];
        $data['email'] = $_POST['email'];
        $data['password'] = $_POST['password'];
        $user = new User($this->conn);
        $user->create($data, $conn);
        self::success('user created successfully', 200);
    }

    public function login($conn)
    {
        $data['email'] = $_POST['email'];
        $data['password'] = $_POST['password'];
        $data['firstname'] = $_POST['firstname'];
        $user = new User($this->conn);
        $result = $user->getWhere('email', $data['email']);

        if(empty($result))
        {
            self::failure('wrong password or email',400);
        }
        else if(password_verify( $data['password'],$result[0]['password'])){
            $jwt = new jwtToken();
            $token = $jwt->create($result[0]['email'],$result[0]['password']);
            $resource = new LoginResource();
            $resource = $resource->toArray($result[0]);
            $resource['token'] = $token;
            self::returnData('user',$resource,"success",200);
             }
        else
            self::failure('wrong password or email',400);
    }
    public function checkToken($conn){
        $product = new products($conn);
        $product->create_products_table($conn);
    }

}