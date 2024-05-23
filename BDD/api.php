<?php
include '../../BDD/conexion.php';
include 'get_images.php';

// Se connecter à la base de données
$connexion = connecterBaseDonnees();


function verif_input_main(){
    global $connexion;

    if(isset($_GET['main_search']) && !empty($_GET['main_search'])){
        $contenue = htmlspecialchars($_GET['main_search']);
        $all_nom_soiree = $connexion->prepare('SELECT * FROM soiree WHERE nom_soiree LIKE "%'.$contenue.'%"  ');
        $all_description_soiree = $connexion->prepare('SELECT * FROM soiree WHERE description_soiree LIKE "%'.$contenue.'%"  ');
        $all_adresse_soiree = $connexion->prepare('SELECT * FROM soiree WHERE adresse_soiree LIKE "%'.$contenue.'%"  ');
        $all_type_soiree = $connexion->prepare('SELECT * FROM soiree WHERE type_soiree LIKE "%'.$contenue.'%"  ');
        if ($all_nom_soiree->execute()) {
            // Stocker le résultat
            $all_nom_soiree->store_result();
            
            // Récupérer le nombre de lignes affectées
            $rowCount = $all_nom_soiree->num_rows;
            
            if ($rowCount > 0) {
                // Liaison du paramètre avec la valeur et exécution de la requête
                $all_nom_soiree->execute();
                // Récupération des résultats dans un tableau associatif
                $result = $all_nom_soiree->get_result();
                $nom_soiree = $result->fetch_all(MYSQLI_ASSOC);
                return $nom_soiree;}
        }
        if($all_description_soiree->execute()){
            $all_description_soiree->store_result();
            $rowCount = $all_description_soiree->num_rows;
            if ($rowCount > 0) {
                // Liaison du paramètre avec la valeur et exécution de la requête
                $all_description_soiree->execute();
                // Récupération des résultats dans un tableau associatif
                $result = $all_description_soiree->get_result();
                $description_soiree = $result->fetch_all(MYSQLI_ASSOC);
                return $description_soiree;}
        }
        if($all_adresse_soiree->execute()){
            $all_adresse_soiree->store_result();
            $rowCount = $all_adresse_soiree->num_rows;
            if ($rowCount > 0) {
                // Liaison du paramètre avec la valeur et exécution de la requête
                $all_adresse_soiree->execute();
                // Récupération des résultats dans un tableau associatif
                $result = $all_adresse_soiree->get_result();
                $adresse_soiree = $result->fetch_all(MYSQLI_ASSOC);
                return $adresse_soiree;}
        }
        if($all_type_soiree->execute()){
            $all_type_soiree->store_result();
            $rowCount = $all_type_soiree->num_rows;
            if ($rowCount > 0) {
                // Liaison du paramètre avec la valeur et exécution de la requête
                $all_type_soiree->execute();
                // Récupération des résultats dans un tableau associatif
                $result = $all_type_soiree->get_result();
                $type_soiree = $result->fetch_all(MYSQLI_ASSOC);
                return $type_soiree;}
        }
    }
    return NULL;
}

$all_soiree = verif_input_main();

    if ($all_soiree !== NULL) {
        foreach ($all_soiree as $soiree) {
            if ($soiree['code_soiree'] !== NULL){
                continue;
            }
            $id_soiree = $soiree['id_soiree'];
            $images = getSoireeImages($id_soiree);

            $soiree_nom = utf8_encode($soiree['nom_soiree']);
            $soiree_description = utf8_encode($soiree['description_soiree']);
            $date = date("l j F", strtotime($soiree['date_soiree']));

            echo "
            <section>
                <div class='content'>
                    <div class='info_soiree'>
                        <h1>{$soiree_nom}</h1>

                        <h5>{$date}</h5>

                        <div class='description'>
                            <p>{$soiree_description}ufgsyufhusdfudshfd</p>
                        </div>
                            <div class = 'container_button'>
                                <form method='POST' action='../soiree/index.php'>
                                    <input type='hidden' name='id_soiree' value='{$soiree['id_soiree']}'>
                                    <button name='bouton_detail' type='submit' class='link'><h4>Learn more</h4></button>
                                </form>                        
                                <form method = 'POST'>
                                    <input type='hidden' name='id_soiree' value='{$soiree['id_soiree']}'>
                                    <button  name='button_favorite'><a class='link'><h4>Add to favorites</h4></a></button>
                                </form>
                            </div>
                    </div>";
                    if ($images){
                        foreach ($images as $image) {
                            echo"
                        <div class='container_image'>
                            <img src='data:" . htmlspecialchars($image['image_type']) . ";base64," . base64_encode($image['image_data']) . "' alt='" . htmlspecialchars($image['image_name']) . "'>
                        </div>";}
                    }else{
                        echo"
                        <div class='container_image'>
                            <img src='../../Image/logo.png'>
                        </div>
                        ";
                    }
                    echo"
                </div>
            </section>
            ";
        }
    } else {
        echo "<div class ='container_tendance'>Aucun résultat trouvé.</div>";
    }

// Vérifiez si le formulaire a été soumis
if(isset($_POST['button_favorite'])) {
    // Vérifiez si l'utilisateur est connecté
    if(isset($_SESSION['id_compte']) && isset($_SESSION['connected'])) {
        // Récupérez l'ID de la soirée à partir du formulaire
        $id_soiree = $_POST['id_soiree'];

        // Récupérez l'ID du compte connecté à partir de la session
        $id_compte = $_SESSION['id_compte'];

        // Vérifiez si la soirée est déjà dans les favoris de l'utilisateur
        $requete_verif = $connexion->prepare('SELECT id_favoris FROM favoris WHERE id_compte = ? AND id_soiree = ?');
        $requete_verif->bind_param("ii", $id_compte, $id_soiree);
        $requete_verif->execute();
        $result_verif = $requete_verif->get_result();

        if($result_verif->num_rows > 0) {
            echo "Cette soirée est déjà dans vos favoris.";
        } else {
            // Ajoutez la soirée aux favoris dans la base de données
            $requete = $connexion->prepare('INSERT INTO favoris (id_compte, id_soiree) VALUES (?, ?)');
            $requete->bind_param("ii", $id_compte, $id_soiree);
            $requete->execute();

            if($requete) {
                echo "Insertion réussie!";
            } else {
                echo "Erreur lors de l'insertion : " . $requete->errorInfo();
            }
        }
    } else {
        echo "Erreur : Vous devez être connecté pour ajouter une soirée aux favoris.";
    }
}



$bdd = new PDO('mysql:host=localhost;dbname=nighty party', 'root', '');

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
            <div class = 'soiree'>
                <span class = 'titre_soiree'>{$soiree['nom_soiree']}</span>
                <img class = 'image_soiree' src='../../Image/soiree.jpg'>

                <div class = description>
                    <h2> Description </h2> 
                    <p> {$soiree['description_soiree']} </p>
                </div>
                <div class = 'info_complementaire'>
                    <p><img src ='localisation_icon.png'> {$soiree['adresse_soiree']}</p>
                    <p>Nombre de personnes : {$soiree['nb_personne_soiree']}</p>
                    <p>Date de la soirée : {$soiree['date_soiree']}</p>
                    <p>thème de la soirée : {$soiree['theme_soiree']}</p>
                    <p>Type de la soirée : {$soiree['type_soiree']}</p>
                    <p>Heure debut de la soirée : {$soiree['heure_min_soiree']}</p>
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
