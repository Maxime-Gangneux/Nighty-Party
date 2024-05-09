<?php
// Démarrez la session
session_start();

// Vérifiez si l'utilisateur est connecté
if(isset($_SESSION['connected']) && $_SESSION['connected'] == true){
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: ../account/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css.css">
    <script src="app.js"></script>
</head>
<body>
    <?php
        include '../nav_barre/nav_barre.php';
    ?>
    <form class = "sign_in" id = "sign_in" method='POST' action='../../BDD/insert_compte.php'>
        <h2>Sign In</h2>
        <div style = 'display: flex; justify-content: space-between;'>
            <input type='text' name='nom_compte' placeholder='First name'>
            <input type='text' name='prenom_compte' placeholder='Last name'>
        </div>
        <input type='text' name='indentifiant_compte' placeholder='e-mail'>
        <input type='password' name='mot_de_passe_compte' placeholder='password'>
        <input type='number' name='age_compte' placeholder='Age'>
        <button type='submit' name='submit_button_compte'>Create an account</button>
        <div class = "switch" onclick = "switchForms()">connect</div>
    </form>
    <form class = "login" id = "login" method='POST' action='../../BDD/login.php'>
        <h2>Login</h2>
        <input type='email' name='email' placeholder='e-mail'>
        <input type='password' name='password' placeholder='password'>
        <button type='submit' name='submit_button_login'>Connect</button>
        <div class = "switch" onclick = "switchForms()">sign in</div>
    </form> 
    <div class = "fond_cote">
    </div>
    <footer>
        <p>Created and designed by Muller Julien & Gangneux Maxime</p>
    </footer>
</body>    
</html>
