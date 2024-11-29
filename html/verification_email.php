<?php

$dbpdo=new PDO('mysql:host=localhost;dbname=agence_de_voyage','root',"");
$dbpdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
if (isset($_GET['email']) && !empty($_GET['token'] && !empty($_GET['token']) )) {
    $email =$_GET['email'];
    $token = $_GET['token'];
    $requette=$dbpdo->prepare('SELECT * FROM agence_de_voyage.utilisateur WHERE email_utilisateur =:email AND token=:token');
    $requette->bindvalue(':email',$email);
    $requette->bindvalue(':token',$token);
    $requette->execute();
    $nombre=$requette->rowCount();
    if($nombre == 1){
         $update=$dbpdo->prepare('UPDATE utilisateur SET validite_email =:validation,token=:token WHERE email_utilisateur=:email');

        $update->bindvalue(':email',$email);
        $update->bindvalue(':token',"email confirmer ");  
        $update->bindvalue(':validation',1);
        $result11 = $update->execute();
        echo $result11;
        if($result11){
            echo "l'adresse mail est confirmee";
        } 

    }

}


?>