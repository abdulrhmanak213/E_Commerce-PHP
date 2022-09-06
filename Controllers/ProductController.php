<?php
require ('../database/products.php');
//require '../Traits/HttpResponse.php';
require ('../Request/ProductRequest.php');
require ('../models/Product.php');
require ('../models/User.php');
class ProductController
{
    use HttpResponse;
    private $conn;
    public $product, $user;
    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->product = new Product($conn);
        $this->user = new User($conn);
    }

    public function create(){
        $request = new ProductRequest ();
        $data = $request->all();
        $user = $this->user->getUserByToken();
        $data['user_id'] = $user[0]['id'];
        $product = $this->product->create($data,$this->conn);
        self::returnData('product',$data,'product created successfully',200);
    }

    public function delete(){
        $id = $_GET['id'];
        $product = $this->product->getWhere('id',$id);
        if(empty($product)) {
            self::failure('product not found', 404);
            return;
        }
        $user = $this->user->getUserByToken();
        if($product[0]['user_id'] != $user[0]['id']){
            self::failure('forbidden',403);
            return;
        }
        $this->product->delete($id);
        self::success('product deleted successfully',200);
    }

    public function get(){
        $id = $_GET['id'];
        $product = $this->product->getWhere('id',$id);
        if(empty($product)) {
            self::failure('product not found', 404);
            return;
        }
        self::returnData('product',$product[0],'success',200);

    }

    public function getAll(){
        $products = $this->product->getAll();
        if(empty($products) ) {
            self::success('no products', 200);
            return;
        }
        self::returnData('product',$products,'success',200);
    }

    public function update(){
        $id = $_GET['id'];
        $request = new ProductRequest ();
        $data = $request->all();
        $this->product->update($id,$data,$this->conn);
        self::returnData('product',$data,'product updated successfully',200);

    }




}