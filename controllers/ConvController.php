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
            'datefin' => ''
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
    public function showdiplomes()
    {
        $diplomes = [];
        $licenceData = $this->convention->getDipsLicence();
        $masterData = $this->convention->getDipsMaster();
        $ingenieurData = $this->convention->getDipsIngenieur();

        if (!empty($licenceData)) {
            $diplomes['Licence'][] = $licenceData;
        }

        if (!empty($masterData)) {
            $diplomes['Master'][] = $masterData;
        }

        if (!empty($ingenieurData)) {
            $diplomes['Ingenieur'][] = $ingenieurData;
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
}

$conv = new ConvController;


if (isset($_POST['action']) && $_POST['action'] == 'showConvs') {
    $conv->showdiplomes();
}

if (isset($_POST['action']) && $_POST['action'] == 'showFiltered') {
    $fil = $_POST['diplome'];
    $conv->showListOfConvs($fil);
}

if (isset($_POST['crCnvButt'])) {
    $conv->createNewConv();
}