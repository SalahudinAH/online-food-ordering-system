<?php 
    // Start økten
    session_start();


    // Lage Konstanter for å lagre ikke-repeterende verdier
    define('NETTSTEDURL', 'http://192.168.0.151/');
    define('LOCALHOST', 'localhost');
    define('DB_BRUKERNAVN', 'matbestilling');
    define('DB_PASSORD', 'IMKuben1337!');
    define('DB_NAVN', 'matbestilling');

    $conn = mysqli_connect(LOCALHOST, DB_BRUKERNAVN, DB_PASSORD) or die(mysqli_error($conn)); // Databasetilkobling
    $db_select = mysqli_select_db($conn, DB_NAVN) or die(mysqli_error($conn)); // Velge databasen
?>