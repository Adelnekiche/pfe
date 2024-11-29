<!DOCTYPE html>
<?php
try {
    $dbpdo = new PDO('mysql:host=localhost;dbname=agence_de_voyage', 'root', "");
    $dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['ajouter'])) {
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $prix = $_POST['prix'];
         // Obtenir le nom de l'image sans l'extension
    $file_basename = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME);


    // Renommer l'image en y ajoutant le nom de base et la date et l'heure
    $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $new_image_name = $file_basename . '_' . date("Ymd_His") . '.' . $file_extension;
        
       
        if (!empty($titre) && !empty($description) && !empty($date) && !empty($prix)) {
            $requete = $dbpdo->prepare('INSERT INTO annonce (titre_annonce, description_annonce, prix_annonce, date_annonce,photo_annonce) VALUES (:titre, :description, :prix, :date,:image)');
            
            // Utilisation de bindParam au lieu de bindValue et correction des noms des paramètres
            $requete->bindParam(':titre', $titre);
            $requete->bindParam(':description', $description);
            $requete->bindParam(':prix', $prix);
            $requete->bindParam(':date', $date);
            $requete->bindParam(':image', $new_image_name);
            $result = $requete->execute();


            if (!$result) {
                $message= "Erreur lors de l'ajout de l'annonce.";
            } else {
              $target_directory = "img/";
              $target_path = $target_directory . $new_image_name;
              if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_path)) {
                header("Location:Annonce.php");
            }
            }
        } else {
            $message= "Tous les champs sont obligatoires.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Gestion de la suppression d'une annonce
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'supprimer') {
  $id = $_POST['id'];

  $sql = 'DELETE FROM annonce WHERE id_annonce = :id';
  $stmt = $dbpdo->prepare($sql);
  $stmt->execute(['id' => $id]);

  header('Location: ' . $_SERVER['PHP_SELF']);
  exit;
}

// Gestion de la modification d'une annonce
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'modifier') {
  $id = $_POST['id'];
  $titre = $_POST['titre_annonce'];
  $description = $_POST['description_annonce'];
  $prix = $_POST['prix_annonce'];
  $date = $_POST['date_annonce'];
  $photo = $_POST['photo_annonce'];

  $sql = 'UPDATE annonce SET titre_annonce = :titre, description_annonce = :description, prix_annonce = :prix, date_annonce = :date, photo_annonce = :photo WHERE id_annonce = :id';
  $stmt = $dbpdo->prepare($sql);
  $stmt->execute([
      'titre' => $titre,
      'description' => $description,
      'prix' => $prix,
      'date' => $date,
      'photo' => $photo,
      'id' => $id
  ]);

  header('Location: ' . $_SERVER['PHP_SELF']);
  exit;
}

// Récupérer toutes les annonces
$sql = 'SELECT id_annonce, titre_annonce, description_annonce, prix_annonce, date_annonce, photo_annonce FROM annonce';
$stmt = $dbpdo->prepare($sql);
$stmt->execute();
$annonces = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="../../css/annonce.css">
  
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
          <h2>Annonce</h2>
        </div>
        <div class="form-container">
        <h2>Ajouter un article de voyage</h2>
        
        <?php
        echo $message;
          if(isset($message) )
          echo '<div class="msgs"> '.$message .'</div>'
          ?>
        <form action="Annonce.php" method="post" enctype="multipart/form-data">>
            <div class="form-group">
                <label for="titre">Titre du voyage:</label>
                <input type="text" id="titre" name="titre" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="prix">Prix:</label>
                <input type="number" id="prix" name="prix" required>
            </div>
            <label for="imageUpload">Sélectionnez une image:</label>
            <input type="file" name="image" accept="image/*" >
            <button name="ajouter" type="submit">Ajouter l'article</button>
        </form>
        
        
    </div>
    <h1>Liste des annonce </h1>
        
    <?php foreach ($annonces as $annonce): ?>
        <div class="annonce">
            <h2><?php echo htmlspecialchars($annonce['titre_annonce']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($annonce['description_annonce'])); ?></p>
            <p>Prix: <?php echo htmlspecialchars($annonce['prix_annonce']); ?> €</p>
            <p>Date: <?php echo htmlspecialchars($annonce['date_annonce']); ?></p>
            <img id="photo_annonce" src="<?php echo htmlspecialchars('img/' . $annonce['photo_annonce']); ?>" alt="Photo de l'annonce">

            <br>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $annonce['id_annonce']; ?>">
                <input type="hidden" name="action" value="modifier">
                <button type="submit">Modifier</button>
            </form>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $annonce['id_annonce']; ?>">
                <input type="hidden" name="action" value="supprimer">
                <button type="submit">Supprimer</button>
            </form>
        </div>
    <?php endforeach; ?>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'modifier'): ?>
        <?php
        $id = $_POST['id'];
        $sql = 'SELECT * FROM annonce WHERE id_annonce = :id';
        $stmt = $dbpdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $annonce = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
        <h2>Modifier l'annonce</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $annonce['id_annonce']; ?>">
            <input type="hidden" name="action" value="modifier">
            <label for="titre_annonce">Titre:</label>
            <input type="text" id="titre_annonce" name="titre_annonce" value="<?php echo htmlspecialchars($annonce['titre_annonce']); ?>"><br>
            <label for="description_annonce">Description:</label>
            <textarea id="description_annonce" name="description_annonce"><?php echo htmlspecialchars($annonce['description_annonce']); ?></textarea><br>
            <label for="prix_annonce">Prix:</label>
            <input type="text" id="prix_annonce" name="prix_annonce" value="<?php echo htmlspecialchars($annonce['prix_annonce']); ?>"><br>
            <label for="date_annonce">Date:</label>
            <input type="date" id="date_annonce" name="date_annonce" value="<?php echo htmlspecialchars($annonce['date_annonce']); ?>"><br>
            <label for="photo_annonce">Photo:</label>
            <input type="text" id="photo_annonce" name="photo_annonce" value="<?php echo htmlspecialchars($annonce['photo_annonce']); ?>"><br>
            <button type="submit">Mettre à jour</button>
        </form>
    <?php endif; ?>
      

          
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="../../js/espace_admin.js"></script>
    <thead>
    
                               
  </body>
</html>