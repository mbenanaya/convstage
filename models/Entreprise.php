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

    public function addNewEntr($data)
    {
        $sql = $this->conn->prepare("SELECT * FROM entreprise WHERE nomEntr = :nomEntr AND adrEntr = :adrEntr AND telEntr = :telEntr AND nomEncd = :nomEncd");
        $sql->execute(array(':nomEntr' => $data['nomEntr'], ':adrEntr' => $data['adrEntr'], ':telEntr' => $data['telEntr'], ':nomEncd' => $data['nomEncd']));

        if ($sql->rowCount() == 0) {
            try {

                $stmt = $this->conn->prepare("INSERT INTO entreprise (nomEntr, adrEntr, telEntr, nomEncd) VALUES (:nomEntr, :adrEntr, :telEntr, :nomEncd)");

                $stmt->bindParam(':nomEntr', $data['nomEntr']);
                $stmt->bindParam(':adrEntr', $data['adrEntr']);
                $stmt->bindParam(':telEntr', $data['telEntr']);
                $stmt->bindParam(':nomEncd', $data['nomEncd']);

                if ($stmt->execute()) {
                    return 'done';
                } else {
                    throw new Exception('Erreur');
                }

            } catch (PDOException $e) {
                throw new Exception('Erreur');
            }
        }
    }

}