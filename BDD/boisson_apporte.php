<?php
function input_glouglou() {
    global $connexion;

    if (isset($_GET['input_boisson']) && !empty($_GET['input_boisson'])) {
        $contenue = htmlspecialchars($_GET['input_boisson']);
        
        // Utilisation de requêtes préparées pour sécuriser l'entrée utilisateur
        $all_nom_boisson = $connexion->prepare('SELECT * FROM boissons WHERE nom_boisson LIKE ?');
        $like_contenue = "%" . $contenue . "%";
        $all_nom_boisson->execute([$like_contenue]);
        
        // Récupération des résultats avec PDO
        $boissons = $all_nom_boisson->fetchAll(PDO::FETCH_ASSOC);

        if ($boissons !== false) {
            foreach ($boissons as $boisson) {
                echo "<div class='boisson_search'>{$boisson['nom_boisson']}</div>";
            }
        }
    }
}
?>
