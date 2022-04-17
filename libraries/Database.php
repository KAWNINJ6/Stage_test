<?php

class DataBase
{
    // Database connection
    private $hostname = "localhost";
    private $base= "stage_test";
    private $loginBD= "root";
    private $passBD= "";

    // Database connection & statement instance
    private $db;
    private $stmt;

    public function __construct() 
    {
        try {
            $dsn = "mysql:host=$this->hostname;dbname=$this->base";
            $this->db = new PDO ($dsn, $this->loginBD, $this->passBD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo utf8_encode("Echec : " . $e->getMessage() . "\n");
            die();
        }
    }

    // Prepare a query
    public function query($sql) 
    {
        $this->stmt = $this->db->prepare($sql);
    }

    // Bind values
    public function bind($param, $value, $type = null) 
    {
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute() 
    {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultSet() 
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function single() 
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount() 
    {
        return $this->stmt->rowCount();
    }
}