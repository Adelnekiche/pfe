<!DOCTYPE html>
<?php
try {
    $dbpdo = new PDO('mysql:host=localhost;dbname=agence_de_voyage', 'root', "");
    $dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $message = ""; // Initialize the message variable

    if (isset($_POST['ajouter'])) {
        $nom = $_POST['titre'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $file_basename = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME);

        // Renommer l'image en y ajoutant le nom de base et la date et l'heure
        $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $new_image_name = $file_basename . '_' . date("Ymd_His") . '.' . $file_extension;
        
        if (!empty($nom) && !empty($description) && !empty($prix)) {
            $requete = $dbpdo->prepare('INSERT INTO hotel (nom_hotel, description_hotel, prix_hotel, photo_hotel) VALUES (:nom, :description, :prix, :image)');

            $requete->bindParam(':nom', $nom);
            $requete->bindParam(':description', $description);
            $requete->bindParam(':prix', $prix);
            $requete->bindParam(':image', $new_image_name);
            $result = $requete->execute();

            if (!$result) {
                $message = "Erreur lors de l'ajout de l'hôtel.";
            } else {
                $target_directory = "img/";
                $target_path = $target_directory . $new_image_name;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_path)) {
                    $message = "L'ajout de l'hôtel a été bien fait.";
                } else {
                    $message = "Erreur lors du téléchargement de l'image.";
                }
                header("Location: Hotel.php");
            }
        } else {
            $message = "Tous les champs sont obligatoires.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'supprimer') {
        $id = $_POST['id'];

        $sql = 'DELETE FROM hotel WHERE id_hotel = :id';
        $stmt = $dbpdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    if ($_POST['action'] === 'modifier') {
        $id = $_POST['id'];
        $nom = $_POST['nom_hotel'];
        $description = $_POST['description_hotel'];
        $prix = $_POST['prix_hotel'];

        $sql = 'UPDATE hotel SET nom_hotel = :nom, description_hotel = :description, prix_hotel = :prix WHERE id_hotel = :id';
        $stmt = $dbpdo->prepare($sql);
        $stmt->execute([
            'nom' => $nom,
            'description' => $description,
            'prix' => $prix,
            'id' => $id
        ]);

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

$sql = 'SELECT id_hotel, nom_hotel, description_hotel, prix_hotel,photo_hotel FROM hotel';
$stmt = $dbpdo->prepare($sql);
$stmt->execute();
$hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="../../css/hotel.css">
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
        <h2>Hotel</h2>
    </div>

    <div class="main-cards">

    <div class="form-container">
        <h2>Ajouter un Hotel</h2>
    
        <?php
            if (isset($message)) {
                echo '<div class="msgs">' . $message . '</div>';
            }
        ?>
        <form action="Hotel.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titre">Nom de l'Hotel:</label>
                <input type="text" id="titre" name="titre" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="prix">Prix:</label>
                <input type="number" id="prix" name="prix" required>
            </div>
            <label for="imageUpload">Sélectionnez une image:</label>
            <input type="file" name="image" accept="image/*" required>
            <button name="ajouter" type="submit">Ajouter l'article</button>
        </form>
    </div>

    </div>

    <div class="charts">

    <?php foreach ($hotels as $annonce): ?>
        <div class="annonce">
            <h2><?php echo htmlspecialchars($annonce['nom_hotel']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($annonce['description_hotel'])); ?></p>
            <p>Prix: <?php echo htmlspecialchars($annonce['prix_hotel']); ?> €</p>            
            <img id="photo_hotel" src="<?php echo htmlspecialchars('img/' . $annonce['photo_hotel']); ?>" alt="Photo de l'annonce">

            <br>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $annonce['id_hotel']; ?>">
                <input type="hidden" name="action" value="modifier">
                <button type="submit">Modifier</button>
            </form>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $annonce['id_hotel']; ?>">
                <input type="hidden" name="action" value="supprimer">
                <button type="submit">Supprimer</button>
            </form>
        </div>
    <?php endforeach; ?>
    
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

