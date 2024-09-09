<?php
session_start();
include 'conexion.php'; // Inclure votre fichier de connexion à la base de données

// Se connecter à la base de données
$connexion = connecterBaseDonnees();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['id_compte']) && isset($_SESSION['connected'])) {
        $id_soiree = $_POST['id_soiree'];
        $id_compte = $_SESSION['id_compte'];
        $action = $_POST['action'];

        if ($action === 'add_favorite') {
            $requete_verif = $connexion->prepare('SELECT id_favoris FROM favoris WHERE id_compte = ? AND id_soiree = ?');
            $requete_verif->bind_param("ii", $id_compte, $id_soiree);
            $requete_verif->execute();
            $result_verif = $requete_verif->get_result();

            if ($result_verif->num_rows > 0) {
                echo "Cette soirée est déjà dans vos favoris.";
            } else {
                $requete = $connexion->prepare('INSERT INTO favoris (id_compte, id_soiree) VALUES (?, ?)');
                $requete->bind_param("ii", $id_compte, $id_soiree);
                $requete->execute();

                if ($requete) {
                    echo "Insertion réussie!";
                } else {
                    echo "Erreur lors de l'insertion : " . $requete->errorInfo();
                }
            }
        } elseif ($action === 'remove_favorite') {
            $requete_suppression = $connexion->prepare('DELETE FROM favoris WHERE id_compte = ? AND id_soiree = ?');
            $requete_suppression->bind_param("ii", $id_compte, $id_soiree);
            if ($requete_suppression->execute()) {
                echo "La soirée a été supprimée des favoris.";
            } else {
                echo "Erreur lors de la suppression : " . $requete_suppression->error;
            }
        }
    } else {
        echo "Erreur : Vous devez être connecté pour ajouter ou supprimer une soirée des favoris.";
    }
}
?>
