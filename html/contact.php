<!DOCTYPE html>
<?php
try {
    $dbpdo = new PDO('mysql:host=localhost;dbname=agence_de_voyage', 'root', '');
    $dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['send'])) {
        $name = $_POST['name'];
        $prenom = $_POST['prenom'];
        $numero = $_POST['num'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $requete = $dbpdo->prepare('INSERT INTO contacter (nom_cont, prenom_cont, nmr_cont, adresse_cont, message_cont) VALUES (:nom, :prenom, :num, :adresse, :message)');
        $requete->bindParam(':nom', $name);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':num', $numero);
        $requete->bindParam(':adresse', $email);
        $requete->bindParam(':message', $message);

        $result = $requete->execute();

        if (!$result) {
            echo "Erreur lors de l'envoi du message.";
        } else {
            $message="Le message a été bien envoyé.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<html>
<head>
<meta charset="UTF-8">
<title>CONTACT</title>
<link rel="stylesheet" href="../css/contaact.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <header>
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
    
             <label class="logo"> 𝕄ℕ𝔹 𝕋𝕣𝕒𝕧𝕖𝕝 </label>
               <ul>
               <li><a  href="../index.php">Acceuil</a></li>
                <li><a href="ajout_annonce.php">Annonce</a></li>
                <li><a href="ajout_hotel.php">Hotel</a></li>
                <li><a href="propos.php">A Propos</a></li>
                <li><a class="active" href="contact.php">Contact</a></li>
               </ul>
        </nav>
    </header>
    <div class="alemmas">
        <div class="contenu">
            <h2> Contactez-nous</h2>
            <p>Chez MNB TRAVEL, nous comprenons que voyager est bien plus qu'une simple aventure : c'est un investissement tant humain que financier. Nous nous engageons à surpasser vos attentes pour vous offrir une expérience de voyage sur mesure inoubliable.</p>
    
        </div>
    
        <div class="container">
            <h2>Nous contacter</h2>
            <div class="articles">
                <article class="article">
                    <h3 class="article-title">Appeler-nous</h3>
                    <p class="article-content">0555 555 555</p>
                </article>
                <article class="article">
                    <h3 class="article-title">Envoyer un e-mail</h3>
                    <p class="article-content">contact@mnb.com</p>
                </article>
                <article class="article">
                    <h3 class="article-title">Réseaux sociaux</h3>
                    <p class="article-content"><a href="https://www.facebook.com">Facebook</a></p>
                </article>
            </div>
        </div>
       <div class="msg">
        <h2>Envoyer-nous un message</h2>
       </div>
       <div class="formul">
        <form action="#" method="POST"  id="form">
        <?php
          if(isset($message) )
          echo '<div class="msgs"> '.$message .'</div>'
          ?>
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" placeholder="Votre nom" required><br>
            <label for="secondname">Prénom :</label>
            <input type="text" id="secondname" name="prenom" placeholder="Votre prénom" required><br>
            <label for="num">N° de téléphone :</label>
            <input type="number" id="num" name="num" placeholder="Votre N° de téléphone" required><br>
            <label for="addresse">Adresse e-mail :</label>
            <input type="email" id="addresse" name="email" placeholder="Votre adresse e-mail" required><br>
            <label for="message">Message :</label>
            <textarea id="message" name="message" placeholder="Votre message" required></textarea>
            <button type="submit" class="submit-button" name="send" id="submitbutton" >
                <span class="txt">Envoyer</span>
                <span class="txt2">Envoyé!</span>
                <span class="loader-container">
                    <span class="loader"></span>
                </span>
            </button>
        </form>
       </div>
    </div>
    <footer>
        <div class="sub">
          <div class="sub-1">
              
              <div class="container1">
                      <label class="logo"> 𝕄ℕ𝔹 𝕋𝕣𝕒𝕧𝕖𝕝 </label>
                  <h3>EVADEZ-VOUS VERS L'INCONU</h3>
          
              </div>
              <div class="part2">
              <div class="container2">
                  <h2> Info</h2>
                  <h3><a href="#">Services</a></h3>
                  <h3><a href="#">Pricing</a></h3>
                  <h3><a href="#">Community</a></h3>
              </div>
              <div class="container3">
                  <h2>Resource</h2>
                  <h3><a href="#">Blog</a></h3>
                  <h3><a href="#">Learn more</a></h3>
                  <h3><a href="#">Projects</a></h3>

              </div>
              </div>
              <div class="part3">
              <div class="container4">
                  <h2>Social</h2>
                  <h3><a href="https://www.facebook.com/">Facebook</a></h3>
                  <h3><a href="https://www.instagram.com/">Instagram</a></h3>
                  <h3><a href="https://www.linkedin.com/">linkedIn</a></h3>
              </div>
              <div class="container5">
                  <h2>Company</h2>
                  <h3><a href="propos.html">About Us</a></h3>
                  <h3><a href="#">Contact Us</a></h3>
                  <h3><a href="#">FAQ</a></h3>
              </div>
          </div>
          </div>
            <hr>
            <div class="sub-2">
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-google"></i>
                <i class="fa-brands fa-youtube"></i>
            </div>
            <div class="sub-3">
                <h5>&#169 Copyright. All rights reserved</h5>
            </div>
        </div>
    </footer>

   



</body>



</html>