<?php

require_once '../models/Entreprise.php';
require_once '../models/Convention.php';

class ConvController
{
    private $convention;

    public function __construct()
    {
        $this->convention = new Convention;
    }
    public function createNewConv()
    {
        $data = [
            'cne' => '',
            'nom' => '',
            'prenom' => '',
            'filiere' => '',
            'nomEntr' => '',
            'adrEntr' => '',
            'telEntr' => '',
            'nomEncd' => '',
            'datedebut' => '',
            'datefin' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'cne' => $_POST['cne'],
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'filiere' => $_POST['filiere'],
                'nomEntr' => $_POST['nomEntr'],
                'adrEntr' => $_POST['adrEntr'],
                'telEntr' => $_POST['telEntr'],
                'nomEncd' => $_POST['nomEncd'],
                'datedebut' => $_POST['datedebut'],
                'datefin' => $_POST['datefin']
            ];
        }
        $this->convention->addNewConv($data);
        require_once './generate_conv.php';
    }

    public function showListOfConvs()
    {
        $data = $this->convention->getAllConvs();
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

$conv = new ConvController;

// $conv->addNewConv();

if (isset($_POST['action']) && $_POST['action'] == 'showConvs') {
    $conv->showListOfConvs();
}

if (isset($_POST['crCnvButt'])) {
    $conv->createNewConv();
}