<?php
session_start();
require_once '../models/Entreprise.php';
require_once '../models/Convention.php';
require_once '../models/Admin.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);
class Ajax
{
    private $entreprise;
    private $convention;
    private $admin;

    public function __construct()
    {
        $this->entreprise = new Entreprise;
        $this->convention = new Convention;
        $this->admin      = new Admin;
    }
    public function getEntrNames()
    {
        $data = $this->entreprise->getEntrNames();
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    public function getEntInfos($id)
    {
        $data = $this->entreprise->getEntrById($id);
        
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function showListOfEntr()
    {
        $data = $this->entreprise->getAllEntreprises();
        $output = '';
        $output .= '
                <table class="table table-responsive table-sm table-striped table-hover bg-light table-striped-rows">
                    <thead>
                        <tr>
                            <th scope="col">Nom d\'entreprise</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Telephone</th>
                            <th scope="col">Nom d\'encadrant</th>
                        </tr>
                    </thead>
                    <tbody>
            ';
        foreach ($data as $row) {
            $output .= "
                    <tr>
                        <td>". $row['nomEntr'] . "</td>
                        <td>". $row['adrEntr'] . "</td>
                        <td>". $row['telEntr'] . "</td>
                        <td>". $row['nomEncd'] . "</td>
                    <tr>
                ";
        }
        $output .= "</tbody></table>";
        echo $output;
    }

    public function resetPassword($password, $username)
    {
        header('Content-Type: application/json');
        if ($this->admin->updatePass($password, $username)) {
            echo json_encode(array('success' => 'Mot de passe mis à jour avec succès'));
        } else {
            echo json_encode(array('error' => 'Erreur lors de la mise à jour du mot de passe, veuillez réessayer'));
        }
    }

}

$aj = new Ajax;

if (isset($_POST['action']) && $_POST['action'] == 'showNames') {
    $aj->getEntrNames();
}

if (isset($_POST['idEntr'])) {
    $id = $_POST['idEntr'];
    $aj->getEntInfos($id);
}

if (isset($_POST['action']) && $_POST['action'] == 'show') {
    $aj->showListOfEntr();
}

if (isset($_POST['password']) && isset($_POST['username'])) {
    $password = $_POST['password'];
    $username = $_POST['username'];
    $aj->resetPassword($password, $username);
}