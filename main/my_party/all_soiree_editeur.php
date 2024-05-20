<?php

if (isset($_SESSION['connected'])){
    if ($all_soiree_editeur->num_rows > 0) {
        // Utilisez une boucle pour parcourir les résultats
        while ($row = $all_soiree_editeur->fetch_assoc()) {
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
                    <div class='date'>{$date}</div>
                    <div class='container_titre'><div class='titre'>{$soiree['nom_soiree']}</div></div>
                    <img src='../../Image/soiree.jpg' class = 'image_soiree'>
                    <form method='POST' action='../soiree/soiree_editeur.php'>
                        <input type='hidden' name='id_soiree' value='{$id_soiree}'>
                        <button name='edit'><h4>Modifier</h4></button>
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
        echo "Vous n'avez pas de soirée -_-.";}
}else{
    echo"Veuillez vous connecter afin de voir vos soirées.";
}
?>