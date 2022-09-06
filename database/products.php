<?php

class products
{
    private $conn;
    public function __construct($conn){
        $this->conn =$conn;
    }

    function create_products_table($conn)
    {
        $sql = "CREATE TABLE products (
        id INT(1) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price INT  NOT NULL,
        phone VARCHAR(255) NOT NULL,
        quantity INT  NOT NULL,
        description VARCHAR(255),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        user_id INT(1) UNSIGNED
        )";
        if ($conn->query($sql) === TRUE) {
            echo "Table  products created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }

        $sql2 = "ALTER TABLE products ADD FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE";
        if ($conn->query($sql2) === TRUE) {
            echo "Table MyGuests created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }

}