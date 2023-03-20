<?php

require_once '../models/Entreprise.php';
require_once '../models/Convention.php';

class ConvController
{
    private $convention;
    private $entreprise;

    public function __construct()
    {
        $this->convention = new Convention;
        $this->entreprise = new Entreprise;
    }
    public function createNewConv()
    {

        $cne = stripcslashes(htmlspecialchars(trim($_POST['cne'])));
        $nom = stripcslashes(htmlspecialchars(trim($_POST['nom'])));
        $idConv = $cne . '_' . date('d-m-Y_H:i:s');
        $prenom = stripcslashes(htmlspecialchars(trim($_POST['prenom'])));
        $filiere = stripcslashes(htmlspecialchars(trim($_POST['filiere'])));
        $nomEntr = stripcslashes(htmlspecialchars(trim($_POST['nomEntr'])));
        $adrEntr = stripcslashes(htmlspecialchars(trim($_POST['adrEntr'])));
        $telEntr = stripcslashes(htmlspecialchars(trim($_POST['telEntr'])));
        $nomEncd = stripcslashes(htmlspecialchars(trim($_POST['nomEncd'])));
        $datedebut = $_POST['datedebut'];
        $datefin = $_POST['datefin'];

        $data = [
            'idConv' => '',
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
                'idConv' => $idConv,
                'cne' => $cne,
                'nom' => $nom,
                'prenom' => $prenom,
                'filiere' => $filiere,
                'nomEntr' => $nomEntr,
                'adrEntr' => $adrEntr,
                'telEntr' => $telEntr,
                'nomEncd' => $nomEncd,
                'datedebut' => $datedebut,
                'datefin' => $datefin
            ];
        }

        header('Content-Type: application/json');
        $this->entreprise->addNewEntr($data);
        $ins_conv = $this->convention->addNewConv($data);
        $response = [
            'conv' => $ins_conv,
        ];
        echo json_encode($response);

    }
    public function showListOfConvs()
    {
        $data = $this->convention->getAllConvs();
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

$conv = new ConvController;

if (isset($_POST['action']) && $_POST['action'] == 'showConvs') {
    $conv->showListOfConvs();
}

if (isset($_POST['crCnvButt'])) {
    $conv->createNewConv();
}