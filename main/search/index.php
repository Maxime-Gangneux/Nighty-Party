<?php
// Démarrez la session
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Définition de l'encodage et de la vue -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre de la page -->
    <title>Search</title>
    <!-- Lien vers la feuille de style CSS -->
    <link rel="stylesheet" href="css.css">
    <!-- Script JavaScript -->

</head>
<body>
    <!-- Inclusion de la barre de navigation -->
    <?php include '../nav_barre/nav_barre.php'; ?>
    <main>
        <div class="wrapper">
                <?php 
                    include '../../BDD/api.php';
                ?>
        </div>
        <script src="app.js"></script>
    </main> 
</body>
<footer>
    <p>Created and designed by Muller Julien & Gangneux Maxime</p>
</footer>
</html>
