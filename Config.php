<?php

class DataBaseEnv{
    function OpenCon() {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "e_commerce";
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);
        return $conn;
    }

    function createDatabase($conn,$name){
        $sql = "CREATE DATABASE ".$name;
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully";
        }
        else {
            echo "Error creating database: " . $conn->error;
        }
    }

    function CloseCon($conn)
    {
        $conn -> close();
    }
}
