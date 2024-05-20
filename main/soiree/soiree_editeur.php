<?php
// Démarrez la session
session_start();

include '../../BDD/conexion.php';

// Se connecter à la base de données
$connexion = connecterBaseDonnees();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_soiree'])) {
        $id_soiree = $_POST['id_soiree'];
        $_SESSION['id_soiree'] = $id_soiree;
    }
    
    if (isset($_POST['description_soiree'])) {
        $new_description = $_POST['description_soiree'];
        $update_requete = "UPDATE soiree SET description_soiree = ? WHERE id_soiree = ?";
        $stmt = $connexion->prepare($update_requete);
        $stmt->bind_param('si', $new_description, $_SESSION['id_soiree']);
        $stmt->execute();
        $stmt->close();
        
        // Mettre à jour la variable de session
        $description_soiree = $new_description;
        echo "Description mise à jour avec succès.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la Description de la Soirée</title>
    <link rel="stylesheet" href="css.css">
    <script src="app.js"></script>
</head>
<body>
    <?php
        include '../nav_barre/nav_barre.php';

        try {
            $requete = "SELECT * FROM soiree WHERE id_soiree = ?";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param('i', $_SESSION['id_soiree']);
            $stmt->execute();
            $resultat = $stmt->get_result();
            
            if ($resultat) {
                while ($ligne = $resultat->fetch_assoc()) {
                    $nom_soiree = htmlspecialchars($ligne['nom_soiree']);
                    $date_soiree = date("l j F", strtotime($ligne['date_soiree']));
                    $description_soiree = htmlspecialchars($ligne['description_soiree']);
                    $adresse_soiree = htmlspecialchars($ligne['adresse_soiree']);
                    $ville_soiree = htmlspecialchars($ligne['ville_soiree']);
                    $statu_soiree = htmlspecialchars($ligne['statu_soiree']);
                    $heure_min_soiree = (new DateTime($ligne['heure_min_soiree']))->format('H:i');
                    $heure_max_soiree = (new DateTime($ligne['heure_max_soiree']))->format('H:i');
                    echo "<section>
                            <div class='image'></div>
                            <div class='info_container'>
                                <div class='infos_general'>
                                    <div class='container_titre_soiree'><span class='titre_soiree'>{$nom_soiree}</span></div>
                                    <a href='#' class='calendar_link' onclick='openCalendar(\"{$nom_soiree}\", \"{$adresse_soiree}\", \"{$date_soiree}\", \"{$heure_min_soiree}\", \"{$heure_max_soiree}\")'>
                                        <div class='logo'><img src ='../../image/icon_calendar.svg'></div>
                                        <div class='container_calendar'>
                                            <strong><p>{$date_soiree}</p></strong>
                                            <p class='heure'><i>de {$heure_min_soiree} à {$heure_max_soiree}</i></p>
                                        </div>
                                    </a>
                                    <a href='#' class='location_link' onclick='openMap(\"{$adresse_soiree}\")'>
                                        <div class='logo'><img src ='../../image/icon_location.svg'></div>
                                        <div class='container_location'>
                                            <strong><p>{$ville_soiree}</p></strong>
                                            <p class='adresse'><i>{$adresse_soiree}</i></p>
                                        </div>
                                    </a>
                                    <form method='POST' action='' class='container_description'>
                                        <strong><h3>Description</h3></strong><br>
                                        <textarea id='description_soiree' name='description_soiree' class='description' rows='4' cols='50'>{$description_soiree}</textarea><br>
                                        <input type='submit' value='Mettre à jour'>
                                    </form>
                                    <form method='POST' action='index.php'>
                                        <a href='index.php'>Apercu</a>
                                    </form>  
                                </div>
                                <div class='contenue'>
                                    <div class='personnes'>";
                                        include '../../BDD/invites.php';
                    echo "          </div>
                                    <div class='boissons'>
                                        <button>Apporter du glouglou</button>";
                                        include '../../BDD/boissons.php';
                    echo "          </div>
                                </div>
                                <p>Nombre de personnes à la soirée: {$nombre_de_personne}</p>
                            </div>
                        </section>";
                }
            } else {
                throw new Exception("Erreur lors de l'exécution de la requête : " . $connexion->error);
            }
        } catch (Exception $e) {
            // Gérer l'exception (erreur)
            echo "Erreur : " . $e->getMessage();
        }
    ?>
    <footer>
        <p>Créé et conçu par Muller Julien & Gangneux Maxime</p>
    </footer>
</body>
</html>
