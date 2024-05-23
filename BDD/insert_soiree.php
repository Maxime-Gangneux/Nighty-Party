<?php
include 'conexion.php';
$connexion = connecterBaseDonnees();
session_start();

if (isset($_POST['submit_button'])) {
    $nom_soiree = utf8_decode($_POST['nom_soiree']);
    $description_soiree = utf8_decode($_POST['description_soiree']);
    $adresse_soiree = utf8_decode($_POST['adresse_soiree']);
    $ville_soiree = $_POST['ville_soiree'];
    $date_soiree = date("Y-m-d", strtotime(trim($_POST['date_soiree'])));
    $heure_min_soiree = date("H:i:s", strtotime(trim($_POST['heure_min_soiree'])));
    $heure_max_soiree = date("H:i:s", strtotime(trim($_POST['heure_max_soiree'])));
    $nb_personne_soiree = trim($_POST['nb_personne_soiree']);
    $theme_soiree = addslashes(trim($_POST['theme_soiree']));
    $type_soiree = utf8_decode($_POST['type_soiree']);
    $statu_soiree = utf8_decode($_POST['statu_soiree']);
    $id_compte = $_SESSION['id_compte'];

    if (empty($nom_soiree) || empty($description_soiree) || empty($adresse_soiree) || empty($ville_soiree) || empty($date_soiree) || empty($heure_min_soiree) || empty($heure_max_soiree) || empty($nb_personne_soiree) || empty($theme_soiree) || empty($type_soiree) || empty($statu_soiree)) {
        echo "Veuillez remplir tous les champs.";
    } else {
        $sql = "INSERT INTO soiree (nom_soiree, description_soiree, adresse_soiree, ville_soiree, date_soiree, heure_min_soiree, heure_max_soiree, nb_personne_soiree, theme_soiree, type_soiree, statu_soiree) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $connexion->prepare($sql);
        if ($stmt === false) {
            echo "Erreur de préparation de la requête : " . $connexion->error;
            exit();
        }
        $stmt->bind_param("sssssssisss", $nom_soiree, $description_soiree, $adresse_soiree, $ville_soiree, $date_soiree, $heure_min_soiree, $heure_max_soiree, $nb_personne_soiree, $theme_soiree, $type_soiree, $statu_soiree);

        if ($stmt->execute()) {
            $id_soiree = $stmt->insert_id;

            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $imageName = $_FILES['image']['name'];
                $imageType = $_FILES['image']['type'];
                $imageSize = $_FILES['image']['size'];
                $imageData = file_get_contents($_FILES['image']['tmp_name']);

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
            } else {
                echo "Image not uploaded. Error code: " . $_FILES['image']['error'];
            }

            $requete = $connexion->prepare('INSERT INTO invite (id_compte, id_soiree) VALUES (?, ?)');
            if ($requete === false) {
                echo "Error preparing the invite statement: " . $connexion->error;
                exit();
            }
            $requete->bind_param("ii", $id_compte, $id_soiree);
            $requete->execute();

            $id_invite = $requete->insert_id;

            $rqt = $connexion->prepare('UPDATE soiree SET id_invite = ? WHERE id_soiree = ?');
            if ($rqt === false) {
                echo "Error preparing the update statement: " . $connexion->error;
                exit();
            }
            $rqt->bind_param("ii", $id_invite, $id_soiree);
            
            if ($rqt->execute()) {
                echo "Soirée créée avec succès et compte inscrit à la soirée !";
            } else {
                echo "Erreur lors de la mise à jour de la soirée : " . $connexion->error;
            }
        } else {
            echo "Erreur lors de la création de la soirée : " . $stmt->error;
        }

        $stmt->close();
        $requete->close();
        $rqt->close();
        $connexion->close();
    }
}
?>
