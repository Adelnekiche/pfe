<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contacter</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../js/remember.js"></script>
    <link rel="stylesheet" href="../css/connexion.css">
</head>
<?php
 
 if (isset($_POST['connexion']))
 {
    $dbpdo= new PDO('mysql:host=localhost;dbname=agence_de_voyage',"root","");
    $dbpdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $email=$_POST['email'];
    $password=$_POST['password'];
    $requette=$dbpdo->prepare('SELECT * FROM utilisateur where email_utilisateur=:email');
    $requette->bindValue(':email',$email);
    $requette->execute();
    $result = $requette->fetch();
    if (!$result){
        $message="L'adresse mail  est incorrecte ! ";
    }
    elseif($result['validite_email']==0) {
        $message="Veuillez confirmer votre adresse e-mail";
        $token=$result['token'];
        require_once "../envoiemail/sendmail.php";

        }
    else {
        $passwordIsOk = password_verify($password,$result['password_utilisateur']);
        if($passwordIsOk){
           session_start();
           $_SESSION['id_utilisateur'] = $result['id_utilisateur'];
           $_SESSION['email_utilisateur'] = $result['email_utilisateur'];
           $_SESSION['rolle_utilisateur'] = $result['rolle_utilisateur'];
           if($result['rolle_utilisateur']=='membre'){
            header('location:../index.php'); 
           }  
           elseif($result['rolle_utilisateur']=='admin'){
            header('location:./admin/espace_admin.php');
           }       

        }else {
            $message = "mot de passe incorrecte  " ;
        }


    }
    

  
 }

 




?>
<body>
    <section>
      <div class="form-box">
    <div class="form-value">
        <form action="connexion.php"  method="post" >
            <h2>login</h2>
            <?php
            if (isset($message))
            echo '<div class="message"><h5>'.$message.'</h5></div>';
            ?>
            <div class="inputbox">
                <i class='bx bx-envelope'></i>
            <input  type="email" name="email" required>
            <label for="">email</label>
            </div>
            <div class="inputbox">
                <i class='bx bx-lock-alt'></i>
            <input  type="password" name="password" required> 
            <label for="">password</label>
            </div>
            <div class="forget">
                <label for=""><input type="checkbox" id="rememberMeCheckbox">&nbsp;  remember me &nbsp; </label>

               
            </div>
            <div class="oublier"><a  href="">forget password</a></div>
            <div class="button_connexion">
                <input type="submit" value="connexion" name ="connexion">
            </div>
                
                <div class="register">
                  
                    <p class="inscription">don't have account ? <a href="./inscription.php">register</a></p>
   
          
        </form>
        </div>
    </div>

      </div>
      
    </section>
</body>
</html>