<?php


$statu_soiree = $ligne['statu_soiree'];
$id_soiree = $ligne['id_soiree'];
if(!isset($_SESSION['connected']) || $_SESSION['connected'] !== true){
    if ($statu_soiree > 0){
        echo"
        <form method='POST'>
            <button name='join_public' class='join_public'>Join the party</button>
        <input type='hidden' name='id_soiree' value='{$id_soiree}'>
        </form>";
    }else{
        echo"
        <form method='POST'>
            <button name='join_private' class='join_private'>Join the party</button>
            <input type='hidden' name='id_soiree' value='{$id_soiree}'>
        </form>";
    }  
    if (isset($_POST['join_public']) || isset($_POST['join_private']) ){
        echo"Vous devez etre connecter pour pouvoir vous inscrire";
    }
}else{
    $id_compte = $_SESSION['id_compte'];
    $requete_verif = $connexion->prepare('SELECT id_invite FROM invite WHERE id_compte = ? AND id_soiree = ?');
    $requete_verif->bind_param("ii", $id_compte, $id_soiree);
    $requete_verif->execute();
    $result_verif = $requete_verif->get_result();
    if($result_verif->num_rows > 0) {
        echo "
        <form method='POST'>
            <button name='exit_party'>quitter la soirée</button>
            <input type='hidden' name='id_soiree' value='{$id_soiree}'>
        </form>";
        if (isset($_POST['exit_party'])){
            $requete_exit = $connexion->prepare('DELETE FROM invite WHERE id_compte = ? AND id_soiree = ? ');
            $requete_exit->bind_param("ii", $id_compte, $id_soiree);
            if ($requete_exit->execute()){
                echo"<script> window.location.href = window.location.href ;</script>";
            } else {
                echo "Erreur lors de la suppression : " . $requete_suppression->error;
            }    
        }
    }else {
        if ($statu_soiree < 1){
            echo"<button name='join_private' class='join_private'>Join the party private</button>";
        }else{
            echo"
            <form method='POST'>
                <button name='join_public' class='join_public'>Join the party public</button>
                <input type='hidden' name='id_soiree' value='{$id_soiree}'>
            </form>";
        }
        if (isset($_POST['join_public'])){
            $requete = $connexion->prepare('INSERT INTO invite (id_compte, id_soiree) VALUES (?, ?)');
            $requete->bind_param("ii", $id_compte, $id_soiree);
            $requete->execute();

            if($requete) {
                echo"<script> window.location.href = window.location.href ;</script>";
            } else {
                echo "Erreur lors de l'insertion : " . $requete->errorInfo();
            }
        if (isset($_POST['join_private'])){
            echo"vous ne pouvez pas encore ajouter de soirée privée vue que on est des feniasse";
        }
        }
    }


}

?>