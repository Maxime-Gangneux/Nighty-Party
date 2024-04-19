<?php
include 'conexion.php';

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
            echo "Données enregistrées avec succès !";
        } else {
            echo "Erreur : " . $connexion->error;
        }

        $connexion->close();
    }
}
?>
