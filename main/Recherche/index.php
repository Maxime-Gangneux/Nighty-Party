<?php
$bdd = new PDO('mysql:host=localhost;dbname=nighty party', 'root', '');
$allcode = $bdd->query('SELECT nom_soiree, description_soiree, nb_personne_soiree FROM soiree ORDER BY id_soiree DESC');

if(isset($_GET['s']) && !empty($_GET['s'])){
    $code = htmlspecialchars($_GET['s']);
    $stmt = $bdd->prepare('SELECT nom_soiree, description_soiree, nb_personne_soiree FROM soiree WHERE code_soiree = :code ORDER BY id_soiree DESC');
    $stmt->execute(array('code' => $code));
    $allcode = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        if($allcode !== NULL && isset($_GET['s'])){
            foreach($allcode as $soiree){
                ?>
                <div class="soiree">
                    <h3>Nom de la soirée: <?= $soiree['nom_soiree']; ?></h3>
                    <p>Description: <?= $soiree['description_soiree']; ?></p>
                    <p>Nombre de personnes: <?= $soiree['nb_personne_soiree']; ?></p>
                </div>
                <?php
            }
        } else {
            echo "<p>Aucune soirée n'a été trouvée avec votre code.</p>";
        }
    ?>
    </section> 

    <footer>
        <p>Created and designed by Muller Julien & Gangneux Maxime</p>
    </footer>


    <!-- Script JavaScript -->
    <script>
        // Fonction pour ouvrir/fermer le conteneur du code de la soirée
        function Ouvrir_container_code() {
            var container = document.getElementById("container_code");
            var txt = document.getElementById("texte_code");
            // Si le conteneur est fermé
            if (container.style.right === "-16vw") {
                // Ouvrir le conteneur et afficher le texte
                container.style.right = "0vw";
                container.style.height = "20vh";
                txt.style.opacity = "1";
            } else {
                // Fermer le conteneur et masquer le texte
                container.style.right = "-16vw";
                container.style.height = "5vh";
                txt.style.transitionDuration = "0.5s";
                txt.style.opacity = "0";
            }
        }
    </script>
</body>
</html>
