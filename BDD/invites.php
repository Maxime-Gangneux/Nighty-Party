<?php

try {
    $id_soiree = $ligne['id_soiree'];

    $requete = "SELECT compte.nom_compte, compte.prenom_compte, compte.age_compte
                FROM compte
                INNER JOIN invite ON compte.id_compte = invite.id_compte
                WHERE invite.id_soiree = $id_soiree;";

    $resultat = $connexion->query($requete);

    if ($resultat === false) {
        throw new Exception("Erreur lors de l'exécution de la requête.");
    }

    while ($personne = $resultat->fetch_assoc()) {
        echo '
            <div class="personne">
                <p class="nom">' . $personne["nom_compte"] . '</p>
                <p class="prenom">' . $personne["prenom_compte"] . '</p>
                <p class="age">' . $personne["age_compte"] . '</p>
            </div>';
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
} finally {
    // Fermeture de la connexion à la base de données
    if (isset($connexion)) {
        $connexion->close();
    }
}

?>
