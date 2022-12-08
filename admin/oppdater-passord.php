<?php include('deler/meny.php'); ?>

<div class="hoved-innhold">
    <div class="innpakning">
        <h1>Endre Passord</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Nåværende Passord: </td>
                    <td>
                        <input type="password" name="gammel_passord" placeholder="Nåværende Passord">
                    </td>
                </tr>

                <tr>
                    <td>Ny Passord: </td>
                    <td>
                        <input type="password" name="ny_passord" placeholder="Ny Passord">
                    </td>
                </tr>

                <tr>
                    <td>Bekreft Passord: </td>
                    <td>
                        <input type="password" name="bekreft_passord" placeholder="Bekreft Passord">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Endre Passord" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php
    // Sjekk om submit-knappen er klikket
    if(isset($_POST['submit']))
    {
        //echo "Klikket";

        // 1. Hent data fra form
        $id=$_POST['id'];
        $nåværende_passord = md5($_POST['gammel_passord']);
        $ny_passord = md5($_POST['ny_passord']);
        $bekreft_passord = md5($_POST['bekreft_passord']);

        // 2. Sjekk om brukeren med nåværende ID og Passord finnes
        $sql = "SELECT * FROM admin WHERE id=$id AND passord='$nåværende_passord'";

        // Utføre spørringen
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            // Sjekk om data er tilgjengelig
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                // Brukeren finnes og Passord kan endres
                // Sjekk om det nye passordet samsvarer med det som er bekreftet
                if($ny_passord==$bekreft_passord)
                {
                    // Oppdater Passord
                    $sql2 = "UPDATE admin SET
                        passord='$ny_passord'
                        WHERE id=$id
                    ";

                    // Utføre spørringen
                    $res2 = mysqli_query($conn, $sql2);

                    // Sjekk om spørringen er utført
                    if($res2==true)
                    {
                        // Omdirigere til Administrasjonssiden med suksess melding
                        $_SESSION['endre-passord'] = "<div class='suksess'>Passordet ble endret.</div>";
                        header('location:'.NETTSTEDURL.'admin/admin.php');
                    }
                    else
                    {
                        // Omdirigere til Administrasjonssiden med feil-melding
                        $_SESSION['endre-passord'] = "<div class='error'>Mislykket.</div>";
                        header('location:'.NETTSTEDURL.'admin/admin.php');
                    }
                }
                else
                {
                    // Omdirigere til Administrasjonssiden med feil-melding
                    $_SESSION['passord-stemmer-ikke'] = "<div class='error'>Passordet stemte ikke.</div>";
                    header('location:'.NETTSTEDURL.'admin/admin.php');
                }
            }
            else
            {
                // Brukeren finnes ikke, angi melding og omdirigere
                $_SESSION['bruker-ikke-funnet'] = "<div class='error'>Bruker ikke funnet.</div>";
                header('location:'.NETTSTEDURL.'admin/admin.php');
            }
        }
    }
?>

<?php include('deler/footer.php'); ?>