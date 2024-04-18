<?php
$bdd = new PDO('mysql:host=localhost;dbname=nighty party', 'root', '');

// Vérifier si le formulaire a été soumis et que le champ n'est pas vide
if(isset($_GET['s']) && !empty($_GET['s'])){
    $code = htmlspecialchars($_GET['s']);
    $stmt = $bdd->prepare('SELECT * FROM soiree WHERE code_soiree = :code ORDER BY id_soiree DESC');
    $stmt->execute(array('code' => $code));
    $allcode = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Si le formulaire n'a pas été soumis ou que le champ est vide, initialiser $allcode à NULL
    $allcode = NULL;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Définition de l'encodage et de la vue -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre de la page -->
    <title>Nighty Party</title>
    <!-- Lien vers la feuille de style CSS -->
    <link rel="stylesheet" href="css.css">
    <!-- Script JavaScript -->
    <script src="app.js"></script>
</head>
<body>
    <!-- Inclusion de la barre de navigation -->
    <?php include '../nav_barre/nav_barre.php'; ?>

    <!-- Champ de recherche pour une soirée -->
    <div class="container_input">
        <input type="text" name="main_search" id="input_soiree" class="input_soiree" placeholder="Rechercher une soirée">
    </div>

    <!-- Conteneur pour le code de la soirée -->
    <div class="container_code" id="container_code">
        <!-- Bouton pour ouvrir le conteneur -->
        <button onclick="Ouvrir_container_code()" class="logo_code"><\></button>
        <form method="GET">
            <!-- Champ pour saisir le code de la soirée -->
            <input type="text" name="s" class="input_code" placeholder="Code de la soirée">
            <!-- Image pour envoyer le code -->
            <input type="image" name="envoyer" src="../../Image/logo_send.png" class="logo_send">
        </form>
        <!-- Texte associé au code de la soirée -->
        <div class="texte_code" id="texte_code">
            <p>suce ma bite</p>
            <p>Avec amour et passion =)</p>
        </div>
    </div>

    <section class="soiree_priv">
    <?php 
    // Vérifier si $allcode contient des résultats
    if($allcode !== NULL && isset($_GET['s'])){
        foreach($allcode as $soiree){
            echo 
                "<h3>Voici la soirée trouvée avec le code {$code}</h3>
                <div class='container_tendance'>
                    <p>{$soiree['nom_soiree']}</p>
                    <img src='../../Image/soiree.jp' class='image_soiree'>
                    <div>
                        <p>Description : {$soiree['adresse_soiree']}</p>
                        <p>Nombre de personnes : {$soiree['date_soiree']}</p>
                    </div>
                </div>";
        }
    } elseif(isset($_GET['s'])) {
        // Si le formulaire a été soumis mais aucun résultat trouvé
        echo "<p>Aucune soirée n'a été trouvée avec votre code.</p>";
    }
?>
</section> 


    <footer>
        <p>Created and designed by Muller Julien & Gangneux Maxime</p>
    </footer>

</body>
</html>
