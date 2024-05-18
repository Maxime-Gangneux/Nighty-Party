<?php
include '../../BDD/conexion.php';
$connexion = connecterBaseDonnees();
session_start();
if (isset($_SESSION['connected'])){
    $id_compte = $_SESSION['id_compte'];
    $all_soiree_editeur = $connexion->prepare('SELECT id_soiree FROM soiree WHERE id_invite IN (SELECT id_invite FROM invite WHERE id_compte = ?)');
    $all_soiree_editeur->bind_param("i",$id_compte);
    $all_soiree_editeur->execute();
    $all_soiree_editeur = $all_soiree_editeur->get_result();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Party</title>
    <link rel="stylesheet" href="css.css">
    <script src="app.js"></script>
</head>
<body>
    <?php
        include '../nav_barre/nav_barre.php';
    ?>
    <main>         
        <h1>My Party - Gérez vos événements avec implicité</h1>
        <p>Bienvenue dans <strong>My Party</strong>, votre espace personnel sur Nighty Party pour organiser et gérer toutes vos soirées. Retrouvez ici toutes les soirées que vous avez créées et personnalisez-les selon vos envies pour des événements mémorables.</p>

        <div class="content_liste">
            <div class='banner'>
                <div class='txt_banner'>
                    <div><h1>Vos Soirées </h1></div>
                    <div><p>Créer vos propres soirée</p></div>
                </div>
            </div>
            <ul class="liste_soiree_editeur">
                <?php
                    include 'all_soiree_editeur.php';
                ?>
            </ul>
        </div>

            <div class='container_link'>
            <form action='create.php'>
                <button class='link'><h4>create party </h4></button>
            </form> 
            </div>
        <p>Nighty party le site de l'organisation</p>
        <div class='container_txt'>


            <h2>Vos soirées créées</h2>
            <ul>
                <li><strong>Visualisez et modifiez :</strong> Consultez la liste de toutes les soirées que vous avez organisées. Modifiez les détails de chaque soirée, y compris le nom, la description, la date, le lieu, le nombre de participants, et bien plus encore.</li>
                <li><strong>Gestion des invités :</strong> Ajoutez ou supprimez des invités, envoyez des invitations et gérez les réponses directement depuis le site.</li>
                <li><strong>Coordination des apports :</strong> Indiquez ce que chaque invité doit apporter (boissons, nourriture, etc.) et suivez en temps réel qui apporte quoi pour éviter les doublons.</li>
                <li><strong>Tarifs d'entrée :</strong> Fixez un prix d'entrée pour couvrir les frais de l'événement si nécessaire.</li>
                <li><strong>Options avancées :</strong> Ajoutez des informations supplémentaires comme des photos, le matériel disponible (enceintes, éclairage, etc.), et l'emplacement exact (salle, maison, parc, etc.).</li>
                <li><strong>Visibilité de la soirée :</strong> Gérez la visibilité de vos soirées : choisissez entre une soirée publique, visible par tout le monde, ou une soirée privée, accessible uniquement avec un code d'invitation.</li>
                <li><strong>Communication centralisée :</strong> Utilisez notre système de messagerie intégré pour communiquer avec vos invités avant, pendant et après la soirée.</li>
                <li><strong>Planification collaborative :</strong> Permettez à vos amis de participer à l'organisation en leur assignant des rôles spécifiques comme DJ, responsable des boissons, etc.</li>
                <li><strong>Suivi des RSVPs :</strong> Suivez facilement qui a confirmé sa présence et qui est encore en attente de réponse.</li>
                <li><strong>Cartes et directions :</strong> Fournissez des cartes détaillées et des directions pour que vos invités trouvent facilement le lieu de la soirée.</li>
                <li><strong>Sécurité et confidentialité :</strong> Protégez vos événements avec des options de sécurité, telles que la validation des invités à l'entrée et la gestion des listes d'invités privées.</li>
            </ul>

            <h2>Créer une nouvelle soirée</h2>
            <p>Prêt à organiser une nouvelle soirée ? Utilisez le bouton ci-dessous pour accéder à notre page de création de soirée. En quelques étapes simples, planifiez votre prochain événement inoubliable :</p>

            <p>Rejoignez <strong>Nighty Party</strong> dès aujourd'hui et faites de chaque soirée un événement inoubliable !</p>
        </div>
        
    </main>
</body>
</html





