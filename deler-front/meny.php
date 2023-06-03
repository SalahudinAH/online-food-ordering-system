<?php include('config/konstanter.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Viktig å gjøre nettsiden responsiv -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halal Kingdom</title>

    <!-- Koble til CSS-filen -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Navbar-delen starter her -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.php" title="Logo">
                    <img src="images/logo.png" alt="" class="img-responsive">
                </a>
            </div>

            <div class="meny text-right">
                <ul>
                    <li>
                        <a href="<?php echo NETTSTEDURL; ?>">Hjem</a>
                    </li>
                    <li>
                        <a href="<?php echo NETTSTEDURL; ?>kategorier.php">Kategorier</a>
                    </li>
                    <li>
                        <a href="<?php echo NETTSTEDURL; ?>mat.php">Mat</a>
                    </li>
                    <li>
                        <a href="<?php echo NETTSTEDURL; ?>kontakt.php">Kontakt</a>
                    </li>
                    <li>
                        <a href="<?php echo NETTSTEDURL; ?>faq.php">FAQ</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar-delen slutter her -->