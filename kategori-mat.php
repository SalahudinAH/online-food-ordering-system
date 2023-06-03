<?php include('deler-front/meny.php'); ?>

<?php
// Sjekk om ID er satt
if (isset($_GET['kategori_id'])) {
    // Kategori ID er bestått, hent ID
    $kategori_id = $_GET['kategori_id'];
    // Hent Kategori tittel basert på kategori ID
    $sql = "SELECT tittel FROM kategori WHERE id=$kategori_id";

    // Utfør spørringen
    $res = mysqli_query($conn, $sql);

    // Hent verdien fra Databasen
    $row = mysqli_fetch_assoc($res);
    // Hent tittel
    $kategori_tittel = $row['tittel'];
} else {
    // Kategori ikke bestått 
    // Omdirigiere til Hjemmeside
    header('location:' . NETTSTEDURL);
}
?>

<!-- Seksjonen for mat-søk starter her -->
<section class="mat-søk text-center">
    <div class="container">

        <h2>Mat på søket ditt <a href="#">"<?php echo $kategori_tittel; ?>"</a></h2>

    </div>
</section>
<!-- Seksjonen for mat-søk slutter her -->

<!-- Matmeny-delen starter her -->
<section class="mat-meny">
    <div class="container">
        <h2 class="text-center">Mat Meny</h2>

        <?php

        // Lag SQL-spørring for å hente mat basert på valgt kategori
        $sql2 = "SELECT * FROM mat WHERE kategori_id=$kategori_id";

        // Utfør spørringen
        $res2 = mysqli_query($conn, $sql2);

        // Tell Rader
        $count2 = mysqli_num_rows($res2);

        // Sjekk om mat er tilgjengelig
        if ($count2 > 0) {
            // Mat er tilgjengelig
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2['id'];
                $tittel = $row2['tittel'];
                $pris = $row2['pris'];
                $beskrivelse = $row2['beskrivelse'];
                $bilde_navn = $row2['bilde_navn'];
                ?>

                <div class="mat-meny-box">
                    <div class="mat-meny-img">
                        <?php
                            if($bilde_navn == "")
                            {
                                // Bilde ikke tilgjengelig
                                echo "<div class='error'>Bilde ikke tilgjengelig.</div>";
                            }
                            else
                            {
                                // Bilde tilgjengelig
                                ?>
                                <img src="<?php echo $NETTSTEDURL; ?>images/mat/<?php echo $bilde_navn; ?>" alt="<?php echo $tittel; ?>" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>

                    <div class="mat-meny-desc">
                        <h4><?php echo $tittel; ?></h4>
                        <p class="mat-pris"><?php echo $pris; ?> kr</p>
                        <p class="mat-beskrivelse">
                            <?php echo $beskrivelse; ?>
                        </p>
                        <br>

                        <a href="<?php echo NETTSTEDURL; ?>order.php?mat_id=<?php echo $id; ?>" class="btn btn-primary">Bestill</a>
                    </div>
                </div>

                <?php
            }

        } else {
            // Mat ikke tilgjengelig
            echo "<div class='error'>Mat ikke tilgjengelig.</div>";
        }

        ?>


        <div class="clearfix"></div>



    </div>

</section>
<!-- Matmeny-delen slutter her -->

<?php include('deler-front/footer.php'); ?>