<?php

require_once('../database/Database.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);
class Convention
{

    public $db;
    public $conn;

    public function __construct()
    {
        $this->db = new Database;
        $this->conn = $this->db->getConnection();
    }

    function getAllConvs()
    {
        $stmt = $this->conn->prepare("SELECT nomEntr, adrEntr, telEntr, nomEncd FROM convention");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    
}