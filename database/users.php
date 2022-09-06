<?php
 class users{
     private $conn;
     public function __construct($conn){
         $this->conn =$conn;
     }

    function create_users_table($conn)
    {
        $sql = "CREATE TABLE users (
        id INT(1) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE ,
        firstname VARCHAR(255) NOT NULL,
        lastname VARCHAR(255) NOT NULL,
        email VARCHAR(255),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        password VARCHAR(255)
        )";
        echo $result = $this->conn->query($sql);
    }
    public function delete_users_table($conn){
        $sql = "DROP TABLE users";
        echo $result = $this->conn->query($sql);
    }
}