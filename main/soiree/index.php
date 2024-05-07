<?php
// Démarrez la session
session_start();

// Vérifiez si l'utilisateur est connecté
if(!isset($_SESSION['connected']) || $_SESSION['connected'] !== true){
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: ../login/index.php");
    exit();
}
include '../../BDD/conexion.php';
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

        // Se connecter à la base de données
        $connexion = connecterBaseDonnees();

        try {
                $id_soiree = $_POST['id_soiree'];
                $requete = "SELECT * FROM soiree WHERE id_soiree = $id_soiree";

                // Exécution de la requête
                $resultat = $connexion->query($requete);
                // Vérification du résultat
                if (!$resultat) {
                    throw new Exception("Erreur lors de l'exécution de la requête : " . $connexion->error);
                }else {
                    while ($ligne = $resultat->fetch_assoc()) {
                        echo "<section>
                                <div class='image'></div>
                                <div class='info_container'>
                                    <div class='infos_general'>
                                        <p>{$ligne['nom_soiree']}</p>
                                        <p>{$ligne['date_soiree']}</p>
                                        <p>{$ligne['description_soiree']}</p>
                                        <form method='POST'>
                                            ";include '../../BDD/fonction.php';echo"
                                        </form>
                                    </div>
                                    <div class='contenue'>
                                        <div class='personnes'>"; 
                                        include '../../BDD/invites.php';
                        echo           "</div>
                                        <div class='boissons'></div>
                                    </div>
                                </div>
                            </section>";
                    }
                }
                
            }
        catch (Exception $e) {
            // Gérer l'exception (erreur)
            echo "Erreur : " . $e->getMessage();
        } finally {
            // Fermer la connexion, même si une exception est survenue
            if (isset($connexion)) {
                $connexion->close();
            }
        }
    ?>
    <footer>
        <p>Created and designed by Muller Julien & Gangneux Maxime</p>
    </footer>
</body>    
</html>
