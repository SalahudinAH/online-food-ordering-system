<?php
    // Inkluder Konstanter side
    include('../config/konstanter.php');
    
    if(isset($_GET['id']) && isset($_GET['bilde_navn'])) // Du kan bruke både '&&' og 'AND'
    {
        // Prosess for å slette

        // 1. Hent ID og Bilde Navn
        $id = $_GET['id'];
        $bilde_navn = $_GET['bilde_navn'];

        // 2. Fjern bilde hvis tilgjengelig
        if($bilde_navn != "")
        {
            // Hvis bilde er valgt, fjern fra mappe
            // Hent Bilde Path
            $path = "../images/mat/".$bilde_navn;

            // Fjern bilde filen fra mappe
            $remove = unlink($path);

            // Sjekk om bilde er fjernet
            if($remove==false)
            {
                // Kunne ikke fjerne bilde
                $_SESSION['upload'] = "<div class='error'>Mislykket. Kunne ikke fjerne bilde filen.</div>";
                // Omdirigere til Matmeny
                header('location:'.NETTSTEDURL.'admin/matmeny.php');
                // Stop prosessen
                die();
            }
        }
        // 3. Slett Mat fra Databasen
        $sql = "DELETE FROM mat WHERE id=$id";
        // Utfør spørringen
        $res = mysqli_query($conn, $sql);

        // Sjekk om spørringen ble utført
        if($res==true)
        {
            // Mat Slettet
            $_SESSION['delete'] = "<div class='suksess'>Mat Slettet.</div>";
            header('location:'.NETTSTEDURL.'admin/matmeny.php');
        }
        else 
        {
            // Mat ble ikke slettet
            $_SESSION['delete'] = "<div class='error'>Mislykket. Mat ble ikke slettet.</div>";
            header('location:'.NETTSTEDURL.'admin/matmeny.php');   
        }
        
    }
    else
    {
        // Omdirigere til Matmeny siden
        $_SESSION['unauthorize'] = "<div class='error'>Uautorisert tilgang</div>";
        header('location:'.NETTSTEDURL.'admin/matmeny.php');
    }
?>