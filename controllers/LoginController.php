<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../database/Database.php';
require_once '../models/Etudiant.php';
require_once '../models/Admin.php';
class LoginController
{
    private $etudiant;
    private $admin;
    public $db;
    public $conn;

    public function __construct()
    {
        $this->etudiant = new Etudiant;
        $this->db = new Database;
        $this->conn = $this->db->getConnection();
        $this->admin = new Admin;
    }

    public function StudentLogin($cne, $dateNaiss)
    {
        header('Content-Type: application/json');

        $cne = filter_var($cne, FILTER_SANITIZE_STRING);
        $dateNaiss = filter_var($dateNaiss, FILTER_SANITIZE_STRING);
        $row = $this->etudiant->Login($cne, $dateNaiss);

        if ($row) {
            session_start();
            $_SESSION['prenom'] = $row['prenom'];
            $_SESSION['nom'] = $row['nom'];
            $_SESSION['cne'] = $row['cne'];
            $_SESSION['diplome'] = $row['diplome'];
            $url = 'home';
            $response = array(
                'success' => true,
                'url' => $url,
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Le cne ou le mot de passe est invalide'
            );
        }
        echo json_encode($response);
        $this->conn = null;
    }

    public function AdminLogin($email, $password)
    {
        header('Content-Type: application/json');

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
        $row = $this->admin->adminLogin($email, $password);

        if ($row) {
            session_start();
            $_SESSION['username'] = $row['username'];
            $url = 'admin';
            $response = array(
                'success' => true,
                'url' => $url,
            );
        } else {
            $response = array(
                'success' => false,
                'message' => "L'email ou le mot de passe est invalide"
            );
        }
        echo json_encode($response);
        $this->conn = null;
    }
}

$login = new LoginController();

if (isset($_POST['student_login'])) {
    $cne = stripcslashes(htmlspecialchars(trim($_POST['cne'])));
    $dateNaiss = stripcslashes(htmlspecialchars(trim($_POST['datenaiss'])));
    $login->StudentLogin($cne, $dateNaiss);
}

if (isset($_POST['connecter'])) {
    $email = stripcslashes(htmlspecialchars(trim($_POST['email'])));
    $password = stripcslashes(htmlspecialchars(trim($_POST['password'])));
    $login->AdminLogin($email, $password);
}