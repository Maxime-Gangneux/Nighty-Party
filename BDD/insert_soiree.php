<?php
include 'conexion.php';
session_start();
$connexion = connecterBaseDonnees();
session_start();
if(isset($_POST['submit_button'])){
    $nom_soiree = trim($_POST['nom_soiree']);
    $description_soiree = trim($_POST['description_soiree']);
    $adresse_soiree = trim($_POST['adresse_soiree']);
    // Formatage de la date au format YYYY-MM-DD
    $date_soiree = date("Y-m-d", strtotime(trim($_POST['date_soiree'])));
    // Formatage de l'heure minimale au format HH:MM:SS
    $heure_min_soiree = date("H:i:s", strtotime(trim($_POST['heure_min_soiree'])));
    // Formatage de l'heure maximale au format HH:MM:SS
    $heure_max_soiree = date("H:i:s", strtotime(trim($_POST['heure_max_soiree'])));
    $nb_personne_soiree = trim($_POST['nb_personne_soiree']);
    // Utilisation de la fonction addslashes pour échapper les caractères spéciaux
    $theme_soiree = addslashes(trim($_POST['theme_soiree']));
    $type_soiree = trim($_POST['type_soiree']);
    $statu_soiree = trim($_POST['statu_soiree']);
    $id_compte = $_SESSION['id_compte'];

    // Vérification si tous les champs sont remplis
    if(empty($nom_soiree) || empty($description_soiree) || empty($adresse_soiree) || empty($date_soiree) || empty($heure_min_soiree) || empty($heure_max_soiree) || empty($nb_personne_soiree) || empty($theme_soiree) || empty($type_soiree) || empty($statu_soiree)) {
        echo "Veuillez remplir tous les champs.";
    } else {
        // Préparation de la requête SQL
        $sql = "INSERT INTO soiree (nom_soiree, description_soiree, adresse_soiree, date_soiree, heure_min_soiree, heure_max_soiree, nb_personne_soiree, theme_soiree, type_soiree, statu_soiree) VALUES ('$nom_soiree', '$description_soiree', '$adresse_soiree', '$date_soiree', '$heure_min_soiree', '$heure_max_soiree', '$nb_personne_soiree', '$theme_soiree', '$type_soiree', '$statu_soiree')";
        $id_compte = $_SESSION['id_compte'];
        $id_soiree = $connexion->insert_id;
        $id_editeur = 1; // Valeur fixe pour id_editeur
        $requete = $connexion->prepare('INSERT INTO invite (id_compte, id_soiree, id_editeur) VALUES (?, ?, ?)');
        $requete->bind_param("iii", $id_compte, $id_soiree, $id_editeur);
        $requete->execute();
        

        // Exécution de la requête
        if ($connexion->query($sql) === TRUE) {
            // Récupération de l'ID de la soirée nouvellement créée
            $id_soiree = $connexion->insert_id;

            // Préparation de la requête SQL pour inscrire le compte créateur à la soirée
            $requete = $connexion->prepare('INSERT INTO invite (id_compte, id_soiree) VALUES (?, ?)');
            $requete->bind_param("ii", $id_compte, $id_soiree);

            // Exécution de la requête pour inscrire le compte créateur à la soirée
            if ($requete->execute() === TRUE) {
                echo "Soirée créée avec succès et compte inscrit à la soirée !";
            } else {
                echo "Erreur lors de l'inscription du compte à la soirée : " . $connexion->error;
            }
        } else {
            echo "Erreur lors de la création de la soirée : " . $connexion->error;
        }
        // Fermeture de la connexion
        $connexion->close();
    }
}

?>
