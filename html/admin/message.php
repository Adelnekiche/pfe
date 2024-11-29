<!DOCTYPE html>
<?php
$dbpdo= new PDO('mysql:host=localhost;dbname=agence_de_voyage',"root","");
$dbpdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$stmt = $dbpdo->prepare("SELECT id_cont, nom_cont, prenom_cont, nmr_cont, adresse_cont, message_cont FROM contacter");
    $stmt->execute();
    $contacts = $stmt->fetchAll();
    
?>
<?php

$id_con=00;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
  supprimer_utilisateur($_POST['delete']);
}
function supprimer_utilisateur($id){
  try {
  
      // Connexion à la base de données
      $dbpdo = new PDO('mysql:host=localhost;dbname=agence_de_voyage', "root", "");
      $dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Requête SQL pour supprimer l'utilisateur
      $requete = $dbpdo->prepare("DELETE FROM contacter WHERE id_cont = :id");
      $requete->bindParam(':id', $id, PDO::PARAM_INT);
      $requete->execute();

      // Redirection pour rafraîchir la page après suppression
      header("Location: ".$_SERVER['PHP_SELF']);
      exit();
  } catch (PDOException $e) {
      echo 'Erreur : ' . $e->getMessage();
  }
}

?>
<html lang="en">


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
        
      <h1>Liste des Contacts</h1>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Numéro de téléphone</th>
            <th>Adresse mail</th>
            <th>Message descriptif</th>
            <th scope="col">Suprimer</th>
        </tr>
        <?php foreach ($contacts as $contact): ?>
        <tr>
            <td><?= htmlspecialchars($contact['nom_cont']) ?></td>
            <td><?= htmlspecialchars($contact['prenom_cont']) ?></td>
            <td><?= htmlspecialchars($contact['nmr_cont']) ?></td>
            <td><?= htmlspecialchars($contact['adresse_cont']) ?></td>
            <td><?= htmlspecialchars($contact['message_cont']) ?></td>
            <?php  
            $id_conn = $contact['id_cont'];
            echo "<td><form method='post' action=''><button type='submit' name='delete' value='$id_conn'>Supprimer</button></form></td></tr>";
            ?>
        </tr>
        <?php endforeach; ?>
    </table>
          
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