<?php
// Démarrez la session
session_start();

// Vérifiez si l'utilisateur est connecté
if(isset($_SESSION['connected']) && $_SESSION['connected'] == true){
    
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
        include '../../BDD/api.php'
    ?>
</main> 

<footer>
    <p>Created and designed by Muller Julien & Gangneux Maxime</p>
</footer>

</body>
</html>
