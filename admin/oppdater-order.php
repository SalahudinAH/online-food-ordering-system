<?php include('deler/meny.php') ?>

<div class="hoved-innhold">
    <div class="innpakning">
        <h1>Oppdater Bestilling</h1>
        <br><br>


        <?php

            // Sjekk om id er satt
            if(isset($_GET['id']))
            {
                // Hent bestilling detaljer
                $id = $_GET['id'];

                // Få alle detaljer basert på id
                // SQL-spørring for å hente bestilling detaljer
                $sql = "SELECT * FROM bestilling WHERE id=$id";
                // Utfør spørringen
                $res = mysqli_query($conn, $sql);
                // Tell Rader
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    // Detaljer tilgjengelig
                    $row = mysqli_fetch_assoc($res);

                    $mat = $row['mat'];
                    $pris = $row['pris'];
                    $kvantitet = $row['kvantitet'];
                    $status = $row['status'];
                    $kunde_navn = $row['kunde_navn'];
                    $kunde_kontakt = $row['kunde_kontakt'];
                    $kunde_epost = $row['kunde_epost'];
                    $kunde_adresse = $row['kunde_adresse'];
                }
                else
                {
                    // Detaljer ikke tilgjengelig
                    // Omdirigere til Order side
                    header('location'.NETTSTEDURL.'admin/order.php');
                }
            }
            else
            {
                // Omdirigere til Order side
                header('location:'.NETTSTEDURL.'admin/order.php');
            }

        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Mat Navn</td>
                    <td><b><?php echo $mat; ?></b></td>
                </tr>

                <tr>
                    <td>Pris</td>
                    <td>
                        <b><?php echo $pris; ?> kr</b>
                    </td>
                </tr>

                <tr>
                    <td>Kvantitet</td>
                    <td>
                        <input type="number" name="kvantitet" value="<?php echo $kvantitet; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Bestilt"){echo "selected";} ?> value="Bestilt">Bestilt</option>
                            <option <?php if($status=="Ved Levering"){echo "selected";} ?> value="Ved Levering">Ved Levering</option>
                            <option <?php if($status=="Levert"){echo "selected";} ?> value="Levert">Levert</option>
                            <option <?php if($status=="Avbrutt"){echo "selected";} ?> value="Avbrutt">Avbrutt</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Kunde Navn: </td>
                    <td>
                        <input type="text" name="kunde_navn" value="<?php echo $kunde_navn ?>">
                    </td>
                </tr>

                <tr>
                    <td>Kunde Kontakt: </td>
                    <td>
                        <input type="text" name="kunde_kontakt" value="<?php echo $kunde_kontakt ?>">
                    </td>
                </tr>

                <tr>
                    <td>Kunde Epost: </td>
                    <td>
                        <input type="text" name="kunde_epost" value="<?php echo $kunde_epost; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Kunde Adresse: </td>
                    <td>
                        <textarea name="kunde_adresse" cols="30" rows="5"><?php echo $kunde_adresse; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="pris" value="<?php echo $pris; ?>">
                        <input type="submit" name="submit" value="Oppdater Bestilling" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
            // Sjekk om submit knapp er trykket
            if(isset($_POST['submit']))
            {
                // Hent alle verdiene fra skjema
                $id = $_POST['id'];
                $pris = $_POST['pris'];
                $kvantitet = $_POST['kvantitet'];

                $total = $pris * $kvantitet;

                $status = $_POST['status'];

                $kunde_navn = $_POST['kunde_navn'];
                $kunde_kontakt = $_POST['kunde_kontakt'];
                $kunde_epost = $_POST['kunde_epost'];
                $kunde_adresse = $_POST['kunde_adresse'];

                // Oppdater verdiene
                $sql2 = "UPDATE bestilling SET
                    kvantitet = $kvantitet,
                    total = $total,
                    status = '$status',
                    kunde_navn = '$kunde_navn',
                    kunde_kontakt = '$kunde_kontakt',
                    kunde_epost = '$kunde_epost',
                    kunde_adresse = '$kunde_adresse'
                    WHERE id=$id
                ";

                // Utfør spørringen
                $res2 = mysqli_query($conn, $sql2);

                // Sjekk om oppdatert
                if($res2==true)
                {
                    // Oppdatert
                    $_SESSION['update'] = "<div class='suksess'>Bestilling Oppdatert.</div>";
                    header('location:'.NETTSTEDURL.'admin/order.php');
                }
                else
                {
                    // Mislykket 
                    $_SESSION['update'] = "<div class='error'>Mislykket. Kunne ikke oppdatere bestilling.</div>";
                    header('location:'.NETTSTEDURL.'admin/order.php');
                }

                // Omdirigere til Order siden med Melding
            }
        ?>

    </div>
</div>

<?php include('deler/footer.php') ?>