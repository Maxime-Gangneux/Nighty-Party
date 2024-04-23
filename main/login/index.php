<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nighty Party</title>
    <link rel="stylesheet" href="css.css">
    <script src="app.js"></script>
</head>
<body>
    <div class="spherelumineuse" id ="spherelumineuse"></div>
    <div class="spherelumineuse" id ="spherelumineuse"></div>
    <div class="spherelumineuse" id ="spherelumineuse"></div>
    <div class="spherelumineuse" id ="spherelumineuse"></div>
    <div class="spherelumineuse" id ="spherelumineuse"></div>
    <div class="spherelumineuse" id ="spherelumineuse"></div>
    <div class="spherelumineuse" id ="spherelumineuse"></div>
    <form class = "sign_in" method='POST' action='../../BDD/insert_compte.php'>
            <input type='text' name='indentifiant_compte' placeholder='e-mail'>
            <input type='password' name='mot_de_passe_compte' placeholder='password'>
            <input type='text' name='nom_compte' placeholder='First name'>
            <input type='text' name='prenom_compte' placeholder='Last name'>
            <input type='number' name='age_compte' placeholder='Age'>
            <button type='submit' name='submit_button_compte'>Enregistrer</button>
            <div class = "switch" onclick = "switchForms()">switch</div>
        </form>
        <form class = "login" method='POST' action='../../BDD/login.php'>
            <input type='email' name='email' placeholder='e-mail'>
            <input type='password' name='password' placeholder='password'>
            <button type='submit' name='submit_button_login'>Enregistrer</button>
        </form>
        <form class = "disconnect" method= 'POST' action='../../BDD/login.php'>
            <button type='submit' name='submit_button_disconnect'>disconnect</button>
        </form> 
    <div class = "fond_cote">
    </div>
</body>    
</html>
