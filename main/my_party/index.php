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
}

// Vérifier si le formulaire de suppression a été soumis
if (isset($_POST['button_suprimer_favoris'])){
    $id_soiree_a_supprimer = $_POST['id_soiree'];
    $requete_suppression = $connexion->prepare('DELETE FROM favoris WHERE id_soiree = ?');
    $requete_suppression->bind_param("i", $id_soiree_a_supprimer);
    if ($requete_suppression->execute()){
        echo"La soirée a été supprimée des favoris.";
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Erreur lors de la suppression : " . $requete_suppression->error;
    }}    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nighty Party</title>
    <link rel="stylesheet" href="css.css">
    <script src="app.js"></script>
</head>
<body>
    <?php
        include '../nav_barre/nav_barre.php';
    ?>
    <div class="content_liste_favoris">
        <div class="banner">
            <div class="txt_banner">
                <div><h1>Mes Favoris</h1></div>
                <div><p>Les soirées dans vos favoris se suprimer dès lors la fin de la soirée</p></div>
            </div>
        </div>
        <ul class="liste_soiree">
            <?php
                include 'soiree_favoris.php';
            ?>
        </ul>
    </div>

    <footer>
        <p>Created and designed by Muller Julien & Gangneux Maxime</p>
    </footer>
</body>
</html>