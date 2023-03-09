<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../database/Database.php');
class EtudiantController
{
    private $email;
    private $datenaiss;
    
    public $db;
    public $conn;

    public function __construct($email, $datenaiss)
    {
        $this->email = $email;
        $this->datenaiss = $datenaiss;
        $this->db = new Database;
        $this->conn = $this->db->getConnection();
    }


    public function authenticate()
    {

        $stmt = $this->conn->prepare("SELECT nom, prenom FROM etudiant WHERE email = ? AND datenaiss = ?");
        $stmt->execute([$this->email, $this->datenaiss]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');

        if ($row) {
            session_start();
            $_SESSION['prenom'] = $row['prenom'];
            $_SESSION['nom'] = $row['nom'];
            $url = 'views/home.php';
            $response = array(
                'success' => true,
                'url' => $url,
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'L\'adresse email ou le mot de passe est invalide'
            );
        }
        echo json_encode($response);
        $this->conn = null;
    }
}


function handleLogin()
{
    if (isset($_POST['connecter'])) {
        $_POST['email'] = stripcslashes(htmlspecialchars(trim($_POST['email'])));
        $_POST['password'] = stripcslashes(htmlspecialchars(trim($_POST['password'])));
        $etContr = new EtudiantController($_POST['email'], $_POST['password']);
        $etContr->authenticate();
    }
}

handleLogin();

