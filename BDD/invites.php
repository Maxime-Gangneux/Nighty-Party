<?php

try {

    $requete = "SELECT compte.nom_compte, compte.prenom_compte, compte.age_compte
                FROM compte
                INNER JOIN invite ON compte.id_compte = invite.id_compte
                WHERE invite.id_soiree = '{$_SESSION['id_soiree']}'";

    $resultat = $connexion->query($requete);

    if ($resultat === false) {
        throw new Exception("Erreur lors de l'exécution de la requête.");
    }
    $nombre_de_personne = 0;
    while ($personne = $resultat->fetch_assoc()) {
        echo '
            <div class="personne">
                <p class="nom">' . $personne["nom_compte"] . '</p>
                <p class="prenom">' . $personne["prenom_compte"] . '</p>
                <p class="age">' . $personne["age_compte"] . '</p>
            </div>';
        $nombre_de_personne++;
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
} 
?>
