<?php
$statu_soiree = $ligne['statu_soiree'];
$id_soiree = $ligne['id_soiree'];
$result_verif_editeur = 0;
if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {
    echo"";
} else {
    $id_compte = $_SESSION['id_compte'];

    // Requête pour obtenir l'ID de l'invité de la soirée
    $id_invite_soiree = $connexion->prepare('SELECT id_invite FROM soiree WHERE id_soiree = ?');
    $id_invite_soiree->bind_param("i", $id_soiree);
    $id_invite_soiree->execute();
    $result_invite_soiree = $id_invite_soiree->get_result();
    $row_invite_soiree = $result_invite_soiree->fetch_assoc();
    $id_invite_soiree_value = $row_invite_soiree['id_invite'];

    // Requête pour vérifier si l'utilisateur est l'invité de la soirée
    $id_invite = $connexion->prepare('SELECT id_invite FROM invite WHERE id_compte = ? AND id_soiree = ?');
    $id_invite->bind_param("ii", $id_compte, $id_soiree);
    $id_invite->execute();
    $result_invite = $id_invite->get_result();
    $row_invite = $result_invite->fetch_assoc();
    $id_invite_value = $row_invite['id_invite'];

    // Comparaison des résultats pour déterminer si l'utilisateur est l'éditeur de la soirée
    if ($id_invite_value == $id_invite_soiree_value) {
        $result_verif_editeur = 1;
    }
}


if ($result_verif_editeur == 1) {
    echo "
    <form method='POST' action='soiree_editeur.php' class=''>
        Vous êtes l'éditeur de la soirée
        <a href='soiree_editeur.php'>modifier</a>
    </form>  
    ";
} else {
    if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {
        if ($statu_soiree > 0) {
            echo "
            <form method='POST'>
                <button name='join_public' class='join_public'>Rejoindre la soirée</button>
                <input type='hidden' name='id_soiree' value='{$id_soiree}'>
            </form>";
        } else {
            echo "
            <form method='POST'>
                <button name='join_private' class='join_private'>Rejoindre la soirée</button>
                <input type='hidden' name='id_soiree' value='{$id_soiree}'>
            </form>";
        }
        if (isset($_POST['join_public']) || isset($_POST['join_private'])) {
            echo "Vous devez être connecté pour pouvoir vous inscrire";
        }
    } else {
        $requete_verif = $connexion->prepare('SELECT id_invite FROM invite WHERE id_compte = ? AND id_soiree = ?');
        $requete_verif->bind_param("ii", $id_compte, $id_soiree);
        $requete_verif->execute();
        $result_verif = $requete_verif->get_result();
        if ($result_verif->num_rows > 0) {
            echo "
            <form method='POST'>
                <button name='exit_party'>Quitter la soirée</button>
                <input type='hidden' name='id_soiree' value='{$id_soiree}'>
            </form>";
            if (isset($_POST['exit_party'])) {
                $requete_exit = $connexion->prepare('DELETE FROM invite WHERE id_compte = ? AND id_soiree = ? ');
                $requete_exit->bind_param("ii", $id_compte, $id_soiree);
                if ($requete_exit->execute()) {
                    echo "<script>window.location.href = window.location.href;</script>";
                } else {
                    echo "Erreur lors de la suppression : " . $requete_suppression->error;
                }
            }
        } else {
            if ($statu_soiree < 1) {
                echo "<button name='join_private' class='join_private'>Rejoindre la soirée</button>";
            } else {
                echo "
                <form method='POST'>
                    <button name='join_public' class='join_public'>Rejoindre la soirée</button>
                    <input type='hidden' name='id_soiree' value='{$id_soiree}'>
                </form>";
            }
            if (isset($_POST['join_public'])) {
                $requete = $connexion->prepare('INSERT INTO invite (id_compte, id_soiree) VALUES (?, ?)');
                $requete->bind_param("ii", $id_compte, $id_soiree);
                $requete->execute();

                if ($requete) {
                    echo "<script>window.location.href = window.location.href;</script>";
                } else {
                    echo "Erreur lors de l'insertion : " . $requete->errorInfo();
                }
            }
            if (isset($_POST['join_private'])) {
                echo "Vous ne pouvez pas encore ajouter de soirée privée vu que nous sommes des fainéants.";
            }
        }
    }
}
?>