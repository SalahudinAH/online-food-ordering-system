<?php include('deler/meny.php'); ?>

<div class="hoved-innhold">
    <div class="innpakning">
        <h1>Legg til Mat</h1>

        <br><br>

        <?php
        
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Tittel: </td>
                    <td>
                        <input type="text" name="tittel" placeholder="Tittel av Mat">
                    </td>
                </tr>

                <tr>
                    <td>Beskrivelse: </td>
                    <td>
                        <textarea name="beskrivelse" cols="30" rows="5" placeholder="Beskrivelse av Mat"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Pris: </td>
                    <td>
                        <input type="number" name="pris">
                    </td>
                </tr>

                <tr>
                    <td>Velg Bilde: </td>
                    <td>
                        <input type="file" name="bilde">
                    </td>
                </tr>

                <tr>
                    <td>Kategori: </td>
                    <td>
                        <select name="kategori">

                        <?php
                            // Lag PHP Kode for å vise kategorier fra Database
                            // 1. Lag SQL-spørring for å hente alle aktive kategorier fra database
                            $sql = "SELECT * FROM kategori WHERE aktiv='Ja'";

                            // Utfør spørring
                            $res = mysqli_query($conn, $sql);

                            // Tell Rader for å sjekke om vi har kategorier
                            $count = mysqli_num_rows($res);

                            // Hvis count er større enn null, vi har kategorier
                            if($count>0)
                            {
                                // Vi har kategorier
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    // Hent detaljene av kategorier
                                    $id = $row['id'];
                                    $tittel = $row['tittel'];
                                    
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $tittel; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                // Vi har ikke kategorier
                                ?>
                                 <option value="0">Ingen kategori funnet.</option>
                                <?php
                            }


                            // 2. Vis på Nedtrekksmeny
                        ?>

                        </select>
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
                        <input type="submit" name="submit" value="Legg til Mat" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php

            // Sjekk om knappen er klikket
            if(isset($_POST['submit']))
            {
                // Legg til Mat i Databasen
                // 1. Hente Data fra Skjema
                $tittel = $_POST['tittel'];
                $beskrivelse = $_POST['beskrivelse'];
                $pris = $_POST['pris'];
                $kategori = $_POST['kategori'];

                // Sjekk om radio knapp for utvalgt og aktiv er checked
                if(isset($_POST['utvalgte']))
                {
                    $utvalgte = $_POST['utvalgte'];
                }
                else
                {
                    $utvalgte = "Nei"; // Angi Standard Verdi
                }

                if(isset($_POST['submit']))
                {
                    $aktiv = $_POST['aktiv'];
                }
                else
                {
                    $aktiv = "Nei";
                }

                // 2. Last opp bilde hvis valgt
                // Sjekk om "Velg Bilde" er klikket
                if(isset($_FILES['bilde']['name']))
                {
                    // Hente detaljene av valgt bilde
                    $bilde_navn = $_FILES['bilde']['name'];

                    // Sjekk om bildet er valgt 
                    if($bilde_navn != "")
                    {
                        // Bilde er valgt
                        // Gi nytt navn på bilde
                        // Få utvidelsen av valgt bilde (jpg, png, gif) f.eks."salahudin-ahmad.jpg"
                        $utv = explode('.', $bilde_navn);
                        $utv = end($utv);

                        // Lag Nytt Navn for Bilde
                        $bilde_navn = "Mat-Navn-".rand(0000,9999).".".$utv; // Nytt Bilde Navn som "Mat-Navn-100.jpg"

                        // B. Last opp bilde
                        // Få kilde- og destinasjons path

                        // Kilde path er den nåværende lokasjonen av bilde
                        $src = $_FILES['bilde']['tmp_name'];

                        // Destinasjon path for bilde som skal lastes opp
                        $dst = "../images/mat/".$bilde_navn;

                        // Last opp mat bilde
                        $upload = move_uploaded_file($src, $dst);

                        // Sjekk om bilde er lastet opp
                        if($upload==false)
                        {
                            // Kunne ikke laste opp bilde
                            // Omdirigere til Matmeny med Error Melding
                            $_SESSION['upload'] = "<div class='error'>Mislykket. Kunne ikke laste opp bilde.</div>";
                            header('location:'.NETTSTEDURL.'admin/add-mat.php');
                            // Stopp prosess
                            die();
                        }
                    }

                }
                else
                {
                    $bilde_navn = "";
                }

                // 3. Sett inn i Database

                // Lag SQL-spørring for å legge til Mat
                // For numerisk verdi trenger vi ikke å bruke anførselstegn
                $sql2 = "INSERT INTO mat SET
                    tittel = '$tittel',
                    beskrivelse = '$beskrivelse',
                    pris = $pris,
                    bilde_navn = '$bilde_navn',
                    kategori_id = $kategori,
                    utvalgte = '$utvalgte',
                    aktiv = '$aktiv'
                ";

                // Utfør spørringen
                $res2 = mysqli_query($conn, $sql2);
                // Sjekk om Data er satt inn
                // 4. Omdirigere med Melding til Matmeny side
                if($res2 == true)
                {
                    // Data satt inn velykket
                    $_SESSION['add'] = "<div class='suksess'>Mat lagt til.</div>";
                    echo "<script>window.location.href = '".NETTSTEDURL."admin/matmeny.php';</script>";
                }
                else
                {
                    // Kunne ikke legge til Mat
                    $_SESSION['add'] = "<div class='error'>Mislykket. Kunne ikke legge til Mat.</div>";
                    echo "<script>window.location.href = '".NETTSTEDURL."admin/matmeny.php';</script>";
                }
                
            }

        ?>

    </div>
</div>

<?php include('deler/footer.php'); ?>