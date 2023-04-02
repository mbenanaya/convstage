<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/assets/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/assets/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/assets/PHPMailer/src/Exception.php';
require_once __DIR__ . '../../database/Database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['email'])) {

    $email = $_POST['email'];

    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin) {
        $username = $admin['username'];
        $reset_link = "http://localhost/convstage/reset-password/username=" . urlencode($username);

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bamouhcine91@gmail.com';
        $mail->Password = 'mjbmlqsvpodlbsez';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = "UTF-8";
        $mail->setFrom('bamouhcine91@gmail.com', 'FSTG Admin');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Réinitialiser mot de passe';
        $mail->Body = "<p> Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe : <br><br> <a href=".$reset_link.">Réinitialiser mot de passe</a> </p>";

        header('Content-Type: application/json');
        try {
            $mail->send();
            echo json_encode(array('success' => 'Veuillez vérifier votre boîte email et suivre les instructions pour réinitialiser votre mot de passe.'));
        } catch (Exception $e) {
            echo json_encode(array('error' => 'Une erreur est survenue. Veuillez réessayer une autre fois.'));
        }

        exit;
    } else {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'L\'adresse email n\'est pas trouvé.'));
        exit;
    }
}