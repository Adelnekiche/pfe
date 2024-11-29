<?php
$dsn='mysql:dbname=agence_de_voyage; host=localhost' ;
$user='root';
$password='';
try{
    $bddpdo=new PDO($dsn,$user,$password);
    $bddpdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    if($bddpdo){
        echo "hello";
    
                } 
    }catch(PDOException $e){
        echo "echec de connexion".$e->getMessage();
    }






?>