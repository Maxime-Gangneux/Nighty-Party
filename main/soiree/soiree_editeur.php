<?php
// Démarrez la session
session_start();

include '../../BDD/conexion.php';
include '../../BDD/get_images.php';

// Se connecter à la base de données
$connexion = connecterBaseDonnees();

// Fonction pour supprimer une image
function del_img($id_image, $connexion){
    $rqt_del_img = $connexion->prepare('DELETE FROM images WHERE id_image = ?');
    $rqt_del_img->bind_param("i", $id_image);
    if ($rqt_del_img->execute()) {
        $rqt_del_img->close();
        return true;
    } else {
        $rqt_del_img->close();
        return false;
    }
}


// Fonction pour mettre à jour la description de la soirée
function update_description($new_description, $id_soiree, $connexion){
    $update_requete = "UPDATE soiree SET description_soiree = ? WHERE id_soiree = ?";
    $stmt = $connexion->prepare($update_requete);
    $stmt->bind_param('si', $new_description, $id_soiree);
    if ($stmt->execute()) {
        echo "Description mise à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de la description de la soirée: " . $stmt->error;
    }
    $stmt->close();
}

// Fonction pour télécharger une image
function upload_image($imageName, $imageType, $imageSize, $imageData, $id_soiree, $connexion){
    $allowed_types = [
        'image/jpeg', 'image/png', 'image/gif', 'image/bmp',
        'image/tiff', 'image/webp', 'image/vnd.microsoft.icon',
        'image/svg+xml', 'image/heic', 'image/heif',
        'application/pdf', 'image/vnd.adobe.photoshop',
        'image/x-canon-cr2', 'image/x-nikon-nef', 'image/jpg'
    ];

    if (in_array($imageType, $allowed_types)) {
        $stmt_img = $connexion->prepare("INSERT INTO images (image_name, image_type, image_size, image_data) VALUES (?, ?, ?, ?)");
        if ($stmt_img === false) {
            echo "Error preparing the image insert statement: " . $connexion->error;
            exit();
        } else {
            $stmt_img->bind_param("ssis", $imageName, $imageType, $imageSize, $imageData);

            if ($stmt_img->execute()) {
                $imageId = $stmt_img->insert_id;

                $stmt_assoc = $connexion->prepare("INSERT INTO soiree_images (soiree_id, image_id) VALUES (?, ?)");
                if ($stmt_assoc === false) {
                    echo "Error preparing the association statement: " . $connexion->error;
                    exit();
                } else {
                    $stmt_assoc->bind_param("ii", $id_soiree, $imageId);

                    if ($stmt_assoc->execute()) {
                        echo "Image uploaded and associated with the soirée successfully!";
                    } else {
                        echo "Error associating the image with the soirée: " . $stmt_assoc->error;
                    }
                    $stmt_assoc->close();
                }
            } else {
                echo "Error uploading the image: " . $stmt_img->error;
            }
            $stmt_img->close();
        }
    } else {
        echo "Unsupported image type: " . $imageType;
    }
}

// Traitement des requêtes POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_soiree'])) {
        $id_soiree = $_POST['id_soiree'];
        $_SESSION['id_soiree'] = $id_soiree;
    }

    if (isset($_POST['description_soiree'])) {
        $new_description = $_POST['description_soiree'];
        update_description($new_description, $_SESSION['id_soiree'], $connexion);
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        upload_image($_FILES['image']['name'], $_FILES['image']['type'], $_FILES['image']['size'], file_get_contents($_FILES['image']['tmp_name']), $_SESSION['id_soiree'], $connexion);
    } else {
        if (isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
            echo "Image not uploaded. Error code: " . $_FILES['image']['error'];
        }
    }

    if (isset($_POST['button_del_img'])){
        $id_image_a_supprimer = $_POST['id_image'];
        if (isset($_POST['id_image'])){
            if (del_img($id_image_a_supprimer, $connexion)) {
                echo "Image supprimée avec succès!";
            } else {
                echo "<script>alert('Erreur lors de la suppression de l'image. Veuillez réessayer.');</script>";
            }
        } else {
            echo "<script>alert('Erreur: ID de l'image non spécifié. Veuillez réessayer.');</script>";
        }
    }
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Editeur</title>
    <link rel="stylesheet" href="css.css">
    <script src="app.js" defer></script>
