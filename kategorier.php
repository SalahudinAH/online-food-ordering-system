<?php include('deler-front/meny.php'); ?>

<!-- Kategorier-delen starter her -->
<section class="kategorier">
    <div class="container">
        <h2 class="text-center">Utforsk Mat</h2>

        <?php

        // Vis alle kategoriene som er aktiv
        // SQL-spørring
        $sql = "SELECT * FROM kategori WHERE aktiv='Ja'";

        // Utfør spørringen
        $res = mysqli_query($conn, $sql);

        // Tell Rader
        $count = mysqli_num_rows($res);

        // Sjekk om kategori er tilgjengelig
        if ($count > 0) {
            // Kategori er tilgjengelig
            while ($row = mysqli_fetch_assoc($res)) {
                // Hent verdiene
                $id = $row['id'];
                $titel = $row['tittel'];
                $bilde_navn = $row['bilde_navn'];
                ?>

                <a href="<?php echo NETTSTEDURL; ?>kategori-mat.php?kategori_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        if ($bilde_navn == "") {
                            // Bilde ikke tilgjengelig
                            echo "<div class='error'>Bildet ikke funnet.</div>";
                        } else {
                            // Bilde er tilgjengelig
                            ?>
                            <div class="box-shadow">
                                <img src="<?php echo NETTSTEDURL; ?>images/kategori/<?php echo $bilde_navn; ?>" alt="Samosa"
                                    class="img-responsive img-curve">
                            </div>
                        <?php
                        }
                        ?>

                        <h3 class="float-text text-white">
                            <?php echo $tittel; ?>
                        </h3>
                    </div>
                </a>

                <?php
            }
        } else {
            // Kategori ikke tilgjengelig
            echo "<div class='error'>Kategori ikke funnet.</div>";
        }

        ?>



        <div class="clearfix"></div>
    </div>
</section>
<!-- Kategorier-delen slutter her -->

<?php include('deler-front/footer.php'); ?>