<?php
$connexion = connecterBaseDonnees();

function getSoireeImages($id_soiree) {
    global $connexion;
    // Requête pour récupérer les images associées à la soirée
    $requete_images = $connexion->prepare('SELECT images.* FROM images
                                           INNER JOIN soiree_images ON images.id_image = soiree_images.image_id
                                           WHERE soiree_images.soiree_id = ?');
    $requete_images->bind_param("i", $id_soiree);
    $requete_images->execute();
    $resultat_images = $requete_images->get_result();
    $images = $resultat_images->fetch_all(MYSQLI_ASSOC);

    $requete_images->close();
    return $images;
}

?>
