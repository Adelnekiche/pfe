<!DOCTYPE html>

<?php
try {
    $dbpdo = new PDO('mysql:host=localhost;dbname=agence_de_voyage', 'root', "");
    $dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $dbpdo->prepare("SELECT id_annonce, titre_annonce, description_annonce, prix_annonce, photo_annonce FROM annonce");
    $stmt->execute();
    $annonces = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $requette=$dbpdo->prepare('SELECT COUNT(*) as nb_user FROM annonce');
    $requette->execute();
    $result = $requette->fetch(PDO::FETCH_ASSOC);
    $nbannonce = $result['nb_user'];
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/ajout_annonce.css">
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
                <li><a class="active" href="ajout_annonce.php">Annonce</a></li>
                <li><a href="ajout_hotel.php">Hotel</a></li>
                <li><a href="propos.php">A Propos</a></li>
                <li><a href="contact.php">Contact</a></li> 
               </ul>
        </nav>
    </header>
   
    <?php
            $counter = 0;
            foreach ($annonces as $annonce) {
                if ($counter % 3 == 0 ) {
                    if($counter == 0){
                      echo '<section class="destinations">';
                    echo '<div class="destination-list">';  
                    }
                    else{
                        echo '</section><section class="destinations">';
                        echo '</div><div class="destination-list">';  
                    }
                }
                ?>
                <div class="destination">
                <img src="<?php echo htmlspecialchars('admin/img/' . $annonce['photo_annonce']); ?>" alt="Photo de l'annonce">
                    <h3><?php echo htmlspecialchars($annonce['titre_annonce']); ?></h3>
                    <p><?php echo htmlspecialchars($annonce['description_annonce']); ?></p>
                    <a href="affichage_annonce.php.?id=<?php echo htmlspecialchars($annonce['id_annonce']);  ?>" class="cta-button">Réservez maintenant</a>
                </div>

            
                <?php
                $counter++;
                
            }
            if($counter == $nbannonce ){
                echo '</section>' ;
                echo '</div>';

            }
        
            ?>
            

   
   

</body>
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
</html>


