<?php
// Démarrez la session
session_start();

// Récupérer l'ID de la soirée à partir des paramètres de l'URL
if (isset($_GET['id_soiree'])) {
    $id_soiree = $_GET['id_soiree'];
    $_SESSION['id_soiree'] = $id_soiree;
} elseif (isset($_POST['id_soiree'])) {
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
                    
                    echo "
                    <main>
                        <section>
                            <div class='container_button_back'>
                                <button class='button_back' onclick='Back()'><img src='../../Image/icon_back.svg'>Retour</button>
                            </div>
                            <div class='container_image'>";
                                if ($images){
                                    $nbr_image = count($images);
                                    if ($nbr_image > 1){
                                        $image_actuelle = 0;
                                        echo"
                                        <a class='prev' onclick='plusSlide(-1)'>&#10094;</a>
                                        <div class='slide_container'>";
                                            foreach ($images as $image) {
                                                $image_actuelle += 1;
                                                echo"
                                                <div class='mySlides fade'>
                                                    <div class='numbertext'>{$image_actuelle}/{$nbr_image}</div>
                                                    <img src='data:" . htmlspecialchars($image['image_type']) . ";base64," . base64_encode($image['image_data']) . "' alt='" . htmlspecialchars($image['image_name']) . "'>
                                                </div>
                                                ";
                                            }
                                            echo "<div class='container_dot' style='text-align: center'>";
                                            for ($i = 1; $i <= $nbr_image; $i++) {
                                                echo "<span class='dot' onclick='currentSlide({$i})'></span>";
                                            }
                                            echo "</div>";
                                            echo "</div>
                                            <a class='next' onclick='plusSlide(1)'>&#10095;</a>
                                            ";

                                    }else{
                                        $image = $images[0];
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
                                    <div class='container_titre_soiree'><span class='nom_soiree'>{$nom_soiree}</span></div>
                                    <div class = 'adresse_date_container'>
                                        <a href='#' class='calendar_link' onclick='openCalendar(\"{$nom_soiree}\", \"{$adresse_soiree}\", \"{$date_soiree}\", \"{$heure_min_soiree}\", \"{$heure_max_soiree}\")'>
                                            <div class='logo'><img src ='../../image/icon_calendar.svg'></div>
                                            <div class='container_calendar'>
                                                <strong><p>{$date_soiree}</p></strong>
                                                <p class='heure'><i>de {$heure_min_soiree} à {$heure_max_soiree}</i></p>
                                            </div>
                                        </a>
                                        <a href='#' class='location_link' onclick='openMap(\"{$adresse_soiree}\"\"{$ville_soiree}\")'>
                                            <div class='logo'><img src ='../../image/icon_location.svg'></div>
                                            <div class='container_location'>
                                                <strong><p>{$ville_soiree}</p></strong>
                                                <p class='adresse'><i>{$adresse_soiree}</i></p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class='container_description'>
                                        <div class='header_description'>
                                            <h3><strong>Description</strong></h3>
                                        </div>
                                        <div class='description'>{$description_soiree}</div>
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
                                <button class='delete'>
                                    <div class='trash'>
                                        <div class='top'>
                                            <div class='paper'></div>
                                        </div>

                                        <div class='box'></div>

                                        <div class='check'>
                                            <svg viewBox='0 0 8 6'>
                                                <polyline points='1 3.4 2.71428571 5 7 1'></polyline>
                                            </svg>
                                        </div>
                                    </div> <span>Delete Party</span>
                                </button>
                            </div>
                            <div class = 'pop_up_boisson' id = 'pop_up_boisson'>
                                <div class = 'pop_up'>
                                    <div class = 'quit' onclick = 'hidePopUp()'>
                                        <div class = 'barre gauche'></div>
                                        <div class = 'barre droite'></div>
                                    </div>
                                    <div class = 'pop_up_title'>Apportez des boissons</div>
                                        <div class = 'pop_up_main'>
                                            <form method='GET'>
                                                <input id ='input_boisson'name = 'input_boisson' class = 'input_boisson' placeholder = 'recherchez une boisson' oninput = 'redirection_js()'></input>
                                            </form>";
                                            include '../../BDD/boisson_apporte.php';
                    echo "              </div>                                     
                                    </div>                                       
                                </div>
                            </div>
                        </section>
                    </main>";
                }
            } else {
                throw new Exception("Erreur lors de l'exécution de la requête : " . $connexion->error);
            }  
        } catch (Exception $e) {
            // Gérer l'exception (erreur)
            echo "Erreur : " . $e->getMessage();
        }
    ?>

</body>    
</html>