</head>
<body>
    <?php
    include '../nav_barre/nav_barre.php';

    try {
        if (isset($_SESSION['id_soiree'])) {
            $id_soiree = $_SESSION['id_soiree'];
            $requete = "SELECT * FROM soiree WHERE id_soiree = ?";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param('i', $id_soiree);
            $stmt->execute();
            $resultat = $stmt->get_result();

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
                        <section class='page_editeur'>
                            <div class='container_button_back'>
                            <button class='button_back' onclick='Back()'><img src='../../Image/icon_back.svg'>Retour</button>
                        </div>
                        <div class='container_image'>";
                            $nbr_image = count($images);
                            $image_actuelle = 0;
                            echo"<a class='prev' onclick='plusSlide(-1)'>&#10094;</a>";
                            if ($nbr_image > 0) {
                                echo "
                                <div class='slide_container'>";
                                    foreach ($images as $image) {
                                        $image_actuelle += 1;
                                        $id_image = $image['id_image'];
                                        echo "
                                        <div class='mySlides fade'>
                                            <div class='numbertext'>{$image_actuelle}/5</div>
                                                <div class='container_button_del_img'>
                                                    <form method='POST'onsubmit=\"return confirm('Êtes-vous sûr de vouloir supprimer cette image ?');\">
                                                    <input type='hidden' name='id_image' value='{$id_image}'>
                                                    <button class='button_del_img' name='button_del_img'>suprimer image</button>
                                                </form>
                                            </div>
                                            
                                            <img src='data:" . htmlspecialchars($image['image_type']) . ";base64," . base64_encode($image['image_data']) . "' alt='" . htmlspecialchars($image['image_name']) . "'>
                                        </div>";
                                    }
                                    // Ajouter des placeholders pour compléter à 5 éléments
                                    for ($i = $nbr_image + 1; $i <= 5; $i++) {
                                        echo "
                                        <div class='mySlides fade'>
                                            <div class='numbertext'>{$i}/5</div>
                                            <div class='add_image'>
                                                <form id='uploadForm{$i}' method='POST' enctype='multipart/form-data'>
                                                    <input class='add_image_input' type='file' name='image'>
                                                </form>
                                            </div>
                                        </div>";
                                    }
                                    $image_actuelle = 0;
                                    echo "
                                    <div class='container_dot'>";
                                        foreach ($images as $image) {
                                            $image_actuelle += 1;
                                            echo "<span class='dot' onclick='currentSlide({$image_actuelle})'><img src='data:" . htmlspecialchars($image['image_type']) . ";base64," . base64_encode($image['image_data']) . "' alt='" . htmlspecialchars($image['image_name']) . "'><div class='numbertext'>{$image_actuelle}/5</div></span>";
                                        }
                                        for ($i = $nbr_image + 1; $i <= 5; $i++) {
                                            echo "<span class='dot' onclick='currentSlide({$i})'><div class='numbertext'>{$i}/5</div></span>";
                                        }
                                    echo "</div>
                                </div>";
                            } else {
                                for ($i = 1; $i <= 5; $i++) {
                                    echo "
                                    <div class='mySlides fade'>
                                        <div class='numbertext'>{$i}/5</div>
                                        <div class='add_image'>
                                            <form id='uploadForm{$i}' method='POST' enctype='multipart/form-data'>
                                                <input class='add_image_input' type='file' name='image'>
                                            </form>
                                        </div>
                                    </div>";
                                }
                                echo "
                                <div class='container_dot'>";
                                for ($i = 1; $i <= 5; $i++) {
                                    echo "<span class='dot' onclick='currentSlide({$i})'></span>";
                                }
                                echo "</div>";
                            }
                            echo "
                        <div class='border_image'>
                            <span class='line_top'></span>
                            <span class='line_bottom_right'></span>
                            <span class='line_bottom'></span>
                            <span class='line_top_left'></span>
                        </div>
                        <a class='next' onclick='plusSlide(1)'>&#10095;</a>
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
                            <form method='POST' action='' class='container_description'>
                                <strong><h3>Description</h3></strong><br>
                                <div id='description_soiree' class='description'><p>{$description_soiree}</p></div><br>
                                <button type='button' onclick='editElement(\"description_soiree\")'>Éditer</button>
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
                </section>
            </main>";
            }
        } else {
            throw new Exception("Erreur lors de l'exécution de la requête : " . $connexion->error);
        }
    } else {
        echo "ID de soirée non défini.";
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
