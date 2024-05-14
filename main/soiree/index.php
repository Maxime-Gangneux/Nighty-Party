<?php
// Démarrez la session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_soiree = $_POST['id_soiree'];
    $_SESSION['id_soiree'] = $id_soiree;
}

include '../../BDD/conexion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>soiree</title>
    <link rel="stylesheet" href="css.css">
    <script src="app.js"></script>
</head>
<body>
    <?php
        include '../nav_barre/nav_barre.php';

        // Se connecter à la base de données
        $connexion = connecterBaseDonnees();

        try {
            
                $requete = "SELECT * FROM soiree WHERE id_soiree = '{$_SESSION['id_soiree']}'";

                // Exécution de la requête
                $resultat = $connexion->query($requete);
                // Vérification du résultar
                if (!$resultat) {
                    throw new Exception("Erreur lors de l'exécution de la requête : " . $connexion->error);
                }else {
                    while ($ligne = $resultat->fetch_assoc()) {
                        $nom_soiree = htmlspecialchars($ligne['nom_soiree']);
                        $date_soiree = htmlspecialchars($ligne['date_soiree']);
                        $description = utf8_encode($ligne['description_soiree']);
                        $statu_soiree = $ligne['statu_soiree'];
                        echo "<section>
                                <div class='image'></div>
                                <div class='info_container'>
                                    <div class='infos_general'>
                                        <p>{$nom_soiree}</p>
                                        <p>{$date_soiree}</p>
                                        <p>{$description}</p>
                                        <form method='POST'>
                                            ";include '../../BDD/fonction.php';echo"
                                        </form>
                                    </div>
                                    <div class='contenue'>
                                        <div class='personnes'>"; 
                                            include '../../BDD/invites.php';
                        echo           "</div>
                                        <div class='boissons'>
                                            <button>apptorer du glouglou</button>";
                                            include '../../BDD/boissons.php';
                        echo           "</div>
                                        </div>
                                    </div>
                                </div>
                            </section>";
                    }
                }
                
            }
        catch (Exception $e) {
            // Gérer l'exception (erreur)
            echo "Erreur : " . $e->getMessage();
        }
    ?>
    <footer>
        <p>Created and designed by Muller Julien & Gangneux Maxime</p>
    </footer>
</body>    
</html>
