<?php

require_once '../models/Entreprise.php';
require_once '../models/Convention.php';
require_once '../generate_conv.php';

class ConvController
{
    private $convention;
    private $entreprise;

    public function __construct()
    {
        $this->convention = new Convention;
        $this->entreprise = new Entreprise;
    }

    public function createNewConv($pdfFilename)
    {
        $cne = stripcslashes(htmlspecialchars(trim($_POST['cne'])));
        $nom = stripcslashes(htmlspecialchars(trim($_POST['nom'])));
        $idConv = $cne . '_' . date('d-m-Y_H:i:s');
        $prenom = stripcslashes(htmlspecialchars(trim($_POST['prenom'])));
        $diplome = stripcslashes(htmlspecialchars(trim($_POST['diplome'])));
        $intitule = stripcslashes(htmlspecialchars(trim($_POST['intitule'])));
        $description = stripcslashes(htmlspecialchars(trim($_POST['description'])));
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
            'diplome' => '',
            'intitule' => '',
            'description' => '',
            'nomEntr' => '',
            'adrEntr' => '',
            'telEntr' => '',
            'nomEncd' => '',
            'datedebut' => '',
            'datefin' => '',
            'pdf' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'idConv' => $idConv,
                'cne' => $cne,
                'nom' => $nom,
                'prenom' => $prenom,
                'diplome' => $diplome,
                'intitule' => $intitule,
                'description' => $description,
                'nomEntr' => $nomEntr,
                'adrEntr' => $adrEntr,
                'telEntr' => $telEntr,
                'nomEncd' => $nomEncd,
                'datedebut' => $datedebut,
                'datefin' => $datefin,
                'pdf' => $pdfFilename,
            ];
        }

        // header('Content-Type: application/json');
        $this->entreprise->addNewEntr($data);
        $ins_conv = $this->convention->addNewConv($data);
        $response = [
            'conv' => $ins_conv,
        ];
        // echo json_encode($response);
        // echo $ins_conv;
        echo json_encode($ins_conv);
    }

    function fetchLastConv($cne)
    {
        header('Content-Type: application/json');
        $lastConvention = $this->convention->getLastConv($cne);
        echo json_encode($lastConvention);

        // echo $lastConvention;
    }

    public function showdiplomes()
    {
        $diplomes = [
            'Licence' => [],
            'Master' => [],
            'Ingenieur' => [],
        ];
        $licence = $this->convention->getDipsLicence();
        $master = $this->convention->getDipsMaster();
        $ingenieur = $this->convention->getDipsIngenieur();

        if (!empty($licence)) {
            $diplomes['Licence'] = $licence;
        }

        if (!empty($master)) {
            $diplomes['Master'] = $master;
        }

        if (!empty($ingenieur)) {
            $diplomes['Ingenieur'] = $ingenieur;
        }

        if (empty($diplomes['Licence']) && empty($diplomes['Master']) && empty($diplomes['Ingenieur'])) {
            $diplomes['error'] = "La base est vide";
        }

        header('Content-Type: application/json');
        echo json_encode($diplomes, JSON_UNESCAPED_UNICODE);
    }

    public function showListOfConvs($f)
    {
        $data = [];
        if ($f === "Tous") {
            $data = $this->convention->getAllConvs();
        } else {
            $data = $this->convention->getConvBydiplome($f);
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function deleteConv($cne)
    {
        $response = [];
        header('Content-Type: application/json');
        if ($this->convention->deleteConv($cne) === true) {
            $response = ['success' => 'Convention supprimée avec succès.'];
        } else {
            $response = ['error' => 'Une erreur est survenue'];
        }
        // echo $response;
        echo json_encode($response);
        // exit();
    }
}

$conv = new ConvController;
// $conv->deleteConv("G135336421");

if (isset($_POST['action']) && $_POST['action'] == 'showConvs') {
    $conv->showdiplomes();
}

if (isset($_POST['action']) && $_POST['action'] == 'showFiltered') {
    $fil = $_POST['diplome'];
    $conv->showListOfConvs($fil);
}

if (isset($_POST['crCnvButt'])) {
    $pdfFilename = generatePDF();
    $conv->createNewConv($pdfFilename);
}

if (isset($_POST['action']) && isset($_POST['stud_cne']) && $_POST['action'] == 'getLastConv') {
    $cne = $_POST['stud_cne'];
    $conv->fetchLastConv($cne);
}

if (isset($_POST['action']) && isset($_POST['cne']) && $_POST['action'] == 'delConv') {
    $cne = $_POST['cne'];
    $conv->deleteConv($cne);
}
