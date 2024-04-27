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
    <section>
        <div>
            <h2 class="title_home">Nighty Party</h2>
            <p class="text_presentation">Rejoint toutes les soireés près de chez toi en cliquant sur le bouton en dessous.</p>
        </div>
        <img src="../../Image/fond_soiree.png" alt="">
    </section>
    <div class="container">
        <?php
            include '../../BDD/soiree.php';
        ?>
    </div>

    <footer>
        <p>Created and designed by Muller Julien & Gangneux Maxime</p>
    </footer>
</body>
</html>
