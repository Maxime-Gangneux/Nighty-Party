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
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nighty Party</title>
    <link rel="stylesheet" href="css.css">
    <script src="app.js"></script>
</head>
<body>
    <section>
        <?php
            include '../nav_barre/nav_barre.php';
        ?>
        <div class = 'main'>
            <form class = "disconnect" method= 'POST' action='../../BDD/login.php'>
                <button type='submit' name='submit_button_disconnect'>disconnect</button>
            </form>
            <?php
                include '../../BDD/get_compte.php';
            ?>
        </div>
    </section>
</body>
<footer>
    <p>Created and designed by Muller Julien & Gangneux Maxime</p>
</footer>
</html>