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

<?php
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>

<!-- Kategorier-delen starter her -->
<section class="kategorier">
    <div class="container">
        <h2 class="text-center">Utforsk Mat</h2>

        <?php
        // Lag SQL-spørring for å vise kategorier fra Databasen
        $sql = "SELECT * FROM kategori WHERE aktiv='Ja' AND utvalgte='Ja' LIMIT 3";
        // Utfør spørringen
        $res = mysqli_query($conn, $sql);
        // Tell rader for å sjekke om kategori er tilgjengelig
        $count = mysqli_num_rows($res);

        if ($count > 0) {

            // Kategorier tilgjengelig
            while ($row = mysqli_fetch_assoc($res)) {
                // Hent verdiene som id, tittel, bilde_navn
                $id = $row['id'];
                $tittel = $row['tittel'];
                $bilde_navn = $row['bilde_navn'];
                ?>

                <a href="<?php echo NETTSTEDURL; ?>kategori-mat.php?kategori_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        // Sjekk om bilde er tilgjengelig
                        if ($bilde_navn == "") {
                            // Bilde ikke tilgjengelig
                            echo "<div class='error'>Bilde ikke tilgjengelig.</div>";
                        } else {
                            // Bildet er tilgjengelig
                            ?>
                            <div class="box-shadow">
                                <img src="<?php echo NETTSTEDURL; ?>images/kategori/<?php echo $bilde_navn; ?>" alt="<?php echo $tittel; ?>" class="img-responsive img-curve">
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
            // Kategorier ikke tilgjengelig
            echo "<div class='error'>Kategori ikke lagt til.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Kategorier-delen slutter her -->

<!-- Matmeny-delen starter her -->
<section class="mat-meny">
    <div class="container">
        <h2 class="text-center">Meny</h2>

        <?php
        // Hente Mat som er aktiv og utvalgt fra Databasen
        // SQL-spørring
        $sql2 = "SELECT * FROM mat WHERE aktiv='Ja' AND utvalgte='Ja' LIMIT 6";

        // Utfør spørringen
        $res2 = mysqli_query($conn, $sql2);

        // Tell Rader
        $count2 = mysqli_num_rows($res2);

        // Sjekk om Mat er tilgjengelig
        if ($count > 0) {
            // Mat tilgjenglig
            while ($row = mysqli_fetch_assoc($res2)) {
                // Hent alle verdiene
                $id = $row['id'];
                $tittel = $row['tittel'];
                $pris = $row['pris'];
                $beskrivelse = $row['beskrivelse'];
                $bilde_navn = $row['bilde_navn'];
                ?>

                <div class="mat-meny-box">
                    <div class="mat-meny-img">
                        <?php
                            // Sjekk om bildet er tilgjengelig
                            if($bilde_navn == "")
                            {
                                // Bilde ikke tilgjengelig
                                echo "<div class='error'>Bilde ikke tilgjengelig.</div>";
                            }
                            else
                            {
                                // Bilde tilgjengelig
                                ?>
                                <img src="<?php echo NETTSTEDURL; ?>images/mat/<?php echo $bilde_navn; ?>" alt="<?php echo $tittel; ?>" class="img-responsive img-curve">
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

    <p class="text-center">
        <a href="<?php echo NETTSTEDURL; ?>mat.php">Se alle matvarer</a>
    </p>
</section>
<!-- Matmeny-delen slutter her -->

<?php include('deler-front/footer.php'); ?>