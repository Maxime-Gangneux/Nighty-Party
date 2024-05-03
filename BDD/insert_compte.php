<?php
include 'conexion.php';
session_start(); // Démarrez la session

$connexion = connecterBaseDonnees();

if(isset($_POST['submit_button_compte'])){
    $indentifiant_compte = trim($_POST['indentifiant_compte']);
    $mot_de_passe_compte = trim($_POST['mot_de_passe_compte']);
    $nom_compte = trim($_POST['nom_compte']);
    $prenom_compte = trim($_POST['prenom_compte']);
    $age_compte = trim($_POST['age_compte']);

    if(empty($indentifiant_compte) || empty($mot_de_passe_compte) || empty($nom_compte) || empty($prenom_compte) || empty($age_compte)) {
        echo "Veuillez remplir tous les champs.";
    } else {
        $sql = "INSERT INTO `compte` (`id_compte`, `identifiant_compte`, `mot_de_passe_compte`, `nom_compte`, `prenom_compte`, `age_compte`) VALUES (NULL, '$indentifiant_compte', '$mot_de_passe_compte', '$nom_compte', '$prenom_compte', '$age_compte')";

        if ($connexion->query($sql) === TRUE) {

            // Récupérez l'ID du compte nouvellement créé
            $id_compte = $connexion->insert_id;

            // Stockez l'ID du compte dans la session
            $_SESSION['id_compte'] = $id_compte;
            
            echo "Données enregistrées avec succès !";

            exit(); // Assurez-vous de terminer le script après la redirection
        } else {
            echo "Erreur : " . $connexion->error;
        }

        $connexion->close();
    }
}
?>
