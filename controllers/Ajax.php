<?php

require_once '../models/Entreprise.php';
require_once '../models/Convention.php';
class Ajax
{
    private $entreprise;
    private $convention;

    public function __construct()
    {
        $this->entreprise = new Entreprise;
        $this->convention = new Convention;
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
                <table class="table bg-light  table-striped-rows">
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