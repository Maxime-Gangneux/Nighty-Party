<?php
if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {
    $result_verif_editeur = 0;
} else {
    $id_compte = $_SESSION['id_compte'];

    $requete_verif_editeur = "SELECT EXISTS (
                                    SELECT 1
                                    FROM soiree
                                    INNER JOIN invite ON soiree.id_soiree = invite.id_soiree
                                    WHERE soiree.id_soiree = 13 AND soiree.id_invite = 2
                                ) AS is_editeur;";

    // Exécution de la requête
    $result_verif_editeur = $connexion->query($requete_verif_editeur);

    if($result_verif_editeur){
        $row = $result_verif_editeur->fetch_assoc();
    }

    if ($row["is_editeur"] && isset($_SESSION['connected'])) {
        echo "Vous êtes l'éditeur de la soirée";
    } else {
        if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {
            if ($statu_soiree > 0) {
                echo "
                <form method='POST'>
                    <button name='join_public' class='join_public'>Rejoindre la soirée publique</button>
                    <input type='hidden' name='id_soiree' value='{$id_soiree}'>
                </form>";
            } else {
                echo "
                <form method='POST'>
                    <button name='join_private' class='join_private'>Rejoindre la soirée privée</button>
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
                    echo "<button name='join_private' class='join_private'>Rejoindre la soirée privée</button>";
                } else {
                    echo "
                    <form method='POST'>
                        <button name='join_public' class='join_public'>Rejoindre la soirée publique</button>
                        <input type='hidden' name='id_soiree' value='{$id_soiree}'>
                    </form>";
                }
                if (isset($_POST['join_public'])) {
                    $requete = $connexion->prepare('INSERT INTO invite (id_compte, id_soiree, id_editeur) VALUES (?, ?, ?)');
                    $zero = 0;
                    $requete->bind_param("iii", $id_compte, $id_soiree, $zero);
                    $requete->execute();

                    if ($requete) {
                        echo "<script>window.location.href = window.location.href;</script>";
                    } else {
                        echo "Erreur lors de l'insertion : " . $requete->errorInfo();
                    }
                }
                if (isset($_POST['join_private'])) {
                    echo "Vous ne pouvez pas encore ajouter de soirée privée vue que nous sommes des fainéants.";
                }
            }
        }
    }
}
?>
