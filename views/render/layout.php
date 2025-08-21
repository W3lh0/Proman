<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proman - Login
</head>
<body>
    <header>
        <?php
        if (!isset($hideNavbar) || $hideNavbar !== true) {
            include 'nav.php';
        } 
        ?>
    </header>
    <main>
        <?php include $view_file; ?>
    </main>
    <footer>
        <p>Software developement II <?php echo date("Y"); ?> Ilkka Ratilainen - e2101506 - VAMK</p>
    </footer>
</body>
</html>