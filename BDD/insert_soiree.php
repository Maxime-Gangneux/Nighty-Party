<?php
include 'conexion.php';
$connexion = connecterBaseDonnees();
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

    // Vérification si tous les champs sont remplis
    if(empty($nom_soiree) || empty($description_soiree) || empty($adresse_soiree) || empty($date_soiree) || empty($heure_min_soiree) || empty($heure_max_soiree) || empty($nb_personne_soiree) || empty($theme_soiree) || empty($type_soiree) || empty($statu_soiree)) {
        echo "Veuillez remplir tous les champs.";
    } else {
        // Préparation de la requête SQL
        $sql = "INSERT INTO soiree (nom_soiree, description_soiree, adresse_soiree, date_soiree, heure_min_soiree, heure_max_soiree, nb_personne_soiree, theme_soiree, type_soiree, statu_soiree) VALUES ('$nom_soiree', '$description_soiree', '$adresse_soiree', '$date_soiree', '$heure_min_soiree', '$heure_max_soiree', '$nb_personne_soiree', '$theme_soiree', '$type_soiree', '$statu_soiree')";

        // Exécution de la requête
        if ($connexion->query($sql) === TRUE) {
            echo "Données enregistrées avec succès !";
        } else {
            echo "Erreur : " . $connexion->error;
        }

        // Fermeture de la connexion
        $connexion->close();
    }
}

?>
