<?php

try {

    $requete = "SELECT boissons.nom_boisson, boissons.qt, compte.nom_compte, compte.prenom_compte
                FROM boissons_apporte
                INNER JOIN invite ON boissons_apporte.id_invite = invite.id_invite
                INNER JOIN compte ON invite.id_compte = compte.id_compte
                INNER JOIN boissons ON boissons_apporte.id_boisson = boissons.id_boisson
                WHERE invite.id_soiree = {$_SESSION['id_soiree']}";

    $resultat = $connexion->query($requete);

    if ($resultat == false) {
        throw new Exception("Erreur lors de l'exécution de la requête.");
    }

    while ($boisson = $resultat->fetch_assoc()) {
        echo '
            <div class="boisson">
                <p class="">' . utf8_encode($boisson["nom_compte"]) . '</p>
                <p class="">' . utf8_encode($boisson["prenom_compte"]) . '</p>
                <p class="">' . utf8_encode($boisson["nom_boisson"]) . '</p>
                <p class="">' . $boisson["qt"] . '</p>
            </div>';
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
