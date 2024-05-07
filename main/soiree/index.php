<?php
// Démarrez la session
session_start();

// Vérifiez si l'utilisateur est connecté
if(!isset($_SESSION['connected']) || $_SESSION['connected'] !== true){
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: ../login/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
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
        include '../../BDD/soiree.php'
    ?>
    <footer>
        <p>Created and designed by Muller Julien & Gangneux Maxime</p>
    </footer>
</body>    
</html>
