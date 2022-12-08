<?php
    // Inkludere konstanter.php for url
    include('../konfig/konstanter.php');
    // 1. Ødelegge økten
    session_destroy(); // Unsets $_SESSION['bruker]

    // 2. Omdirigere til Login-siden
    header('location:'.NETTSTEDURL.'admin/login.php');
?>