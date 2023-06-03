<?php include('deler-front/meny.php'); ?>

<!-- Seksjonen for mat-søk starter her -->
<div class="background">
    <section class="mat-search text-center">
        <div class="container">
            <form action="<?php echo NETTSTEDURL; ?>mat-søk.php" method="POST">
                <input type="søk" name="søk" placeholder="Søk for mat.." required>
                <input type="submit" name="submit" value="Søk" class="btn btn-primary">
            </form>

        </div>
    </section>
</div>
<!-- Seksjonen for mat-søk slutter her -->



<!-- Matmeny-delen starter her -->
<section class="mat-meny">
    <div class="container">
        <h2 class="text-center">Mat Meny</h2>

        <?php
        // Vis Mat som er aktiv
        $sql = "SELECT * FROM mat WHERE aktiv='Ja'";

        // Utfør spørring
        $res = mysqli_query($conn, $sql);

        // Tell Rader
        $count = mysqli_num_rows($res);

        // Sjekk om mat er tilgjengelig
        if ($count > 0) {
            // Mat tilgjengelig
            while ($row = mysqli_fetch_assoc($res)) {
                // Hent Verdier
                $id = $row['id'];
                $tittel = $row['tittel'];
                $beskrivelse = $row['beskrivelse'];
                $pris = $row['pris'];
                $bilde_navn = $row['bilde_navn'];
                ?>

                <div class="mat-meny-box">
                    <div class="mat-meny-img">
                        <?php
                            // Sjekk om bilde er tilgjengelig
                            if($bilde_navn == "")
                            {
                                // Bilde ikke tilgjengelig
                            }
                            else {
                                // Bilde tilgjengelig
                                ?>
                                 <img src="<?php echo $NETTSTEDURL; ?>images/mat/<?php echo $bilde_navn; ?>" alt="<?php echo $tittel; ?>" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>

                    <div class="mat-meny-desc">
                        <h4><?php echo $tittel; ?></h4>
                        <p class="mat-pris"><?php echo $pris; ?></p>
                        <p class="mat-beskrivelse">
                            <?php echo $beskrivelse; ?>
                        </p>
                        <br>

                        <a href="<?php echo NETTSTEDURL; ?>order.php?mat_id=<?php echo $id; ?>" class="btn btn-primary">Bestill</a>
                    </div>
                </div>


                <?php
            }
        } 
        else 
        {
            // Bilde ikke tilgjengelig
            echo "<div class='error'>Bilde ikke tilgjengelig.</div>";
        }
        ?>

        <div class="clearfix"></div>



    </div>

</section>
<!-- Matmeny-delen slutter her -->

<?php include('deler-front/footer.php'); ?>