<!DOCTYPE html>
<html lang="en">
 <?php
  $dbpdo= new PDO('mysql:host=localhost;dbname=agence_de_voyage',"root","");
  $dbpdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $requette=$dbpdo->prepare('SELECT COUNT(*) as nb_user FROM utilisateur');
  $requette->execute();
  $result = $requette->fetch(PDO::FETCH_ASSOC);
  $nbuser = $result['nb_user'];
  $requette=$dbpdo->prepare('SELECT COUNT(*) as nb_user FROM annonce');
  $requette->execute();
  $result = $requette->fetch(PDO::FETCH_ASSOC);
  $nbannonce = $result['nb_user'];
  $requette=$dbpdo->prepare('SELECT COUNT(*) as nb_user FROM contacter');
  $requette->execute();
  $result = $requette->fetch(PDO::FETCH_ASSOC);
  $nbcontacter = $result['nb_user'];
  
  ?>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../css/espace_admin.css">
  </head>
  <body>
    <div class="grid-container">

      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-left">
          
        </div>
        
        <div class="header-right">
          <span class="material-icons-outlined"><a href="">notifications</a></span>
          <span class="material-icons-outlined"><a href="">email</a></span>
          <span class="material-icons-outlined"><a href="">account_circle</a></span>
        </div>
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <span class="material-icons-outlined">shopping_cart</span> ADMIN 
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="./espace_admin.php" target="_self">
              <span class="material-icons-outlined">dashboard</span> Tableau de bord 
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="./Annonce.php" target="_self">
              <span class="material-icons-outlined">inventory_2</span> Annonce 
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="./liste_voyage.php" target="_self">
            <span class="material-symbols-outlined">flights_and_hotels</span>Liste voyage reserver     </a>
          </li>
          <li class="sidebar-list-item">
            <a href="./client.php" target="_self">
              <span class="material-icons-outlined">groups</span> client 
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="./Hotel.php" target="_self">
            <span class="material-symbols-outlined"> hotel </span> Hotel 
                                                      
                 
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="./liste_hotel.php" target="_self">
            <span class="material-symbols-outlined">list_alt</span>Liste hotel reserver     </a>
          </li> 
         
          
        </ul>
          </li>
          <li class="sidebar-list-item">
            <a href="./message.php" target="_self">
            <span class="material-symbols-outlined">mail</span>message    </a>
          </li>
          
        </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <h2>Tableau de bord</h2>
        </div>

        <div class="main-cards">

          <div class="card">
            <div class="card-inner">
              <h3>Client</h3>
              <span class="material-icons-outlined">inventory_2</span>
            </div>
            <h1><?php echo $nbuser ?></h1>
          </div> 
          
          <div class="card">
            <div class="card-inner">
              <h3>Annonces</h3>
              <span class="material-icons-outlined">groups</span>
            </div>
            <h1><?php echo  $nbannonce ?></h1>
          </div>

          <div class="card">
            <div class="card-inner">
              <h3>Messages</h3>
              <span class="material-icons-outlined">notification_important</span>
            </div>
            <h1><?php echo $nbcontacter ?></h1>
          </div>

         

          
          

        </div>

        <div class="charts">

          
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="../../js/espace_admin.js"></script>
  </body>
</html>