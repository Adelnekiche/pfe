<!DOCTYPE html>
<?php
try {
    $dbpdo = new PDO('mysql:host=localhost;dbname=agence_de_voyage', "root", "");
    $dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch reservations
    $stmt = $dbpdo->prepare("SELECT id_reservationvg, utilisateur, annonce, nombre_personne FROM reservation_voyage");
    $stmt->execute();
    $hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    supprimer_utilisateur($_POST['delete']);
  }
  
  function supprimer_utilisateur($id){
    try {
        // Connexion à la base de données
        $dbpdo = new PDO('mysql:host=localhost;dbname=agence_de_voyage', "root", "");
        $dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
        // Requête SQL pour supprimer l'utilisateur
        $requete = $dbpdo->prepare("DELETE FROM reservation_voyage WHERE id_reservationvg = :id");
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="../../css/espace_admin.css">
</head>
<body>
    <div class="grid-container">
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left"></div>
            <div class="header-right">
                <span class="material-icons-outlined"><a href="">notifications</a></span>
                <span class="material-icons-outlined"><a href="">email</a></span>
                <span class="material-icons-outlined"><a href="">account_circle</a></span>
            </div>
        </header>

        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <span class="material-icons-outlined">shopping_cart</span> ADMIN
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>
            <ul class="sidebar-list">
                <li class="sidebar-list-item"><a href="./espace_admin.php" target="_self"><span class="material-icons-outlined">dashboard</span> Tableau de bord</a></li>
                <li class="sidebar-list-item"><a href="./Annonce.php" target="_self"><span class="material-icons-outlined">inventory_2</span> Annonce</a></li>
                <li class="sidebar-list-item"><a href="./liste_voyage.php" target="_self"><span class="material-symbols-outlined">flights_and_hotels</span>Liste voyage reserver</a></li>
                <li class="sidebar-list-item"><a href="./client.php" target="_self"><span class="material-icons-outlined">groups</span> client</a></li>
                <li class="sidebar-list-item"><a href="./Hotel.php" target="_self"><span class="material-symbols-outlined">hotel</span> Hotel</a></li>
                <li class="sidebar-list-item"><a href="./liste_hotel.php" target="_self"><span class="material-symbols-outlined">list_alt</span>Liste hotel reserver</a></li>
                <li class="sidebar-list-item"><a href="./message.php" target="_self"><span class="material-symbols-outlined">mail</span>message</a></li>
            </ul>
        </aside>

        <main class="main-container">
            <div class="main-title">
                <h2>Liste des reservation pour les  voyage </h2>
            </div>
            <table border="1">
                <tr>
                    <th>Nom client</th>
                    <th>Prénom client</th>
                    <th>Email</th>
                    <th>Titre annonce</th>
                    <th>Nombre de personne </th>
                    <th scope="col">Supprimer</th>
                </tr>
                <?php foreach ($hotels as $contact): ?>
                    <?php
                    $id = $contact['utilisateur'];
                    $requete = $dbpdo->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id");
                    $requete->bindParam(':id', $id, PDO::PARAM_INT);
                    $requete->execute();
                    $users = $requete->fetch(PDO::FETCH_ASSOC);
                    $idd = $contact['annonce'];
                    $requete = $dbpdo->prepare("SELECT * FROM annonce WHERE id_annonce = :id");
                    $requete->bindParam(':id', $idd, PDO::PARAM_INT);
                    $requete->execute();
                    $hotel = $requete->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($users['nom_utilisateur']) ?></td>
                        <td><?= htmlspecialchars($users['prenom_utilisateur']) ?></td>
                        <td><?= htmlspecialchars($users['email_utilisateur']) ?></td>
                        <td><?= htmlspecialchars($hotel['titre_annonce']) ?></td>
                        <td><?= htmlspecialchars($contact['nombre_personne']) ?></td>
                        <?php 
                        $id_reservation = $contact['id_reservationvg'] ;
                         echo "<td><form method='post' action=''><button type='submit' name='delete' value='$id_reservation'>Supprimer</button></form></td></tr>";
                        ?>


                       
                    </tr>
                <?php endforeach; ?>
            </table>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <script src="../../js/espace_admin.js"></script>
</body>
</html>
