<?php include('deler/meny.php'); ?>

<?php

    

    // Sjekk om ID er angitt
    if(isset($_GET['id']))
    {
        // Få alle detaljene
        $id = $_GET['id'];

        // SQL-Spørring for å få valgt mat
        $sql2 = "SELECT * FROM mat WHERE id=$id";
        // Utfør spørringen
        $res2 = mysqli_query($conn, $sql2);

        // Hent verdien basert på spørring utført
        $row2 = mysqli_fetch_assoc($res2);

        // Få de individuelle verdiene av valgt mat
        $tittel = $row2['tittel'];
        $beskrivelse = $row2['beskrivelse'];
        $pris = $row2['pris'];
        $gjeldende_bilde = $row2['bilde_navn'];
        $gjeldende_kategori = $row2['kategori_id'];
        $utvalgte = $row2['utvalgte'];
        $aktiv = $row2['aktiv'];
    }
    else 
    {
        // Omdirigere til Matmeny 
        header('location:'.NETTSTEDURL.'admin/matmeny.php');  
        exit();
    }
?>

<div class="hoved-innhold">
    <div class="innpakning">
        <h1>Oppdater Mat</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Tittel: </td>
                    <td>
                        <input type="text" name="tittel" value="<?php echo $tittel; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Beskrivelse: </td>
                    <td>
                        <textarea name="beskrivelse" cols="30" rows="5"><?php echo $beskrivelse; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Pris: </td>
                    <td>
                        <input type="number" name="pris" value="<?php echo $pris; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Gjeldende Bilde: </td>
                    <td>
                        <?php
                            if($gjeldende_bilde == "")
                            {
                                // Bilde ikke tilgjengelig
                                echo "<div class='error'>Bilde ikke tilgjengelig.</div>";
                            }
                            else 
                            {
                                // Bilde tilgjengelig   
                                ?>
                                <img src="<?php echo NETTSTEDURL; ?>images/mat/<?php echo $gjeldende_bilde; ?>" width="150px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Velg Nytt Bilde: </td>
                    <td>
                        <input type="file" name="bilde">
                    </td>
                </tr>

                <tr>
                    <td>Kategori: </td>
                    <td>
                        <select name="kategori">

                            <?php
                                // SQL-spørring for å hente Aktiv Kategorier
                                $sql = "SELECT * FROM kategori WHERE aktiv='Ja'";
                                // Utfør spørringen
                                $res = mysqli_query($conn, $sql);
                                // Tell Rader
                                $count = mysqli_num_rows($res);

                                // Sjekk om kategori er tilgjengelig
                                if($count>0)
                                {
                                    // Kategori tilgjengelig
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $kategori_tittel = $row['tittel'];
                                        $kategori_id = $row['id'];

                                        ?>
                                        <option <?php if($gjeldende_kategori==$kategori_id){echo "selected";} ?> value="<?php echo $kategori_id; ?>"><?php echo $kategori_tittel; ?></option>
                                        <?php
                                    }
                                }
                                else 
                                {
                                    // Kategori ikke tilgjengelig
                                    echo "<option value='0'>Kategori ikke tilgjengelig.</option>";    
                                }
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Utvalgte: </td>
                    <td>
                        <input <?php if($utvalgte=="Ja") {echo "checked";} ?> type="radio" name="utvalgte" value="Ja"> Ja
                        <input <?php if($utvalgte=="Nei") {echo "checked";} ?> type="radio" name="utvalgte" value="Nei"> Nei
                    </td>
                </tr>

                <tr>
                    <td>Aktiv: </td>
                    <td>
                        <input <?php if($aktiv=="Ja") {echo "checked";} ?> type="radio" name="aktiv" value="Ja"> Ja
                        <input <?php if($aktiv=="Nei") {echo "checked";} ?> type="radio" name="aktiv" value="Nei"> Nei 
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="gjeldende_bilde" value="<?php echo $gjeldende_bilde; ?>">
                        <input type="submit" name="submit" value="Oppdater Mat" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php
            if(isset($_POST['submit']))
            {
                // 1. Hente alle detaljene fra skjema
                $id = $_POST['id'];
                $tittel = $_POST['tittel'];
                $beskrivelse = $_POST['beskrivelse'];
                $pris = $_POST['pris'];
                $gjeldende_bilde = $_POST['gjeldende_bilde'];
                $kategori = $_POST['kategori'];
                $utvalgte = $_POST['utvalgte'];
                $aktiv = $_POST['aktiv'];

                // 2. Laste opp bilde hvis valgt
                
                // Sjekk om last opp knappen er klikket
                if(isset($_FILES['bilde']['name']))
                {
                    // Last opp knapp klikket
                    $bilde_navn = $_FILES['bilde']['name']; // Nytt bilde navn

                    // Sjekk om bilde filen er tilgjengelig
                    if($bilde_navn != "")
                    {
                        // Bilde er tilgjengelig
                        // A. Laster opp nytt bilde

                        // Gi nytt navn til bilde
                        $utv = explode('.', $bilde_navn);
                        $utv = end($utv);

                        $bilde_navn = "Mat-Navn-".rand(0000,9999).'.'.$utv; 

                        // Få kilde- og destinasjon path
                        $src_path = $_FILES['bilde']['tmp_name']; // Kilde path
                        $dest_path = "../images/mat/".$bilde_navn; // Destinasjon path

                        // Last opp bilde
                        $upload = move_uploaded_file($src_path, $dest_path);

                        // Sjekk om bilde er lastet opp 
                        if($upload==false)
                        {
                            // Mislykket
                            $_SESSION['upload'] = "<div class='error'>Mislykket. Kunne ikke laste opp nytt bilde.</div>";
                            // Omdirigere til Matmeny
                            header('location:'.NETTSTEDURL.'admin/matmeny.php');
                            // Stoppe prosessen
                            die();
                        }
                        
                        // B. Fjern gjeldende bilde hvis tilgjengelig
                        if($gjeldende_bilde != "")
                        {
                            // Bilde er tilgjengelig
                            // Fjern bilde
                            $remove_path = "../images/mat/".$gjeldende_bilde;

                            $remove = unlink($remove_path);

                            // Sjekk om bilde er fjernet
                            if($remove==false)
                            {
                                // Kunne ikke fjerne bilde
                                $_SESSION['remove-failed'] = "<div class='error'>Mislykket. Kunne ikke fjerne gjeldende bilde.</div>";
                                // Omdirigere til Matmeny 
                                header('location:'.NETTSTEDURL.'admin/matmeny.php');
                                // Stoppe prosessen
                                die();
                            }
                        }
                    }
                    else
                    {
                        $bilde_navn = $gjeldende_bilde; // Standard Bilde når bilde er valgt
                    }
                }
                else 
                {
                    $bilde_navn = $gjeldende_bilde; // Standard Bilde når knapp er ikke klikket
                }



                // 4. Oppdatere Mat i Databasen
                $sql3 = "UPDATE mat SET
                    tittel = '$tittel',
                    beskrivelse = '$beskrivelse',
                    pris = $pris,
                    bilde_navn = '$bilde_navn',
                    kategori_id = '$kategori',
                    utvalgte = '$utvalgte',
                    aktiv = '$aktiv'
                    WHERE id=$id
                ";

                // Utfør spørringen
                $res3 = mysqli_query($conn, $sql3);

                // Sjekk om spørringen er utført
                if($res3==true)
                {
                    // Spørring utført og mat oppdatert
                    $_SESSION['update'] = "<div class='suksess'>Mat Oppdatert.</div>";
                    echo "<script>window.location.href = '".NETTSTEDURL."admin/matmeny.php';</script>";
                }
                else 
                {
                    // Kunne ikke oppdatere
                    $_SESSION['update'] = "<div class='error'>Mislykket. Kunne ikke oppdatere mat.</div>";
                    echo "<script>window.location.href = '".NETTSTEDURL."admin/matmeny.php';</script>";
                }

            }
        ?>
    </div>
</div>

<?php include('deler/footer.php'); ?>
