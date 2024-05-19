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
    <title>Create Party</title>
    <link rel="stylesheet" href="css.css">
    <script src="app.js"></script>
</head>
<body>
<?php include '../nav_barre/nav_barre.php'; ?>
    <div class="container">
        <div class='container_input'>
            <form method="POST" action="../../BDD/insert_soiree.php">
                <div>
                    <input type="text" name="nom_soiree" placeholder="Nom de la soirée">
                </div>
                <div>
                    <input type="text" name="description_soiree" placeholder="Description de la soirée">
                </div>
                <div>
                    <input type="text" name="adresse_soiree" placeholder="Adresse de la soirée">
                </div>
                <div>
                    <input type="text" name="ville_soiree" placeholder="Ville de la soirée">
                </div>
                <div>
                    <input type="date" name="date_soiree" placeholder="Date">
                </div>
                <div>
                    <input type="time" name="heure_min_soiree" placeholder="Heure de début">
                </div>
                <div>
                    <input type="time" name="heure_max_soiree" placeholder="Heure de fin">
                </div>
                <div>
                    <input type="number" name="nb_personne_soiree" placeholder="Nombre de personnes">
                </div>
                <div>
                    <input type="text" name="theme_soiree" placeholder="Thème de la soirée">
                </div>
                <div>
                    <input type="text" name="type_soiree" placeholder="Type de la soirée">
                </div>
                <div>
                    <input type="number" min = "1" max = "2" name = "statu_soiree">1 = public 2 = privee
                </div>
                <button type="submit" name="submit_button">Enregistrer</button>
            </form>
        </div>
        <div class="preview">Aperçu</div>
    </div>
    <footer>
        <p>Created and designed by Muller Julien & Gangneux Maxime</p>
    </footer>
</body>    
</html>