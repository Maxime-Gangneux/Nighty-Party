<?php
// Inclure le fichier de connexion à la base de données
include 'conexion.php';

$connexion = connecterBaseDonnees();
// Démarrez la session
session_start();

// Vérifie si le formulaire de connexion a été soumis
if(isset($_POST['submit_button_login'])){
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête pour vérifier les informations d'identification dans la base de données
    $sql = "SELECT mot_de_passe_compte, nom_compte, prenom_compte FROM compte WHERE identifiant_compte = '$email'";
    
    // Exécuter la requête
    $result = $connexion->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password == $row["mot_de_passe_compte"]){
            // Mot de passe correct, définir la session de l'utilisateur comme connectée
            $_SESSION['connected'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['nom'] = $row['nom_compte'];
            $_SESSION['prenom'] = $row['prenom_compte'];
            // Redirection vers la page de profil ou une autre page protégée
            header("Location: ../main/login/index.php");
            exit();
        } else {
            // Mot de passe incorrect
            echo "Mot de passe incorrect.";
        }
    } else {
        // L'e-mail n'existe pas dans la base de données
        echo "Adresse e-mail non reconnue.";
    }
}
if(isset($_POST['submit_button_disconnect'])){
    // Déconnexion de l'utilisateur
    session_destroy();
    header("Location: ../main/login/index.php");
    exit();
}
// Fermer la connexion à la base de données
$connexion->close();
?>
