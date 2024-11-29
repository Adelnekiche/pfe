<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    if($_SESSION){
      $id = $_SESSION['id_utilisateur'];  
      if(isset($_POST["deconnexion"])){
        session_unset();
        session_destroy();
        header("Location: ./html/connexion.php");
          }
    }
   
    
    
    
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php 
     if($_SESSION){ 
        echo '<div class="deco">
        <form action="index.php"  method="post">
        <button name="deconnexion" class="logout-btn" style="position: relative; right: -90%;  padding: 10px 20px; background-color: #f00; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Déconnexion</button>
        </form>  ';
      
     }
    
    ?>
  
    
</head>

<body>
    
    
    </div>
<header>
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
    
             <label class="logo"> 𝕄ℕ𝔹 𝕋𝕣𝕒𝕧𝕖𝕝 </label>
               <ul>
                <li><a class="active" href="home.php">Acceuil</a></li>
                <li><a href="html/ajout_annonce.php">Annonce</a></li>
                <li><a href="html/ajout_hotel.php">Hotel</a></li>
                <li><a href="html/propos.php">A Propos</a></li>
                <li><a href="html/contact.php">Contact</a></li> 
               </ul>
        </nav>
    </header>

<header class="header">
           
        <h1>Bienvenue à notre Agence de Voyage</h1>
        <p>Découvrez des destinations incroyables avec nous</p>
        <?php
       if(!$_SESSION){
        echo '<div class="header-buttons  ">
                <a href="html/connexion.php" class="btn btn-login">Connexion</a>
                <a href="html/inscription.php" class="btn btn-signup">Inscription</a>
            </div>' ;
       }


        ?>
         
    </header>

    <div class="main-content">
        <section class="hero">
            <div class="hero-content">
                <h2>Explorez le monde avec nous</h2>
                <p>Des offres exceptionnelles pour des destinations de rêve</p>
                <a href="html/ajout_annonce.php" class="cta-button">Réservez maintenant</a>
            </div>
        </section>

        <section class="hero">
            <div class="hero-content">
                <h2>Réservation d'Hôtel</h2>
                <p>Trouvez et réservez les meilleurs hôtels à des prix compétitifs.</p>
                <a href="html/ajout_hotel.php" class="cta-button">Réservez un Hôtel</a>
            </div>
        </aside>
    </div>

    <section class="destinations">
        <h2>Nos Destinations Populaires</h2>
        <div class="destination-list">
            <div class="destination">
                <img src="images/paris.jpg" alt="Paris">
                <h3>Paris</h3>
                <p>La ville de l'amour et des lumières</p>
                <a href="#" class="cta-button">Réservez maintenant</a>
            </div>
            <div class="destination">
                <img src="images/bali.jpg" alt="Bali">
                <h3>Bali</h3>
                <p>Un paradis tropical en Indonésie</p>
                <a href="#" class="cta-button">Réservez maintenant</a>
            </div>
            <div class="destination">
                <img src="images/new_york.png" alt="New York">
                <h3>New York</h3>
                <p>La ville qui ne dort jamais</p>
                <a href="#" class="cta-button">Réservez maintenant</a>
            </div>
        </div>
    </section>


    
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


