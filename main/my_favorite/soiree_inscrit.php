<?php
if (isset($_SESSION['connected'])){
    if ($resultat_inscrit->num_rows > 0) {
        // Utilisez une boucle pour parcourir les résultats
        while ($row = $resultat_inscrit->fetch_assoc()) {
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
                    <form method='POST' action='../soiree/index.php'>
                        <input type='hidden' name='id_soiree' value='{$soiree['id_soiree']}'>
                        <button name='bouton_detail' type='submit' class='link'><h4>Learn more</h4></button>
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
        echo "Vous êtes inscrit à aucune soirée.";}
}else{
    echo "Veuillez vous connecter afin d'ajouter de vous inscrire a une soirée.";
}


?>