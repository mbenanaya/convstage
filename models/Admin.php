<?php

require_once('../database/Database.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);
class Admin
{
    public $db;
    public $conn;

    public function __construct()
    {
        $this->db = new Database;
        $this->conn = $this->db->getConnection();
    }

    public function adminLogin($email, $password)
    {
        $stmt = $this->conn->prepare("SELECT username FROM admin WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;

    }

    public function updatePass($password, $username)
    {
        $stmt = $this->conn->prepare("UPDATE admin SET password = :password WHERE username = :username");
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':username', $username);
        return $stmt->execute();
    }

}