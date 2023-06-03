<?php
    
    // Autorisasjon - tilgangskontrol
    // Sjekke om brukeren er logget inn
    if(!isset($_SESSION['bruker'])) // Hvis bruker session er ikke satt
    {
        // Bruker er ikke pålogget
        // Omdirigere til login-siden med melding
        $_SESSION['ingen-påloggingsmelding'] = "<div class='error text-center'>Vennligst logg inn for å få tilgang til Admin Panel.</div>";
        header('location:'.NETTSTEDURL.'/admin/login.php');
    }
?>