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
        include '../../BDD/api.php';
    ?>
    <section>
        <div class = "image"></div>
        <div class = "info_container">
            <div class = "infos_general">
                <p>titre</p>
                <p>date</p>
                <p>description</p>
            </div>
            <div class = "contenue">
                <div class ="personnes"></div>
                <div class = "boissons"></div>
            </div>
        </div>

    </section>
    <footer>
        <p>Created and designed by Muller Julien & Gangneux Maxime</p>
    </footer>
</body>    
</html>
