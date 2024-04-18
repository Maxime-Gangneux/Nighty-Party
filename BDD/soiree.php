<?php
include 'conexion.php';

// Se connecter à la base de données
$connexion = connecterBaseDonnees();

try {
    // Requête SQL
    $requete = "SELECT * FROM soiree";

    // Exécution de la requête
    $resultat = $connexion->query($requete);

    // Vérification du résultat
    if (!$resultat) {
        throw new Exception("Erreur lors de l'exécution de la requête : " . $connexion->error);
    }

    // Ajout des résultats dans la chaîne
    while ($ligne = $resultat->fetch_assoc()) {
        echo "<div class='container_tendance'>
                <p>{$ligne['nom_soiree']}</p>
                <img src='../../Image/soiree.jpg' class = 'image_soiree'>
                <div>
                    <p>Adresse : {$ligne['adresse_soiree']}</p>
                    <p>Date : {$ligne['date_soiree']}</p>
                </div>
              </div>";
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
