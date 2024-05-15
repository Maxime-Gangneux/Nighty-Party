<?php

try {
    //soft
    $requete = "SELECT boissons.nom_boisson, boissons.qt, boissons_apporte.nb
    FROM boissons_apporte
    INNER JOIN invite ON boissons_apporte.id_invite = invite.id_invite
    INNER JOIN boissons ON boissons_apporte.id_boisson = boissons.id_boisson
    WHERE invite.id_soiree = {$_SESSION['id_soiree']}";

    $resultat = $connexion->query($requete);

    if ($resultat == false) {
        throw new Exception("Erreur lors de l'exécution de la requête.");
    }
    else{
        while ($boisson = $resultat->fetch_assoc()) {
            echo '
                <div class="boisson">
                    <p class="">' . $boisson["nb"] . '</p>
                    <p class="">' . utf8_encode($boisson["nom_boisson"]).' '. $boisson["qt"] . 'L</p>
                </div>';
        }
    }
    
    //alcol
    $requete = "SELECT boissons.nom_boisson, boissons.qt, boissons_apporte.nb
    FROM boissons_apporte
    INNER JOIN invite ON boissons_apporte.id_invite = invite.id_invite
    INNER JOIN boissons ON boissons_apporte.id_boisson = boissons.id_boisson
    WHERE invite.id_soiree = {$_SESSION['id_soiree']} AND boisson.degre IS NOT NULL";

    $resultat = $connexion->query($requete);

    if ($resultat == false) {
        
    }
    else{
        while ($boisson = $resultat->fetch_assoc()) {
            echo '
                <div class="boisson">
                    <p class="">' . $boisson["nb"] . '</p>
                    <p class="">' . utf8_encode($boisson["nom_boisson"]).' '. $boisson["qt"] . 'L</p>
                </div>';
        }
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
