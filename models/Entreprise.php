<?php

require_once('../database/Database.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);
class Entreprise
{

    public $db;
    public $conn;

    public function __construct()
    {
        $this->db = new Database;
        $this->conn = $this->db->getConnection();
    }

    function getEntrNames()
    {
        $stmt = $this->conn->prepare("SELECT idEntr, nomEntr FROM entreprise");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    function getEntrById($id)
    {
        $stmt = $this->conn->prepare("SELECT nomEntr, adrEntr, telEntr, nomEncd FROM entreprise WHERE idEntr = :id");
        $stmt->execute(array(':id' => $id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row;
        }
    }

    function getAllEntreprises()
    {
        $stmt = $this->conn->prepare("SELECT nomEntr, adrEntr, telEntr, nomEncd FROM entreprise");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    
}

// $ob = new Entreprise;
// var_dump($ob->getEntrByName("Onestcom"));