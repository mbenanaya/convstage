<?php

require_once '../database/Database.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);
class Etudiant
{
    public $db;
    public $conn;

    public function __construct()
    {
        $this->db = new Database;
        $this->conn = $this->db->getConnection();
    }

    public function Login($cne, $dateNaiss)
    {
        $stmt = $this->conn->prepare("SELECT cne, nom, prenom, datenaissance, diplome FROM etudiant WHERE cne = :cne AND datenaissance = :datenaissance");
        $stmt->bindParam(':cne', $cne);
        $stmt->bindParam(':datenaissance', $dateNaiss);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

}