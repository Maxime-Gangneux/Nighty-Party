<?php
function connecterBaseDonnees() {
    // Paramètres de connexion à la base de données
    $serveur = "localhost"; // Adresse du serveur MySQL
    $utilisateur = "root"; // Nom d'utilisateur MySQL
    $motdepasse = ""; // Mot de passe MySQL
    $base_de_donnees = "nighty party"; // Nom de la base de données à laquelle se connecter

    // Connexion à la base de données
    $connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("Échec de la connexion à la base de données : " . $connexion->connect_error);
    }
    return $connexion;
}
?>
