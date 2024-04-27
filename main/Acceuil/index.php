<!DOCTYPE html>
<html lang="en">
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

    <div class="title_home">Nighty Party</div>
    
    <div class="container">
        <?php
            include '../../BDD/soiree.php';
        ?>
    </div>
    <section>
        <img src = "../../Image/fond_soiree.png">
    </section>

    <footer>
        <p>Created and designed by Muller Julien & Gangneux Maxime</p>
    </footer>
</body>
</html>
