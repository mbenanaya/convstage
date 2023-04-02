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
            $stmt = $this->conn->prepare("INSERT INTO convention(idConv, cne, nom, prenom, diplome, intitule, description, nomEntr, adrEntr, telEntr, nomEncd, datedebut, datefin) VALUES (:idConv, :cne, :nom, :prenom, :diplome, :description, :intitule, :nomEntr, :adrEntr, :telEntr, :nomEncd, :datedebut, :datefin)");
            $stmt->bindParam(':idConv', $data['idConv']);
            $stmt->bindParam(':cne', $data['cne']);
            $stmt->bindParam(':nom', $data['nom']);
            $stmt->bindParam(':prenom', $data['prenom']);
            $stmt->bindParam(':diplome', $data['diplome']);
            $stmt->bindParam(':intitule', $data['intitule']);
            $stmt->bindParam(':description', $data['description']);
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
    function getDipsLicence()
    {
        $stmt = $this->conn->prepare("SELECT DISTINCT(diplome) AS diplome FROM convention WHERE diplome IN ('ALTBICG', 'ALTMIPC', 'ALTMAIP')");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $newRows = array();
        foreach ($rows as $row) {
            $newRows[$row['diplome']] = $row['diplome'];
        }
        return $newRows;
    }
    function getDipsMaster()
    {
        $stmt = $this->conn->prepare("SELECT DISTINCT(diplome) FROM convention WHERE diplome IN ('AMTMAAV','AMTSDAD', 'AMTEXVG', 'AMTMCSM', 'AMTGEEL', 'AMTBIOV', 'AMTMIAI', 'AMTGEAA', 'AMTRDPS', 'AMTMDIM', 'AMTMMEA', 'AMTPSNB')");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $newRows = array();
        foreach ($rows as $row) {
            $newRows[$row['diplome']] = $row['diplome'];
        }
        return $newRows;
    }

    function getDipsIngenieur()
    {
        $stmt = $this->conn->prepare("SELECT DISTINCT(diplome) FROM convention WHERE diplome IN ('AMTSDAD', 'ADIISA ', 'ADIIFA ', 'ADIIRSI', 'ADERME ', 'ADIGMP ', 'ADIIGC ', 'ADIIRIS')");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $newRows = array();
        foreach ($rows as $row) {
            $newRows[$row['diplome']] = $row['diplome'];
        }
        return $newRows;
    }


    function getAllConvs()
    {
        $stmt = $this->conn->prepare("SELECT cne, nom, prenom, diplome, nomEntr, adrEntr, telEntr, nomEncd, DATE_FORMAT(datedebut, '%d/%m/%Y') AS datedebut, DATE_FORMAT(datefin, '%d/%m/%Y') AS datefin FROM convention");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    function getConvBydiplome($diplome)
    {
        $stmt = $this->conn->prepare("SELECT cne, nom, prenom, diplome, nomEntr, adrEntr, telEntr, nomEncd, DATE_FORMAT(datedebut, '%d/%m/%Y') AS datedebut, DATE_FORMAT(datefin, '%d/%m/%Y') AS datefin FROM convention WHERE diplome = :diplome");
        $stmt->execute(array(':diplome' => $diplome));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    function countLicenceDips()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(idConv) AS countLicence FROM convention WHERE diplome IN ('ALTBICG', 'ALTMIPC', 'ALTMAIP')");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    function countMasterDips()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(idConv) AS countMaster FROM convention WHERE diplome IN ('AMTMAAV','AMTSDAD', 'AMTEXVG', 'AMTMCSM', 'AMTGEEL', 'AMTBIOV', 'AMTMIAI', 'AMTGEAA', 'AMTRDPS', 'AMTMDIM', 'AMTMMEA', 'AMTPSNB')");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    function countIngenieurDips()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(idConv) AS countIngenieur FROM convention WHERE diplome IN ('AMTSDAD', 'ADIISA ', 'ADIIFA ', 'ADIIRSI', 'ADERME ', 'ADIGMP ', 'ADIIGC ', 'ADIIRIS')");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

}