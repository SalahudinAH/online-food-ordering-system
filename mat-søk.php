<?php include('deler-front/meny.php'); ?>

<!-- Seksjonen for mat-søk starter her -->
<section class="mat-søk text-center">
    <div class="container">

    <?php

        // Hent Søkeord
        $søk = $_POST['søk'];

    ?>

        <h2>Mat på søket ditt <a href="#">"<?php echo $søk; ?>"</a></h2>

    </div>
</section>
<!-- Seksjonen for mat-søk slutter her -->



<!-- Matmeny-delen starter her -->
<section class="mat-meny">
    <div class="container">
        <h2 class="text-center">Mat Meny</h2>

        <?php

            // SQL-spørring for å hente mat basert på søkeord
            $sql = "SELECT * FROM mat WHERE tittel LIKE '%$søk%' OR beskrivelse LIKE '%$søk%'";

            // Utfør spørringen
            $res = mysqli_query($conn, $sql);

            // Tell Rader
            $count = mysqli_num_rows($res);

            // Sjekk om mat er tilgjengelig
            if ($count > 0) {
                // Mat tilgjengelig
                while ($row = mysqli_fetch_assoc($res)) {
                    // Hent detaljer
                    $id = $row['id'];
                    $tittel = $row['tittel'];
                    $pris = $row['pris'];
                    $beskrivelse = $row['beskrivelse'];
                    $bilde_navn = $row['bilde_navn'];
                    ?>

                    <div class="mat-meny-box">
                        <div class="mat-meny-img">
                            <?php
                                // Sjekk om bilde er tilgjengelig
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

                            <a href="#" class="btn btn-primary">Bestill</a>
                        </div>
                    </div>

                    <?php
                }
            } 
            else 
            {
                // Mat ikke tilgjengelig
                echo "<div class='error'>Mat ikke funnet.</div>";
            }

        ?>


        <div class="clearfix"></div>



    </div>

</section>
<!-- Matmeny-delen slutter her -->

<?php include('deler-front/footer.php'); ?>