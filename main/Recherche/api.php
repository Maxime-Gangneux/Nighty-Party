<?php
include '../../BDD/conexion.php';

// Se connecter à la base de données
$connexion = connecterBaseDonnees();

function verif_input_main(){
    global $connexion;

    if(isset($_GET['main_search']) && !empty($_GET['main_search'])){
        $contenue = htmlspecialchars($_GET['main_search']);
        $all_nom_soiree = $connexion->prepare('SELECT * FROM soiree WHERE nom_soiree LIKE "'.$contenue.'%"  ');
        $all_description_soiree = $connexion->prepare('SELECT * FROM soiree WHERE description_soiree LIKE "'.$contenue.'%"  ');
        $all_adresse_soiree = $connexion->prepare('SELECT * FROM soiree WHERE adresse_soiree LIKE "'.$contenue.'%"  ');
        $all_type_soiree = $connexion->prepare('SELECT * FROM soiree WHERE type_soiree LIKE "'.$contenue.'%"  ');
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


// Démarrez la session
session_start();

// Vérifiez si l'utilisateur est connecté
if((isset($_POST['button_favoris'])) && (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true)){
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: ../login/index.php");
    exit();
}

if (isset($_POST['button_favoris'])){
    $id_compte = $_SESSION['id_compte'];
    $id_soiree = $_POST['id_soiree'];
    global $connexion;
    $requete = $connexion->prepare('INSERT INTO favoris (id_compte, id_soiree) VALUES (:id_compte, :id_soiree)');
    $requete->execute(array('id_compte' => $id_compte, 'id_soiree' => $id_soiree));
    exit();
}

?>