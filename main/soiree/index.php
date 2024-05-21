<?php
// Démarrez la session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_soiree = $_POST['id_soiree'];
    $_SESSION['id_soiree'] = $id_soiree;
}

include '../../BDD/conexion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soirée</title>
    <link rel="stylesheet" href="css.css">
    <script src="app.js"></script>
</head>
<body>
    <?php
        include '../nav_barre/nav_barre.php';

        // Se connecter à la base de données
        $connexion = connecterBaseDonnees();
        

        try {
            $requete = "SELECT * FROM soiree WHERE id_soiree = '{$_SESSION['id_soiree']}'";

            // Exécution de la requête
            $resultat = $connexion->query($requete);
            
            // Vérification du résultat
            if ($resultat) {
                while ($ligne = $resultat->fetch_assoc()) {
                    $nom_soiree = htmlspecialchars($ligne['nom_soiree']);
                    $date_soiree = date("l j F", strtotime($ligne['date_soiree']));
                    $description_soiree = $ligne['description_soiree'];
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
                                    <div class='container_description'>
                                        <strong><h3>Description</h3></strong><br>
                                        <div class='description'><p>{$description_soiree}</p></div><br>
                                    </div>
                                    <form method='POST'>";
                                        include '../../BDD/fonction.php';
                    echo "          </form>
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
