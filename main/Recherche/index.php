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
    <?php
        include '../nav_barre/nav_barre.php';
    ?>
    <div class="container_input">
        <input type="text" id="input_soiree" class="input_soiree" placeholder="Rechercher une soirée" >
    </div>
    <div class="container_code" id="container_code">
        <button onclick="Ouvrir_container_code()" class="logo_code"><\></button>
        <input type="text" class="input_code" placeholder="Entrer le code la soirée">
    </div>








    <script>
        function Ouvrir_container_code() {
            var container = document.getElementById("container_code");
            if (container.style.right === "-16vw") {
                container.style.right = "0";
            } else {
                container.style.right = "-16vw";
            }
        }
    </script>

</body>
    
</html>