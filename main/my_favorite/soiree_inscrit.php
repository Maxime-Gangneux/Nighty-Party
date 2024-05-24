<?php
include '../../BDD/get_images.php';
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
                $images = getSoireeImages($id_soiree);
                echo"
                <section class='soiree'>
                <div class='container_image'>";
                    if ($images){
                        foreach ($images as $image) {
                            echo"
                            <img src='data:" . htmlspecialchars($image['image_type']) . ";base64," . base64_encode($image['image_data']) . "' alt='" . htmlspecialchars($image['image_name']) . "'>
                            ";
                        }
                    }else{
                        echo"
                        <img src='../../Image/logo.png'>
                        ";
                    }
                    echo "
                    <div class='border_image'>
                        <span class='line_top'></span>
                        <span class='line_bottom_right'></span>
                        <span class='line_bottom'></span>
                        <span class='line_top_left'></span>
                    </div>
                </div>
                <div class='conainer_info_soiree'>
                    <div class='info'>
                        <h1>{$soiree['nom_soiree']}</h1>
                        <h5>{$date}</h5>
                    </div>
                    <div class='description'>
                        <p>{$soiree['description_soiree']}</p>
                    </div>
                    <div class = 'container_button'>
                        <form method='POST' action='../soiree/index.php'>
                            <input type='hidden' name='id_soiree' value='{$id_soiree}'>
                            <button name='bouton_detail' type='submit' class='link'><h4>Learn more</h4></button>
                        </form>                        
                    </div>
                </div>
            </section>
                ";
            }
        }
    }else{
        echo "Vous êtes inscrit à aucune soirée.";}
}else{
    echo "Veuillez vous connecter afin d'ajouter de vous inscrire a une soirée.";
}


?>