<?php
include '../../BDD/conexion.php';
$connexion = connecterBaseDonnees();
session_start();
if (isset($_SESSION['connected'])){
    $id_compte = $_SESSION['id_compte'];
    $requete = $connexion->prepare('SELECT id_soiree FROM favoris WHERE id_compte = ?');
    $requete->bind_param('i', $id_compte); // 'i' indique que $id_compte est un entier
    $requete->execute();
    $resultat = $requete->get_result();

    $inscrit = $connexion->prepare('SELECT id_soiree FROM invite WHERE id_compte = ?');
    $inscrit->bind_param('i', $id_compte); // 'i' indique que $id_compte est un entier
    $inscrit->execute();
    $resultat_inscrit = $inscrit->get_result();

    // Requête pour obtenir l'ID de l'invité de la soirée
    $id_invite_soiree = $connexion->prepare('SELECT id_invite FROM soiree WHERE id_soiree = ?');
    $id_invite_soiree->bind_param("i", $id_soiree);
    $id_invite_soiree->execute();
    $result_invite_soiree = $id_invite_soiree->get_result();
    $row_invite_soiree = $result_invite_soiree->fetch_assoc();
    $id_invite_soiree_value = $row_invite_soiree['id_invite'];

    // Requête pour vérifier si l'utilisateur est l'invité de la soirée
    $id_invite = $connexion->prepare('SELECT id_invite FROM invite WHERE id_compte = ? AND id_soiree = ?');
    $id_invite->bind_param("ii", $id_compte, $id_soiree);
    $id_invite->execute();
    $result_invite = $id_invite->get_result();
    $row_invite = $result_invite->fetch_assoc();
    $id_invite_value = $row_invite['id_invite'];

    // Comparaison des résultats pour déterminer si l'utilisateur est l'éditeur de la soirée
    if ($id_invite_value == $id_invite_soiree_value) {
        $result_verif_editeur = 1;
    }else{
        $result_verif_editeur = 0;
    }
    if ($result_verif_editeur == 1){
        
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Party</title>
    <link rel="stylesheet" href="css.css">
    <script src="app.js"></script>
</head>
<body>
    <?php
        include '../nav_barre/nav_barre.php';
    ?>
    <main>
        <div class="container_link">
        <form action='create.php'>
            <button class='link'><h4>create party </h4></button>
        </form> 
        </div>
    </main>

</body>
</html





