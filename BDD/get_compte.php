<?php
include 'conexion.php';

// Se connecter à la base de données
$connexion = connecterBaseDonnees();

try {
    // Requête SQL
    $requete = "SELECT * FROM compte WHERE identifiant_compte = '{$_SESSION['email']}' ";

    // Exécution de la requête
    $resultat = $connexion->query($requete);

    // Vérification du résultat
    if (!$resultat) {
        throw new Exception("Erreur lors de l'exécution de la requête : " . $connexion->error);
    }

    // Ajout des résultats dans la chaîne
    while ($ligne = $resultat->fetch_assoc()) {
        echo"<h1> Bienvenue {$ligne['nom_compte']} {$ligne['prenom_compte']} </h1>
            <div class = 'barre'></div>
            <div class = 'compte_container'>
                <h3> vos informations </h3>
                <div class ='compte_infos'>
                    <p> email : {$ligne['identifiant_compte']} <p>
                    <p> mot de passe : {$ligne['mot_de_passe_compte']} <p>
                    <p> age : {$ligne['age_compte']} ans <p> 
                </div> 
                <h3> changer de mot de passe </h3>  
                <form class ='mdp_change'>
                    <p> Choisir un nouveau mot de passe : </p>
                    <input type ='password'>
                </form>
                <h3>Deconnection</h3> 
                <form class = 'disconnect' method= 'POST' action='../../BDD/login.php'>
                    <button type='submit' name='submit_button_disconnect'>disconnect</button>
                </form>
            </div>";
    }

} catch (Exception $e) {
    // Gérer l'exception (erreur)
    echo "Erreur : " . $e->getMessage();
} finally {
    // Fermer la connexion, même si une exception est survenue
    if (isset($connexion)) {
        $connexion->close();
    }
}
?>
