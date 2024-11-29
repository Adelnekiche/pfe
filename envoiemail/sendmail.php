 <?php 

use PHPMailer\PHPMailer\PHPMailer ;
use PHPMailer\PHPMailer\Execption ;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth=true ;
$mail->Username = 'nekicheadel00@gmail.com';
$mail->Password = 'fryl gehg hvxb nxuo';
$mail->SMTP = 'tls';
$mail->Port = 587;
$mail->Charset = "utf-8";
$mail->setFrom('nekicheadel00@gmail.com','adel dev');
$mail->addAddress($_POST['email'],'agence');
$mail->isHtml(true);

$mail->Subject = 'confirmation  ';

$mail->Body = "Afin de valider votre adresse mail , cliquer sur le lien suivant : <a href= 'localhost/pfe/html/verification_email.php?token=".$token."&email=".$_POST['email']."' >Confiramtion email </a>";
$mail->SMTPDebug =0 ;
if(!$mail->send()){
    $msg ="mail non envoye ";
    echo 'Erreur ' .$mail->ErrorInfo;

} else {
    $mess="un mail vient d'etre envoye a votre adresse email pour confirmer la creation de votre compte ";
    
}
