<?php include('deler/meny.php'); ?>

<div class="hoved-innhold">
    <div class="innpakning">
        <h1>Oppdater Kategori</h1>

        <br><br>

        <?php

            // Sjekk om id er angitt
            if(isset($_GET['id']))
            {
                // Hent ID og alle andre detaljer
                $id = $_GET['id'];
                // Lag SQL-spørring for å hente alle andre detaljer
                $sql = "SELECT * FROM kategori WHERE id=$id";
                
                // Utfør spørringen
                $res = mysqli_query($conn, $sql);

                // Telle radene for å sjekke om ID er gyldig
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    // Hent all Data
                    $row = mysqli_fetch_assoc($res);
                    $tittel = $row['tittel'];
                    $gjeldende_bilde = $row['bilde_navn'];
                    $utvalgte = $row['utvalgte'];
                    $aktiv = $row['aktiv'];
                }
                else 
                {
                    // Omdirigere til Kategori-siden med session melding
                    $_SESSION['no-category-found'] = "<div class='error'>Kategori ikke funnet.</div>";
                    header('location:'.NETTSTEDURL.'admin/kategori.php');    
                }
            }
            else 
            {
                // Omdirigere til Kategori-siden    
                header('location:'.NETTSTEDURL.'admin/kategori.php');
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            
            <table class="tbl-30">
                <tr>
                    <td>Tittel: </td>
                    <td>
                        <input type="text" name="tittel" value="<?php echo $tittel; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Gjeldende Bilde: </td>
                    <td>
                        <?php
                            if($gjeldende_bilde != "")
                            {
                                // Vise Bilde
                                ?>
                                <img src="<?php echo NETTSTEDURL; ?>images/kategori/<?php echo $gjeldende_bilde; ?>" width="150px">
                                <?php
                            }
                            else 
                            {
                                // Vise Melding
                                echo "<div class='error'>Bildet ikke lagt til.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Nytt Bilde: </td>
                    <td>
                        <input type="file" name="bilde">
                    </td>
                </tr>

                <tr>
                    <td>Utvalgte: </td>
                    <td>
                        <input <?php if($utvalgte=="Ja"){echo "checked";} ?> type="radio" name="utvalgte" value="Ja"> Ja
                        
                        <input <?php if($utvalgte=="Nei"){echo "checked";} ?> type="radio" name="utvalgte" value="Nei"> Nei
                    </td>
                </tr>

                <tr>
                    <td>Aktiv: </td>
                    <td>
                        <input <?php if($utvalgte=="Ja"){echo "checked";} ?> type="radio" name="aktiv" value="Ja"> Ja
                        <input <?php if($utvalgte=="Nei"){echo "checked";} ?> type="radio" name="aktiv" value="Nei"> Nei
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="gjeldende_bilde" value="<?php echo $gjeldende_bilde; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Oppdater Kategori" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                // 1. Hent alle verdiene fra skjema
                
                $id = $_POST['id'];
                $tittel = $_POST['tittel'];
                $gjeldende_bilde = $_POST['gjeldende_bilde'];
                $utvalgte = $_POST['utvalgte'];
                $aktiv = $_POST['aktiv'];

                // 2. Oppdatere Nytt Bilde hvis valgt
                // Sjekk om bilde er valgt
                if(isset($_FILES['bilde']['name']))
                {
                    // Hent Bilde Detaljer
                    $bilde_navn = $_FILES['bilde']['name'];

                    // Sjekk om bilde er tilgjengelig 
                    if($bilde_navn != "")
                    {
                        // Bilde er tilgjengelig
                        // A. Laste opp det nye bilde

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
                            // Omdirigere til leggtil-kategori-siden
                            header('location:'.NETTSTEDURL.'admin/kategori.php');
                            // Stop prosessen
                            die();
                        }

                        // B. Fjerne det Gjeldende Bilde hvis tilgjengelig
                        if($gjeldende_bilde != "")
                        {
                            $remove_path = "../images/kategori/".$gjeldende_bilde;

                            $remove = unlink($remove_path);

                            // Sjekk om bilde er fjernet 
                            // Hvis bilde er ikke fjernet, vis melding og stopp prosessen
                            if($remove==false)
                            {
                                // Mislykket å fjerne bilde
                                $_SESSION['failed-remove'] = "<div class='error'>Mislykket. Kunne ikke fjerne gjeldende bilde.</div>";
                                header('location:'.NETTSTEDURL.'admin/kategori.php');
                                die();
                            }
                        }
                    }
                    else 
                    {
                        $bilde_navn = $gjeldende_bilde;    
                    }
                }
                else 
                {
                    $bilde_navn = $gjeldende_bilde;   
                }

                // 3. Oppdater databasen
                $sql2 = "UPDATE kategori SET 
                    tittel = '$tittel',
                    bilde_navn = '$bilde_navn',
                    utvalgte = '$utvalgte',
                    aktiv = '$aktiv'
                    WHERE id=$id
                ";

                // Utfør spørringen
                $res2 = mysqli_query($conn, $sql2);

                // 4. Omdirigere til Kategori-siden med Melding
                // Sjekk om spørringen er utført
                if($res2==true)
                {
                    // Kategori Oppdatert
                    $_SESSION['update'] = "<div class='suksess'>Kategori Oppdatert.</div>";
                    header('location:'.NETTSTEDURL.'admin/kategori.php');
                }
                else 
                {
                 // Mislykket
                 $_SESSION['update'] = "<div class='error'>Mislykket.</div>";
                 header('location:'.NETTSTEDURL.'admin/kategori.php');
                }
            }

        ?>

    </div>
</div>