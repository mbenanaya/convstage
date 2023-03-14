<?php

require_once '../views/assets/dompdf/vendor/autoload.php';
use Dompdf\Dompdf;


// Get form data
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$cne = $_POST['cne'];
$filiere = $_POST['filiere'];
$nomEntr = $_POST['nomEntr'];
$adrEntr = $_POST['adrEntr'];
$telEntr = $_POST['telEntr'];
$nomEncd = $_POST['nomEncd'];
$datedebut = $_POST['datedebut'];
$datefin = $_POST['datefin'];

// Generate HTML
$html  = '<html><head>';
// $html .= '<link rel="stylesheet" type="text/css" href="style.css">';
$html .= '</head><body>';
$html .= '<h1>CONVENTION DE STAGE</h1>';
$html .= '<div style="width: 80%;height: 5px;border: 2px solid #000;border-top: 1px solid #7573fc;"></div>';
$html .= '<h2>Article 1 : Objet de la convention</h2>';
$html .= '<p><strong>CNE : </strong> '. $data['cne'].'</p>';
$html .= '<p><strong>Nom : </strong> '.$data['nom'].'</p>';
$html .= '<p><strong>Prenom : </strong> '.$data['prenom'].'</p>';
$html .= '<p><strong>Filiere : </strong> '.$data['filiere'].'</p>';
$html .= '<p><strong>Nom d\'entrprise : </strong> '.$data['nomEntr'].'</p>';
$html .= '<p><strong>Adresse d\'entrprise : </strong> ' . $data['adrEntr'] . '</p>';
$html .= '<p><strong>Tel d\'entrprise : </strong> ' . $data['telEntr'] . '</p>';
$html .= '<p><strong>Nom d\'encadrant : </strong> '.$data['nomEncd'].'</p>';
$html .= '<p><strong>Date debut : </strong> '.$data['datedebut'].'</p>';
$html .= '<p><strong>Date fin : </strong> ' . $data['datefin'] . '</p>';

$html .= '</body></html>';


// Generate PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$output = $dompdf->output();

// Generate filename
$filename = 'convention_'.$nom.'_'.$cne.'.pdf';

// Save PDF file
file_put_contents($filename, $output);

// Return download URL
// echo $filename;

// Send file to browser for download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="'.$filename.'"');
header('Content-Length: ' . filesize($filename));
readfile($filename);

// Delete temporary file
unlink($filename);