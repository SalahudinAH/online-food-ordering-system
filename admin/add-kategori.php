<?php include('deler/meny.php'); ?>

<div class="hoved-innhold">
    <div class="innpakning">
        <h1>Legg til Kategori</h1>

        <br><br>

        <?php 

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>

        <br><br>

        <!-- Legg til Kategori Skjema Starter -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Tittel: </td>
                    <td>
                        <input type="text" name="tittel" placeholder="Kategori Tittel">
                    </td>
                </tr>

                <tr>
                    <td>Velg Bilde: </td>
                    <td>
                        <input type="file" name="bilde">
                    </td>
                </tr>

                <tr>
                    <td>Utvalgte: </td>
                    <td>
                        <input type="radio" name="utvalgte" value="Ja"> Ja
                        <input type="radio" name="utvalgte" value="Nei"> Nei
                    </td>
                </tr>

                <tr>
                    <td>Aktiv: </td>
                    <td>
                        <input type="radio" name="aktiv" value="Ja"> Ja
                        <input type="radio" name="aktiv" value="Nei"> Nei
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Legg til Kategori" class="btn-secondary"> 
                    </td>
                </tr>
            </table>

        </form>
        <!-- Legg til Kategori Skjema Slutter -->

        <?php 

            // Sjekk om submit-knappen er klikket
            if(isset($_POST['submit']))
            {

                // 1. Hente verdier fra skjema
                $tittel = $_POST['tittel'];

                // For Radio input, trenger vi å sjekke om knappen er valgt 
                if(isset($_POST['utvalgte']))
                {
                    $utvalgte = $_POST['utvalgte'];
                }
                else 
                {
                    // Set Standard verdi
                    $utvalgte = "Nei";
                }

                if(isset($_POST['aktiv']))
                {
                    $aktiv = $_POST['aktiv'];
                }
                else 
                {
                    $aktiv = "Nei";
                }

                // Sjekk om bilde er valgt og angi verdien på bildenavnet deretter
                if(isset($_FILES['bilde']['name']))
                {
                    // Last opp bilde
                    // For å laste opp bilde trenger vi bildenavn, kilde- og mål destinasjon 
                    $bilde_navn = $_FILES['bilde']['name'];

                    // Last opp bilde bare hvis bilde er valgt
                    if($bilde_navn != "")
                    {

                        // Endre navn på bilde automatisk
                        // Få utvidelsen av bilde vårt (jpg, png, gif) f.eks. "mat1.jpg"
                        $utv = explode('.', $bilde_navn);
                        $utv = end($utv);

                        // Gi nytt navn til bilde
                        $bilde_navn = "Mat_Kategori_".rand(000, 999).'.'.$utv; // f.eks. "Mat_Kategori_750.jpg"

                        $source_path = $_FILES['bilde']['tmp_name'];

                        $destination_path = "../images/kategori/".$bilde_navn;

                        // Sist, last opp bilde
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Sjekk om bilde ble lastet opp
                        if($upload==false)
                        {
                            // Angi melding
                            $_SESSION['upload'] = "<div class='error'>Mislykket. Kunne ikke laste opp bilde.</div>";
                            // Omdirigere side til add-kategori
                            header('location:'.NETTSTEDURL.'admin/add-kategori.php');
                            // Stop prosessen
                            die();
                        }
                    }
                }
                else 
                {
                    // Ikke last opp bilde og angi verdi for bildenavn som tom
                    $bilde_navn="";
                }

                // 2. Lage SQL-spørring for å sette inn Kategori i Database
                $sql = "INSERT INTO kategori SET
                    tittel='$tittel',
                    bilde_navn='$bilde_navn',
                    utvalgte='$utvalgte',
                    aktiv='$aktiv'
                ";

                // 3. Utfør spørringen og Lagre i Database
                $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                // 4. Sjekk om spørringen er utført
                if($res==TRUE)
                {
                    // Spørring utført og Kategori legget til
                    $_SESSION['add'] = "<div class='suksess'>Kategori lagt til.</div>";
                    // Omdirigere side til Kategori-siden
                    header("location:".NETTSTEDURL.'/admin/kategori.php');
                }
                else 
                {
                    // Mislykket å legge til Kategori
                    $_SESSION['add'] = "<div class='error'>Mislykket.</div>";
                    // Omdirigere side til Kategori-siden
                    header("location:".NETTSTEDURL.'/admin/kategori.php');

                }
            }

        ?>
    </div>
</div>

<?php include('deler/footer.php'); ?>