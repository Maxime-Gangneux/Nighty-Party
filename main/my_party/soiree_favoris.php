<?php
if (isset($_SESSION['connected'])){
    if ($resultat->num_rows > 0) {
        // Utilisez une boucle pour parcourir les résultats
        while ($row = $resultat->fetch_assoc()) {
            $id_soiree = $row['id_soiree'];
            // Utilisez $id_soiree pour récupérer les autres informations de la soirée si nécessaire
            $requete_soiree = $connexion->prepare('SELECT * FROM soiree WHERE id_soiree = ?');
            $requete_soiree->bind_param('i', $id_soiree);
            $requete_soiree->execute();
            $resultat_soiree = $requete_soiree->get_result();
            if ($resultat_soiree->num_rows > 0) {
                $soiree = $resultat_soiree->fetch_assoc();
                $date = date("l j F", strtotime($soiree['date_soiree']));
                echo"
                <li class='soiree'>
                    <p>{$date}</p>
                    <p>{$soiree['nom_soiree']}</p>
                    <img src='../../Image/soiree.jpg' class = 'image_soiree'>
                    <form method='POST'>
                        <!-- Bouton pour suprimer des favoris -->
                        <input type='hidden' name='id_soiree' value='{$soiree['id_soiree']}'>
                        <button  name='button_suprimer_favoris'>Suprimer des favoris</button>
                    </form>
                    <div class='description'>
                        <h2> Description </h2> 
                        <p> {$soiree['description_soiree']} </p>
                    </div>
                </li>
                ";
            }
        }
    }else{
        echo "Vous n'avez pas de favoris.";}
}else{
    echo "Veuillez vous connecter afin d'ajouter des soirées en favoris.";
}


?>
