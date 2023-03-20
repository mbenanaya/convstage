<?php

require_once './assets/dompdf/vendor/autoload.php';
use Dompdf\Dompdf;

$cne = $_POST['cne'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$filiere = $_POST['filiere'];
$nomEntr = $_POST['nomEntr'];
$adrEntr = $_POST['adrEntr'];
$telEntr = $_POST['telEntr'];
$nomEncd = $_POST['nomEncd'];
$datedebut = date('d/m/Y', strtotime($_POST['datedebut']));
$datefin = date('d/m/Y', strtotime($_POST['datefin']));


$path_fst = './assets/images/fst.jpg';
$type_fst = pathinfo($path_fst, PATHINFO_EXTENSION);
$data_fst = file_get_contents($path_fst);
$base64_fst = 'data:image/' . $type_fst . ';base64,' . base64_encode($data_fst);
$path_uca = './assets/images/uca.jpg';
$type_uca = pathinfo($path_uca, PATHINFO_EXTENSION);
$data_uca = file_get_contents($path_uca);
$base64_uca = 'data:image/' . $type_uca . ';base64,' . base64_encode($data_uca);


$html = '
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Convention de stage</title>
    <style type="text/css">
        * {font-family: \'Noto Sans Arabic UI\', sans-serif;box-sizing: border-box;}
    </style>
</head>
<body>

    <table border="0" style="width:100%;padding: 0;margin: 0 0 30px;">
        <tr style="width:100%">
            <td style="padding-right: 10px;">
                <img src="' . $base64_fst . '" style="width:123px;height:140px" alt="Logo FST">
            </td>
            <td rowspan="2"></td><td></td>
            <td style="text-align: center">
                <h2 style="font-size:24px;color:#6A5ACD;text-align:center;padding-top: 30px;">CONVENTION DE STAGE</h2>
            </td>
            <td rowspan="2"></td><td></td>
            <td style="padding-left: 10px;">
                <img src="' . $base64_uca . '" style="width:120px;height:140px" alt="Logo UCA">
            </td>
        </tr>
    </table>

    <div style="display:flex;max-width:900px;justify-self: center;flex-direction: column;justify-content: center;padding: 0 12px;">
        <div style="height: 4px;border: 1px solid #777;border-top: 2px solid #6A5ACD;"></div>
        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 20px 0 16px;font-weight: bold;">Article 1 : Objet de la convention</h3>
        <p style="color: #000 ;line-height: 1.5;font-size: 16px;margin-top: 0;max-width:900px;margin-bottom:0;font-family: \'Times New Roman\', Times,serif;">
            La présente convention de stage a pour objet de régler les rapports entre : <br>
            - La Faculté des Sciences et Techniques de Marrakech, représentée par son Doyen Monsieur <strong style="color: #296293;">Moha TAOURIRTE</strong> <br>
            Adresse : BP 549, AV. Abdelkrim El khattabi, Guéliz, Marrakech, Maroc, <br>
            Téléphone : +212 524 43 34 04 <br>
            Fax : +212 524 43 31 70 <br>
            et désignée ci après par Etablissement.
            <br>Et<br>
            - L’Organisme ci-dessous mentionné : <br>
            Nom: <strong style="color: #296293;">' . $nomEntr . '</strong> <br>
            Adresse: <strong style="color: #296293;">' . $adrEntr . '</strong> <br>
            Téléphone: <strong style="color: #296293;">' . $telEntr . '</strong> <br>
            Fax: .............................. <br>
            Représenté par: <strong style="color: #296293;">' . $nomEncd . '</strong> <br>
            Et désigné ci-après par l’Organisme. <br>
            Elle concerne : Étudiant(e) régulièrement inscrit(e) dans l’établissement pour l’année universitaire
            <strong style="color: #296293;">2022/2023</strong> <br>
            et dont la carte d’étudiant porte le numéro du CNE suivant : <strong style="color: #296293;">' . $cne . '</strong> sous le nom :
            <strong style="color: #296293;">' . $nom . ' ' . $prenom . '</strong> <br> Et dénommé ci-après le stagiaire.
        </p>
        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 2 : Objectif du stage</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;">
            <p style="color: #000 ;line-height: 1.5;font-size: 16px;margin-top: 0;max-width:900px;margin-bottom: 0;font-family:\'Times New Roman\', Times, serif;">
                Le stage de formation a pour objet de permettre à l’étudiant de mettre en pratique les outils théoriques
                et méthodologiques acquis au cours de sa formation, d\'identifier ses compétences et de conforter son
                objectif professionnel. <br>
                Le stage s\'inscrit dans le cadre de la formation et du projet personnel et professionnel de l’étudiant.
                <br>
                Il entre dans son cursus pédagogique et est obligatoire en vue de la délivrance du diplôme.
            </p>
        </div>
        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 3 : Lieu et période du stage</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;">
            <p style="color: #000 ;line-height: 1.5;font-size: 16px;margin-top: 0;max-width:900px;margin-bottom: 0;font-family: \'Times New Roman\',serif;">
                Le stage se déroulera du <strong style="color: #296293;">' . $datedebut . '</strong> au <strong style="color: #296293;">' . $datefin . '</strong>
                <br>
                Le stage aura lieu à <strong style="color: #296293;">' . $adrEntr . '</strong>
            </p>
        </div>
        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 4 : Statut du stagiaire – Accueil et encadrement
        </h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            L’étudiant, pendant la durée de son stage dans l’Organisme, demeure étudiant de l’Établissement ; il est
            suivi régulièrement par l’Établissement. L’Organisme nomme un Encadrant chargé d’assurer le suivi technique
            et d’optimiser les conditions de réalisation du stage.
        </div>
        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;"> Article 5 : Intitulé du stage</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            Le projet de stage est intitulé : ............................................................<br>
            Et son programme est établi en fonction de la spécialisation de l’étudiant. <br>
            Dans l’organisme d’accueil, le responsable de stage, chargé du suivi des travaux du stagiaire est : <br>
            Monsieur : <strong style="color: #296293;">' . $nomEncd . '</strong> <br>
            Qualité : ................................................................... <br>
            Téléphone : <strong style="color: #296293;">' . $telEntr . '</strong> <br>
            E-mail : .................................................................... <br>
            A la Faculté des Sciences et Techniques de Marrakech, le responsable de stage, chargé du suivi <br>
            des travaux du stagiaire est : <br>
            Monsieur : ................................................................ <br>
            Qualité : ................................................................... <br>
            Téléphone : .............................................................. <br>
            E-mail : .................................................................... <br>
        </div>
        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 6 : Gratification</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            L’étudiant ne peut prétendre à rémunération, cependant il peut bénéficier d’une gratification. <br>
            Les frais de déplacement et d’hébergement engagés par l’étudiant à la demande de l’Organisme, ainsi
            que les frais de formation éventuellement nécessités par le stage, seront intégralement pris en charge par
            l’Organisme selon les modalités qui y sont en vigueur.
        </div>

        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 7 : Responsabilité civile et assurances</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            Le stagiaire s’engage à se couvrir par un contrat d’assurance individuelle. <br>
            Lorsque l’Organisme met un véhicule à la disposition du stagiaire, il lui incombe de vérifier
            préalablement que la police d’assurance du véhicule couvre son utilisation par un étudiant.
        </div>

        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 8 : Discipline</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            Durant son stage, l’étudiant est soumis à la discipline et au règlement intérieur de l’Organisme, notamment
            en ce qui concerne les horaires, et les règles d’hygiène et de sécurité en vigueur dans l’Organisme. <br>
            Toute sanction disciplinaire ne peut être décidée que par l’Établissement. Dans ce cas,l’Organisme informe
            l’Établissement des manquements et lui fournit éventuellement les éléments constitutifs. <br>
            En cas de manquement particulièrement grave à la discipline, l’Organisme se réserve le droit de mettre fin
            au stage de l’étudiant tout en respectant les dispositions fixées à l’article 10 de la présente convention.
        </div>

        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 9 : Fin de stage – Rapport –Evaluation</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            A l’issue du stage, l’Organisme délivre au stagiaire une attestation de stage et remplit une fiche
            d’évaluation qu’il retourne à l’Établissement. Selon les règlements pédagogiques en vigueur, l’étudiant sera
            susceptible de fournir un rapport. Ce rapport ainsi que les éventuels travaux associés pourront être
            présentés lors d’une soutenance. <br>
            Le responsable direct du stagiaire ou tout autre membre de l\'Organisme appelé à se rendre à l\'Établissement
            dans le cadre de la préparation, du déroulement et de la validation du stage ne peut prétendre à une
            quelconque prise en charge ou indemnisation de la part de l\'Établissement.
        </div>

        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 10 : Absence et Interruption du stage
            Interruption temporaire</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            Au cours du stage, le stagiaire pourra bénéficier de congés sous réserve que la durée minimale du stage soit
            respectée. <br>
            Pour toute autre interruption temporaire du stage (maladie, maternité, absenceinjustifiée...) l’Organisme
            avertira le Responsable de l’Établissement par courrier.
        </div>

        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 11 : Devoir de réserve et confidentialité</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            Le devoir de réserve est de rigueur absolue. Les étudiants stagiaires prennent donc l’engagement de
            n’utiliser en aucun cas les informations recueillies ou obtenues par eux pour en faire l’objet de
            publication, communication à des tiers sans accord préalable de la Direction de l’Organisme, y compris le
            rapport de stage. Cet engagement vaudra non seulement pour la durée du stage mais également après son
            expiration. L’étudiant s’engage à ne conserver, emporter, ou prendre copie d’aucun document ou logiciel, de
            quelque nature que ce soit, appartenant à l’Organisme, sauf accord de ce dernier.
        </div>

        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 12 : Recrutement</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            Le stagiaire n’est lié par aucun contrat de travail avec l’organisme qui l’accueille. <br>
            S’il advenait qu’un contrat de travail prenant effet avant la date de fin du stage soit signé avec
            l’Organisme la présente convention deviendrait caduque ; l’ « étudiant » ne relèverait plus de la
            responsabilité de l’Établissement. Ce dernier devrait impérativement en être averti avant la signature du
            contrat.
        </div>

        <h3 style="text-decoration: underline;color:#222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 13 : Droit applicable – Tribunaux compétents
        </h3>
        <div style="font-family: \'Times New Roman\', serif;font-size:16px;line-height:1.5;">
            La présente convention est régie exclusivement par le droit marocain. Tout litige non résolu par voie
            amiable sera soumis à la compétence de la juridiction marocaine compétente.
        </div>

        <div style="display: flex;justify-content: center;margin: 20px 0;padding-left: 300px;">
            <p style="font-family: \'Noto Sans Arabic UI\',sans-serif;font-weight:bold;color:#121416;">
                Lu et approuvé Le stagiaire : <br>
                <strong style="color: #296293;">' . $nom . ' ' . $prenom . '</strong>, le ..................
        </div>
        <div style="font-family: \'Noto Sans Arabic UI\',sans-serif;font-weight:bold;margin: 20px 0;">
            Le Responsable de l\'Organisme d’Accueil ou son délégué, <br>
            ........................................................., le ..................
        </div>
        
        <table style="margin-top: 17px;">
            <tr>
                <td style="padding-right: 60px;">
                    <p style="font-family: \'Noto Sans Arabic UI\',sans-serif;font-weight:bold;color:#121416">
                        Pour l’établissement, <br>
                        Le Responsable de la Filière <strong style="color: #296293;">' . $filiere . '</strong> <br>
                        ........................................................., le ..................
                    </p>
                </td>
                <td style="padding-left: 60px;">
                    <p style="font-family: \'Noto Sans Arabic UI\',sans-serif;font-weight:bold;color:#121416">
                        <br> Le Doyen <br>
                        Marrakech, le ..................
                    </p>
                </td>
            </tr>
        </table>
        
    </div>
</body>
</html>
';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$pdf_content = $dompdf->output();
$filename = 'Convention_' . $nom . '_' . $cne;
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $filename . '.pdf"');
header('Content-Length: ' . strlen($pdf_content));
echo $pdf_content;