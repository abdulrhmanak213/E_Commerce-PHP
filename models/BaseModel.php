<?php

class BaseModel
{
    protected $table;
    protected $conn;
    public function __construct($conn)
    {
        $this->table = $this->getTable();
        $this->conn = $conn;
    }

    public function get($id){
        $sql = "SELECT * FROM "."$this->table"." WHERE id = '$id'";
        return $this->conn->query($sql)->fetch_assoc();

    }

    public function getWhere($column, $value): array
    {
        $sql = "SELECT  * FROM "."$this->table"." WHERE "."$column"." = '$value'";
        $result =  $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($data,$row);
            }}
        return $data;
    }

    public function getWhereTwoConditions($column, $value, $column1, $value1): array
    {
        $sql = "SELECT * FROM "." $this->table"." WHERE "."$column"." = '$value' AND "." $column1"." = '$value1'";
        $result =  $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($data,$row);
            }}
        else {
            echo "0 results";
        }
        return $data;
    }

    public function delete($id){
        $sql = "DELETE FROM "." $this->table"." WHERE id="."$id"."";
       return $this->conn->query($sql);
    }

    public function getAll(){
        $sql = "SELECT * FROM "."$this->table"."";
        $result =  $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($data,$row);
            }}
        else {
            echo "0 results";
        }
        return $data;
    }

}