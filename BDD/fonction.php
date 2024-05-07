<?php
if(!isset($_SESSION['connected']) || $_SESSION['connected'] !== true){
    $statu_soiree = $connexion->execute('SELECT statu_soiree FROM soiree');
    if ($statu_soiree > 0){
        echo"<button name='join_public' class='join_public'>Join the party</button>";
    }else{
        echo"<button name='join_private' class='join_private'>Join the party</button>";
    }  
    if (isset('join_public') || isset('join_private') ){
        echo"Vous devez etre connecter pour pouvoir vous inscrire"
    }
}else{
    
}

?>