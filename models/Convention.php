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

    public function addNewConv($data)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO convention(idConv, cne, nom, prenom, filiere, nomEntr, adrEntr, telEntr, nomEncd, datedebut, datefin) VALUES (:idConv, :cne, :nom, :prenom, :filiere, :nomEntr, :adrEntr, :telEntr, :nomEncd, :datedebut, :datefin)");
            $stmt->bindParam(':idConv', $data['idConv']);
            $stmt->bindParam(':cne', $data['cne']);
            $stmt->bindParam(':nom', $data['nom']);
            $stmt->bindParam(':prenom', $data['prenom']);
            $stmt->bindParam(':filiere', $data['filiere']);
            $stmt->bindParam(':nomEntr', $data['nomEntr']);
            $stmt->bindParam(':adrEntr', $data['adrEntr']);
            $stmt->bindParam(':telEntr', $data['telEntr']);
            $stmt->bindParam(':nomEncd', $data['nomEncd']);
            $stmt->bindParam(':datedebut', $data['datedebut']);
            $stmt->bindParam(':datefin', $data['datefin']);

            if ($stmt->execute()) {
                return 'done';
            } else {
                throw new Exception('Une erreur est survenue lors de la création de la convention.');
            }
        } catch (PDOException $e) {
            throw new Exception('Une erreur est survenue lors de la création de la convention.');
        }
    }



    function getAllConvs()
    {
        $stmt = $this->conn->prepare("SELECT cne, nom, prenom, filiere, nomEntr, adrEntr, telEntr, nomEncd, DATE_FORMAT(datedebut, '%d/%m/%Y') AS datedebut, DATE_FORMAT(datefin, '%d/%m/%Y') AS datefin FROM convention");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

}
