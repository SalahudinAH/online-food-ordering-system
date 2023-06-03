<?php
    // Include Konstanter Fil
    include('../config/konstanter.php');

    // Sjekk om id og bilde_navn er angitt
    if(isset($_GET['id']) AND isset($_GET['bilde_navn']))
    {
        // Hent Verdien og Slett
        $id = $_GET['id'];
        $bilde_navn = $_GET['bilde_navn'];

        // Fjern bilde hvis tilgjengelig
        if($bilde_navn != "")
        {
            // Bilde er tilgjengelig, fjern den
            $path = "../images/kategori/".$bilde_navn;
            // Fjern bilde
            $remove = unlink($path);

            // Hvis mislykket med å fjerne bilde, legg til en feilmelding og slutt prosessen
            if($remove==false)
            {
                // Angi Session Melding
                $_SESSION['remove'] = "<div class='error'>Mislykket.</div>";
                // Omdirigere til Kategori-siden
                header('location:'.NETTSTEDURL.'admin/kategori.php');
                // Stop prossesen 
                die();
            }
        }

        // Slett Data fra Databasen
        // SQL-spørring for å slette Data fra Databasen
        $sql = "DELETE FROM kategori WHERE id=$id";

        // Utfør spørringen
        $res = mysqli_query($conn, $sql);

        // Sjekk om Data er slettet fra Databasen
        if($res==true)
        {
            // Angi Suksess Melding og Omdirigere
            $_SESSION['delete'] = "<div class='suksess'>Kategori slettet.</div>";
            // Omdirigere til Kategori-siden
            header('location:'.NETTSTEDURL.'admin/kategori.php');
        }
        else 
        {
        // Angi Error Melding og Omdirigere
        $_SESSION['delete'] = "<div class='error'>Mislykket.</div>";
        // Omdirigere til Kategori-siden
        header('location:'.NETTSTEDURL.'admin/kategori.php');
        }


    }
    else 
    {
        // Omdirigere til Kategori-siden
        header('location:'.NETTSTEDURL.'admin/kategori.php');    
    }
?>