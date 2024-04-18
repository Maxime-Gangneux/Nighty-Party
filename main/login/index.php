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
    <?php include '../nav_barre/nav_barre.php'; ?>
    <div>
        <form method="POST" action="../../BDD/insert_soiree.php">
            <input type="text" name="" placeholder="e-mail">
            <input type="password" name="" placeholder="password">
            <input type="text" name="" placeholder="First name">
            <input type="text" name="" placeholder="Last name">
            <input type="range" name="" placeholder="Age">
            <button type="submit" name="">Enregistrer</button>
        </form>
    </div>
    <footer>
        <p>Created and designed by Muller Julien & Gangneux Maxime</p>
    </footer>
</body>    
</html>
