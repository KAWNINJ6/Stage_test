<?php
require_once '../libraries/Database.php';

class User
{
    // Database connection
    private $db;

    public function __construct() 
    {
        $this->db = new Database;
    }

    // Find user by login
    public function findUserByLogin($login)
    {
        $this->db->query('SELECT * FROM user WHERE login = :login');
        $this->db->bind(':login', $login);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    // Find user with login and password
    public function findUserByLoginAndPassword($login, $password)
    {
        $row = $this->findUserByLogin($login);
        
        if($row == false) return false;
        $hashedPassword = $row->password;
        if(password_verify($password, $hashedPassword)) {
            return $row;
        } else{
            return false;
        }
    }

    // Create a new user
    public function createUser($data)
    {
        $this->db->query('INSERT INTO user (firstName, lastName, login, password, birthday, gender) 
        VALUES (:firstName, :lastName, :login, :password, :birthday, :gender)');

        $this->db->bind(':firstName', $data['firstName']);
        $this->db->bind(':lastName', $data['lastName']);
        $this->db->bind(':login', $data['login']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':birthday', $data['birthday']);
        $this->db->bind(':gender', $data['gender']);

        if($this->db->execute()) {
            return true;
        } else{
            return false;
        }
    }
}