<?php
include 'conexion.php';
include 'get_images.php';

// Se connecter à la base de données
$connexion = connecterBaseDonnees();


function verif_input_main(){
    global $connexion;

    if(isset($_GET['main_search']) && !empty($_GET['main_search'])){
        $contenue = htmlspecialchars($_GET['main_search']);
        $requete = $connexion->prepare('SELECT * FROM soiree WHERE nom_soiree LIKE ? OR description_soiree LIKE ? OR adresse_soiree LIKE ? OR type_soiree LIKE ?');
        $likeContenue = "%{$contenue}%";
        $requete->bind_param('ssss', $likeContenue, $likeContenue, $likeContenue, $likeContenue);
        $requete->execute();
        $result = $requete->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    return NULL;
}

function getFavoriteCount($id_soiree){
    global $connexion;
    $requete_fav = $connexion->prepare('SELECT COUNT(*) AS favorite_count FROM favoris WHERE id_soiree = ?');
    $requete_fav->bind_param('i', $id_soiree);
    $requete_fav->execute();
    $result_fav = $requete_fav->get_result();
    $row = $result_fav->fetch_assoc();
    return $row['favorite_count'];
}

$all_soiree = verif_input_main();
$id_compte = isset($_SESSION['id_compte']) ? $_SESSION['id_compte'] : null;

if ($all_soiree !== NULL) {
    foreach ($all_soiree as $soiree) {
        if ($soiree['code_soiree'] !== NULL){
            continue;
        }
        $id_soiree = $soiree['id_soiree'];
        $images = getSoireeImages($id_soiree);

        $nom_soiree = $soiree['nom_soiree'];
        $description_soiree= $soiree['description_soiree'];
        $date = date("l j F", strtotime($soiree['date_soiree']));

        // Vérifier si la soirée est dans les favoris
        $isFavorite = false;
        if ($id_compte !== null) {
            $requete_fav = $connexion->prepare('SELECT 1 FROM favoris WHERE id_compte = ? AND id_soiree = ?');
            $requete_fav->bind_param('ii', $id_compte, $id_soiree);
            $requete_fav->execute();
            $result_fav = $requete_fav->get_result();
            $isFavorite = $result_fav->num_rows > 0;
        }

        // Obtenir le nombre de favoris
        $favoriteCount = getFavoriteCount($id_soiree);

        echo "
        <section class='soiree'>
            <div class='container_image' data-id='{$id_soiree}' onclick='RedirectPageSoiree(this)'>";
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
                    <h1>{$nom_soiree}</h1>
                    <h5>{$date}</h5>
                </div>
                <div class='description'>
                    <p>{$description_soiree}</p>
                </div>
                <div class='container_button'>
                    <form method='POST' action='../soiree/index.php'>
                        <input type='hidden' name='id_soiree' value='{$id_soiree}'>
                        <button name='bouton_detail' type='submit' class='link'><h4>Learn more</h4></button>
                    </form>
                    <div class='favorite_count'>Favoris : {$favoriteCount}</div>
                    <form method='POST'>
                        <div data-id-soiree='{$id_soiree}' class='like " . ($isFavorite ? 'liked' : '') . "' data-user-id='" . ($id_compte ? $id_compte : '') . "'></div>
                    </form>
                    
                </div>
            </div>
        </section>
        ";
    }
} else {
    echo "<div class='container_tendance'>Aucun résultat trouvé.</div>";
}

// Vérifier si le formulaire a été soumis et que le champ n'est pas vide
if(isset($_GET['s']) && !empty($_GET['s'])){
    $code = htmlspecialchars($_GET['s']);
    $stmt = $bdd->prepare('SELECT * FROM soiree WHERE code_soiree = :code ORDER BY id_soiree DESC');
    $stmt->execute(array('code' => $code));
    $allcode = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Si le formulaire n'a pas été soumis ou que le champ est vide, initialiser $allcode à NULL
    $allcode = NULL;
}

// Vérifier si $allcode contient des résultats
if($allcode !== NULL && isset($_GET['s'])){
    foreach($allcode as $soiree){
        echo 
            "<h3>Voici la soirée trouvée avec le code {$code}</h3>
            <div class='container_soiree'>
            <div class='soiree'>
                <span class='titre_soiree'>{$soiree['nom_soiree']}</span>
                <img class='image_soiree' src='../../Image/soiree.jpg'>

                <div class='description'>
                    <h2>Description</h2> 
                    <p>{$soiree['description_soiree']}</p>
                </div>
                <div class='info_complementaire'>
                    <p><img src='localisation_icon.png'> {$soiree['adresse_soiree']}</p>
                    <p>Nombre de personnes : {$soiree['nb_personne_soiree']}</p>
                    <p>Date de la soirée : {$soiree['date_soiree']}</p>
                    <p>Thème de la soirée : {$soiree['theme_soiree']}</p>
                    <p>Type de la soirée : {$soiree['type_soiree']}</p>
                    <p>Heure début de la soirée : {$soiree['heure_min_soiree']}</p>
                    <p>Heure fin de la soirée : {$soiree['heure_max_soiree']}</p>
                </div>
            </div>        
        </div>";
    }
} elseif(isset($_GET['s'])) {
    // Si le formulaire a été soumis mais aucun résultat trouvé
    echo "<p>Aucune soirée n'a été trouvée avec votre code.</p>";
}
?>
