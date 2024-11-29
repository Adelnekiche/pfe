<!DOCTYPE html>

<?php
 session_start();
 if (!isset($_SESSION['id_utilisateur'])) {
     header("Location: connexion.php");
     exit();} 
     $idd = $_GET['id'];

?>
<?php
    $dbpdo = new PDO('mysql:host=localhost;dbname=agence_de_voyage', 'root', "");
    $dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (!isset($_POST['reserver'])){ 
    $requette=$dbpdo->prepare('SELECT * FROM hotel where id_hotel=:id');
    $requette->bindValue(':id',$idd);
    $requette->execute();
    $result = $requette->fetch(PDO::FETCH_ASSOC);
    }

    


?>

<?php
 $dbpdo = new PDO('mysql:host=localhost;dbname=agence_de_voyage', 'root', "");
 $dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['reserver'])){
  $utilisateur = $_SESSION['id_utilisateur'];
  $date_debut = $_POST['date'];
  $date_fin = $_POST['date_fin'];
  $nbr = $_POST['nbr'] ;
  $requete = $dbpdo->prepare('INSERT INTO reservation_hotel (utilisateur, hotel, nbr_personne, date, date_fin) VALUES (:utilisateur, :hotel, :nbr_personne, :date, :date_fin)');
            $requete->bindValue(':utilisateur', $utilisateur, PDO::PARAM_INT);
            $requete->bindValue(':hotel', $idd, PDO::PARAM_INT);
            $requete->bindValue(':nbr_personne', $nbr, PDO::PARAM_INT);
            $requete->bindValue(':date', $date_debut, PDO::PARAM_STR);
            $requete->bindValue(':date_fin', $date_fin, PDO::PARAM_STR);
  $result = $requete->execute();
  if($result){
    $message="la reservation a etait bien envoye " ; 
  }
  header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . urlencode($idd));
 



}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/detaille_hotel.css">
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
                <li><a class="active" href="html/ajout_hotel.php">Hotel</a></li>
                <li><a href="propos.php">A Propos</a></li>
                <li><a href="contact.php">Contact</a></li> 
               </ul>
        </nav>
    </header>

    <article class="hotel-article">
        <header class="hotel-header">
            
            
            <p class="hotel-location"><?php echo $result['nom_hotel'] ?></p>
        </header>
        <section class="hotel-gallery">
        <img id="image" src="<?php echo htmlspecialchars('admin/img/' . $result['photo_hotel']); ?>" alt="Photo de l'hotel">
        </section>
        <?php
            if (isset($message)){
                 echo '<div class="message"><h5>'.$message.'</h5></div>' ;
            }
           ;
            ?>
        <section class="hotel-description">
            <h2>PRIX:<?php echo $result['prix_hotel'] ?> $/nuit</h2>
            <h2>À propos de l'hôtel</h2>
            <p>
              <?php 
                echo $result['description_detaille'];
              ?>
            </p>
        </section>
        <section class="hotel-services">
            <h2>Services et équipements</h2>
            <ul>
                <li>Wi-Fi gratuit</li>
                <li>Restaurant gastronomique</li>
                <li>Spa et centre de bien-être</li>
                <li>Centre de fitness</li>
                <li>Piscine intérieure</li>
                <li>Service de chambre 24h/24</li>
            </ul>
        </section>
        <div class="formulaire">

         <form action="detaille_hotel.php?id=<?php echo urlencode($idd); ?>" method="post" >
         <label for=""> vous reservez pour quelle date </label>
         <input name='date' type="date">
         <label for="to"> jusqu'a quand? </label>
         <input type="date" name= 'date_fin'>
         <label for="nbr">vous reservez pour combien de personne ? </label>
         <input name="nbr" type="number"> 
    <button name="reserver" type="submit">Réservez</button>
    </form>
        
        </div>
       


        </form>
    </article>


    
    <div class="vorp"></div>
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


