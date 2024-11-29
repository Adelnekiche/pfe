<!DOCTYPE html>
<html lang="en"></html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
    <link rel="stylesheet" href="../css/inscription.css">
</head>
<body>
 <?php
  $dbpdo=new PDO('mysql:host=localhost;dbname=agence_de_voyage','root',"");
  $dbpdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  if (isset($_POST['enregistrer'])){
  $name=$_POST['NOM'];
  $prenom=$_POST['prenom'];
  $email=$_POST['email'];
  $pwd=password_hash($_POST['pwd'],PASSWORD_DEFAULT);
  require_once "../includephp/token.php";
  $requete1=$dbpdo->prepare('SELECT * FROM utilisateur WHERE email_utilisateur=:email');
  $requete1->bindvalue(':email',$email);
$requete1->execute();
 
  if ($requete1->rowCount() >0 )
  {
    $message="l'adresse mail existe deja !";
  } 
  else{
    if(!($_POST['pwd'] == $_POST['cpwd'])){
      $message="la confiramtion et le mot de passe ne sont pas identique ";
    }


    else if (!empty($name) && !empty($prenom) && !empty($email)  )
  { 
    $requete=$dbpdo->prepare('INSERT INTO utilisateur(nom_utilisateur,prenom_utilisateur,email_utilisateur,password_utilisateur,token,rolle_utilisateur) VALUES (:nom,:prenom,:email,:pwd,:token,"membre")');
    $requete->bindvalue(':nom',$name);
    $requete->bindvalue(':prenom',$prenom);
    $requete->bindvalue(':email',$email);
    $requete->bindvalue(':pwd',$pwd);
    $requete->bindvalue(':token',$token);
    $result = $requete->execute();
    require_once "../envoiemail/sendmail.php";
    if (!$result) {
      echo "erreur";
    }else{
      $message= "l'enregistrement a etait bien fait, veuillez confirmer l'email ";
    }


  }else{
    $message= "les chams doivent etre tous remplis ";
  }
  }

  }

?>

  <section>
    <form action="inscription.php" method="post">
        <div class="box">
         <div class="container">
          <h1>inscription</h1>
          <?php
          if(isset($message) )
          echo '<div class="msgs"> '.$message .'</div>'
          ?>
          <label for="" >nom</label>
          <div class="inputbox">
         
          <input id="nom" type="text" name="NOM" required>
          </div>
          <label for="">prenom</label>
          <div class="inputbox">  
          <input id="prenom" type="text" name="prenom" >
          </div>
          <label for="">email</label>
          <div class="inputbox">
           
          <input id="email" type="email" name="email" required>
          </div>
          
          <label for="">mot de passe </label>
          <div class="inputbox">
                
          <input type="password"  name="pwd" required>
          </div>
          <label for="">confirm password</label>
          <div class="inputbox">
                  
          <input  id="cpassword" type="password"  name="cpwd"   required>
          <script>
            
          </script>
          </div>
          <button name="enregistrer" >creer un compte </button>
          <div class="connexion">
          <p>vous avez un compte <a href="./connexion.php">connexion</a></p>
          </div>
         
         </div>
        

        </div>
     

    </form>
  </section> 
</body>
</html>