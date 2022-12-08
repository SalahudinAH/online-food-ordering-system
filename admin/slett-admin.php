<?php
    
    // Inkludere konstanter.php fil her
    include('../konfig/konstanter.php');

    // 1. Få IDen til admin slettet
    $id = $_GET['id'];

    // 2. Lag SQL-spørring for å slette Admin
    $sql = "DELETE FROM admin WHERE id=$id";

    // Utføre spørringen
    $res = mysqli_query($conn, $sql);

    // Sjekk om spørringen er utført velykket 
    if($res==true)
    {
        // Spørring utført velykket og admin slettet
        // Lag økt variabel for å vise melding
        $_SESSION['delete'] = "<div class='suksess'>Admin slettet.</div>";
        // Omdirigere side til Administrasjon siden
        header('location:'.NETTSTEDURL.'admin/admin.php');
    }
    else
    {
        // Mislykket å slette admin
        $_SESSION['delete'] = "<div class='error'>Mislykket. Prøv igjen senere.</div>";
        header('location:'.NETTSTEDURL.'admin/admin.php');
    }
?>