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
include 'api.php';

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

    <!-- Conteneur pour le code de la soirée -->
    <div class="container_code" id="container_code">
        <!-- Bouton pour ouvrir le conteneur -->

        <form method="GET">

            <!-- Champ pour saisir le code de la soirée -->
            <input type="text" name="s" class="input_code" placeholder="Code de la soirée">
            <!-- Image pour envoyer le code -->
            <input type="image" name="envoyer" src="../../Image/logo_send.png" class="logo_send">
        </form>
        <button onclick="Ouvrir_container_code()" class="logo_code"><\></button>
        <!-- Texte associé au code de la soirée -->
        <div class="texte_code" id="texte_code">
            suce ma bite
            Avec amour et passion =)
        </div>
    </div>

    <main>
    <?php 
    // Vérifier si $allcode contient des résultats
    if($allcode !== NULL && isset($_GET['s'])){
        foreach($allcode as $soiree){
            echo 
                "<h3>Voici la soirée trouvée avec le code {$code}</h3>
                <div class='container_soiree'>
                <div class = 'soiree'>
                    <span class = 'titre_soiree'>{$soiree['nom_soiree']}</span>
                    <img class = 'image_soiree' src='../../Image/soiree.jpg'>
    
                    <div class = description>
                        <h2> Description </h2> 
                        <p> {$soiree['description_soiree']} </p>
                    </div>
                    <div class = 'info_complementaire'>
                        <p><img src ='localisation_icon.png'> {$soiree['adresse_soiree']}</p>
                        <p>Nombre de personnes : {$soiree['nb_personne_soiree']}</p>
                        <p>Date de la soirée : {$soiree['date_soiree']}</p>
                        <p>thème de la soirée : {$soiree['theme_soiree']}</p>
                        <p>Type de la soirée : {$soiree['type_soiree']}</p>
                        <p>Heure debut de la soirée : {$soiree['heure_min_soiree']}</p>
                        <p>Heure fin de la soirée : {$soiree['heure_max_soiree']}</p>
                    </div>
                </div>        
            </div>";
        }
    } elseif(isset($_GET['s'])) {
        // Si le formulaire a été soumis mais aucun résultat trouvé
        echo "<p>Aucune soirée n'a été trouvée avec votre code.</p>";
    }

    $all_soiree = verif_input_main();

    if ($all_soiree !== NULL) {
        foreach ($all_soiree as $soiree) {
            if ($soiree['code_soiree'] !== NULL){
                continue;
            }
            $date = date("l j F", strtotime($soiree['date_soiree']));
            echo "
            <section>
                <div class='content'>
                    <div class='info_soiree'>
                        <h1>{$soiree['nom_soiree']}</h1>

                        <h5>{$date}</h5>

                        <div class='description'>
                            <p>{$soiree['description_soiree']}ufgsyufhusdfudshfd</p>
                        </div>

                        <button><h4>Learn more</h4></button>
                        
                            <form method='POST'>
                                <input type='hidden' name='id_soiree' value='{$soiree['id_soiree']}'>
                                <button  name='button_favorite'><h4>Add to favorites</h4></button>
                            </form>
                    </div>
                    <div class='container_image'>
                        <img src='../../Image/soiree.jpg' alt='Image de la soirée'>
                    </div>
                </div>
            </section>
            ";
        }
    } else {
        echo "<div class ='container_tendance'>Aucun résultat trouvé.</div>";
    }

?>
</main> 

<footer>
    <p>Created and designed by Muller Julien & Gangneux Maxime</p>
</footer>

</body>
</html>
