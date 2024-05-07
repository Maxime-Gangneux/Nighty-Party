<?php
include 'conexion.php';

// Se connecter à la base de données
$connexion = connecterBaseDonnees();

try {
    // Requête SQL
    $id_soiree = $_POST['id_soiree'];
    $requete = "SELECT * FROM soiree Where id_soiree = $id_soiree";

    // Exécution de la requête
    $resultat = $connexion->query($requete);

    // Vérification du résultat
    if (!$resultat) {
        throw new Exception("Erreur lors de l'exécution de la requête : " . $connexion->error);
    }

    // Ajout des résultats dans la chaîne
    while ($ligne = $resultat->fetch_assoc()) {
        if ($ligne['code_soiree'] !== NULL){
            continue;
        }
        echo "";
    }

} catch (Exception $e) {
    // Gérer l'exception (erreur)
    echo "Erreur : " . $e->getMessage();
} finally {
    // Fermer la connexion, même si une exception est survenue
    if (isset($connexion)) {
        $connexion->close();
    }
}
?>
