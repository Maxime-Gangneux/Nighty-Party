<?php
// Démarrez la session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_soiree = $_POST['id_soiree'];
    $_SESSION['id_soiree'] = $id_soiree;
}

include '../../BDD/conexion.php';
include '../../BDD/get_images.php';
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

                    $id_soiree = $ligne['id_soiree'];
                    $images = getSoireeImages($id_soiree);
                    
                    echo "<section>
                            <div class='container_image'>";
                                if ($images){
                                    foreach ($images as $image) {
                                        echo"
                                        <img src='data:" . htmlspecialchars($image['image_type']) . ";base64," . base64_encode($image['image_data']) . "' alt='" . htmlspecialchars($image['image_name']) . "'>
                                        ";
                                    }
                                }else{
                                    echo"
                                    <img src='../../Image/logo.png'>
                                    ";
                                }
                                echo "
                                <div class='border_image'>
                                    <span class='line_top'></span>
                                    <span class='line_bottom_right'></span>
                                    <span class='line_bottom'></span>
                                    <span class='line_top_left'></span>
                                </div>
                            </div>
                            <div class='info_container'>
                                <div class='infos_general'>
                                    <div class='container_titre_soiree'><span class='titre_soiree'>{$nom_soiree}</span></div>
                                    <div class = 'adresse_date_container'>
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
                                    </div>
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
                                        <button onclick = 'showPopUp()'>Apporter du glouglou</button>";
                                        include '../../BDD/boissons.php';
                    echo "          </div>
                                </div>
                                <p>Nombre de personnes à la soirée: {$nombre_de_personne}</p>
                            </div>
                            <div class = 'pop_up_boisson' id = 'pop_up_boisson' onclick = 'hidePopUp()'>
                                <div class = 'pop_up'>
                                    <div class = 'quit' onclick = 'hidePopUp()'>
                                        <div class = 'barre gauche'></div>
                                        <div class = 'barre droite'></div>
                                    </div>                                       
                                    <button onclick = 'hidePopUp()'>fermer le pop up</button>
                                </div>
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
