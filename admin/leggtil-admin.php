<?php include('deler/meny.php'); ?>

<div class="hoved-innhold">
    <div class="innpakning">
        <h1>Legg til Admin</h1>

        <br> <br>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Navn:</td>
                     <td><input type="text" name="full_navn" placeholder="Skriv inn navnet ditt"></td>
                </tr>
                <tr>
                    <td>Brukernavn: </td>
                    <td>
                        <input type="text" name="brukernavn" placeholder="Ditt brukernavn">
                    </td>
                </tr>
                <tr>
                    <td>Passord: </td>
                    <td>
                        <input type="password" name="passord" placeholder="Ditt passord">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Legg til Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('deler/footer.php'); ?>

<?php 
    // Behandle verdien fra form og lagre den i databasen

    // Sjekk om submit knappen er klikket

    if(isset($_POST['submit'])) // $_POST er en PHP super global variabel som brukes til å samle inn form-data etter å ha sendt inn et HTML-form med method="post"
    {
        // Knapp klikket
        //echo "Knapp klikket";

        // 1. Hente dataen fra form
        $full_navn = $_POST['full_navn'];
        $brukernavn = $_POST["brukernavn"];
        $passord = md5($_POST["passord"]); // Passordkryptering med MD5

        // 2. SQL Query for å lagre dataene i databasen
        $sql = "INSERT INTO admin SET
            full_navn='$full_navn',
            brukernavn='$brukernavn',
            passord='$passord'
        ";

        // 3. Utføre Query og lagre data i databasen
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. Sjekke om (Query er utført) dataene er satt inn eller ikke, og vis riktig melding
        if($res==TRUE)
        {
            // Data satt inn
            //echo "Data sendt inn";
            // Lage en økt-variabel for å vise meldingen
            $_SESSION['add'] = "Admin lagt til";
            // Omridigere side til Admin-siden 
            header("location:".NETTSTEDURL.'admin/admin.php'); // "." er sammenkobling (Concatenation) i PHP
        }
        else
        {
            // Klarte ikke å sende inn Data
            //echo "Klarte ikke å sende inn data";
            // Lage en økt-variabel for å vise meldingen
            $_SESSION['add'] = "Kunne ikke legge til Administrator";
            // Omridigere side til Legg-til Admin
            header("location:".NETTSTEDURL.'admin/leggtil-admin.php');

        }
    }
?>