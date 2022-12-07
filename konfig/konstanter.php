<?php
    // Start økten
    session_start();


    // Lage Konstanter for å lagre ikke-repeterende verdier
    define('NETTSTEDURL', 'http://localhost/mat-bestilling/');
    define('LOCALHOST', 'localhost');
    define('DB_BRUKERNAVN', 'root');
    define('DB_PASSORD', '');
    define('DB_NAVN', 'mat-bestilling');

    $conn = mysqli_connect(LOCALHOST, DB_BRUKERNAVN, DB_PASSORD) or die(mysqli_error()); // Databasetilkobling
    $db_select = mysqli_select_db($conn, DB_NAVN) or die(mysqli_error()); // Velge databasen
?>