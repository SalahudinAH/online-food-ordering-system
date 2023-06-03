<?php include('deler/meny.php'); ?>

<div class="hoved-innhold">
    <div class="innpakning">
        <h1>Oppdater Admin</h1>

        <br><br>

        <?php
            // 1. Få IDen til valgt Admin
            $id=$_GET['id'];

            // 2. Lage en SQL-spørring for å få detaljene
            $sql="SELECT * FROM admin WHERE id=$id";

            // 3. Utføre spørringen
            $res=mysqli_query($conn, $sql);

            // 4. Sjekk om spørringen er utført
            if($res==true)
            {
                // Sjekk om dataene er tilgjengelige
                $count = mysqli_num_rows($res);
                // Sjekk om vi har admin data
                if($count==1)
                {
                    // Få detaljene
                    $row=mysqli_fetch_assoc($res);

                    $full_navn = $row['full_navn'];
                    $brukernavn = $row['brukernavn'];

                }
                else
                {
                    // Omdirigere til Administrasjonsside
                    header('location:'.NETTSTEDURL.'/admin/admin.php');
                }
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Navn: </td>
                    <td>
                        <input type="text" name="full_navn" value="<?php echo $full_navn; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Brukernavn: </td>
                    <td>
                        <input type="text" name="brukernavn" value="<?php echo $brukernavn; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Oppdater Admin" class="btn-secondary">
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
        // Få alle verdiene fra form
        $id = $_POST['id'];
        $full_navn = $_POST['full_navn'];
        $brukernavn = $_POST['brukernavn'];

        // Lage en SQL-spørring for å oppdatere Admin
        $sql = "UPDATE admin SET
        full_navn = '$full_navn',
        brukernavn = '$brukernavn' 
        WHERE id='$id'
        ";

        // Utføre spørringen
        $res = mysqli_query($conn, $sql);

        // Sjekk om spørringen er utført
        if($res==true)
        {
            // Spørring utført og Admin oppdatert
            $_SESSION['update'] = "<div class='suksess'>Admin oppdatert.</div>";
            // Omdirigere til Administrasjonsside
            header('location:'.NETTSTEDURL.'/admin/admin.php');
        }
        else 
        {
            // Mislykket
            $_SESSION['update'] = "<div class='error'>Mislykket.</div>";
            // Omdirigere til Administrasjonsside
            header('location:'.NETTSTEDURL.'/admin/admin.php');
        }
    }
?>