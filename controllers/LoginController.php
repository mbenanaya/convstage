<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../database/Database.php');
class EtudiantController
{
    private $email;
    private $password;
    private $is_admin;
    public $db;
    public $conn;

    public function __construct($email, $password)
    {
        global $is_admin;
        $this->email = $email;
        $this->password = $password;
        $this->db = new Database;
        $this->conn = $this->db->getConnection();
        $this->is_admin = $is_admin;
    }


    public function authenticate()
    {
        header('Content-Type: application/json');

        // Validate user input
        $email = filter_var($this->email, FILTER_SANITIZE_EMAIL);
        $password = filter_var($this->password, FILTER_SANITIZE_STRING);

        $stmt = $this->conn->prepare("SELECT username FROM admin WHERE email = ? AND password = ?");
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $password);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $sql = $this->conn->prepare("SELECT nom, prenom, cne, diplome FROM etudiant WHERE cne = ? AND DATE_FORMAT(datenaiss, '%d/%m/%y') = ?");
        $sql->bindParam(1, $email);
        $sql->bindParam(2, $password);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);


        if ($row) {
            session_start();
            $_SESSION['username'] = $row['username'];
            $url = 'admin';
            $response = array(
                'success' => true,
                'url' => $url,
            );
        } else if ($result) {
            session_start();
            $_SESSION['prenom'] = $result['prenom'];
            $_SESSION['nom'] = $result['nom'];
            $_SESSION['cne'] = $result['cne'];
            $_SESSION['diplome'] = $result['diplome'];
            $url = 'home';
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
        $email = stripcslashes(htmlspecialchars(trim($_POST['email'])));
        $password = trim($_POST['password']);
        $etContr = new EtudiantController($email, $password);
        $etContr->authenticate();
    }
}

handleLogin();