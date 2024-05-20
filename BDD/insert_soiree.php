<?php
include 'conexion.php';
$connexion = connecterBaseDonnees();
session_start();

if(isset($_POST['submit_button'])){
    $nom_soiree = utf8_decode($_POST['nom_soiree']);
    $description_soiree = utf8_decode($_POST['description_soiree']);
    $adresse_soiree = utf8_decode($_POST['adresse_soiree']);
    $ville_soiree = $_POST['ville_soiree'];
    // Formatage de la date au format YYYY-MM-DD
    $date_soiree = date("Y-m-d", strtotime(trim($_POST['date_soiree'])));
    // Formatage de l'heure minimale au format HH:MM:SS
    $heure_min_soiree = date("H:i:s", strtotime(trim($_POST['heure_min_soiree'])));
    // Formatage de l'heure maximale au format HH:MM:SS
    $heure_max_soiree = date("H:i:s", strtotime(trim($_POST['heure_max_soiree'])));
    $nb_personne_soiree = trim($_POST['nb_personne_soiree']);
    // Utilisation de la fonction addslashes pour échapper les caractères spéciaux
    $theme_soiree = addslashes(trim($_POST['theme_soiree']));
    $type_soiree = utf8_decode($_POST['type_soiree']);
    $statu_soiree = utf8_decode($_POST['statu_soiree']);
    $id_compte = $_SESSION['id_compte'];

    // Vérification si tous les champs sont remplis
    if(empty($nom_soiree) || empty($description_soiree) || empty($adresse_soiree) || empty($ville_soiree) || empty($date_soiree) || empty($heure_min_soiree) || empty($heure_max_soiree) || empty($nb_personne_soiree) || empty($theme_soiree) || empty($type_soiree) || empty($statu_soiree)) {
        echo "Veuillez remplir tous les champs.";
    } else {
        // Préparation de la requête SQL pour insérer dans la table soiree
        $sql = "INSERT INTO soiree (nom_soiree, description_soiree, adresse_soiree, ville_soiree, date_soiree, heure_min_soiree, heure_max_soiree, nb_personne_soiree, theme_soiree, type_soiree, statu_soiree) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $connexion->prepare($sql);
        $stmt->bind_param("sssssssisss", $nom_soiree, $description_soiree, $adresse_soiree, $ville_soiree, $date_soiree, $heure_min_soiree, $heure_max_soiree, $nb_personne_soiree, $theme_soiree, $type_soiree, $statu_soiree);

        // Exécution de la requête
        if ($stmt->execute()) {
            // Récupération de l'ID de la soirée nouvellement créée
            $id_soiree = $stmt->insert_id;

            // Préparation de la requête SQL pour inscrire le compte créateur à la soirée
            $requete = $connexion->prepare('INSERT INTO invite (id_compte, id_soiree) VALUES (?, ?)');
            $requete->bind_param("ii", $id_compte, $id_soiree);
            $requete->execute();

            // Récupération de l'ID de l'invité nouvellement créé
            $id_invite = $requete->insert_id;

            // Préparation de la requête SQL pour mettre à jour la table soiree avec l'ID de l'invité
            $rqt = $connexion->prepare('UPDATE soiree SET id_invite = ? WHERE id_soiree = ?');
            $rqt->bind_param("ii", $id_invite, $id_soiree);
            
            // Exécution de la requête pour mettre à jour la table soiree
            if ($rqt->execute()) {
                echo "Soirée créée avec succès et compte inscrit à la soirée !";
            } else {
                echo "Erreur lors de la mise à jour de la soirée : " . $connexion->error;
            }
        } else {
            echo "Erreur lors de la création de la soirée : " . $connexion->error;
        }

        // Fermeture des déclarations et de la connexion
        $stmt->close();
        $requete->close();
        $rqt->close();
        $connexion->close();
    }
}
?>
