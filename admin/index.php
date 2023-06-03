<?php include('deler/meny.php'); ?>
<!-- Vi kaller bare filen, og trenger ikke å skrive den samme koden. Dette gjør det lettere å administrere, det er bare hovedinnholdet som må endres. -->

<!-- Hovedinnhold Seksjon Starter -->
<div class="hoved-innhold">
    <div class="innpakning">
        <h1>Dashboard</h1>
        <br><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <br><br>

        <div class="col-4 text-center">

            <?php
            $sql = "SELECT * FROM kategori";
            // Utfør spørringen
            $res = mysqli_query($conn, $sql);
            // Tell Rader
            $count = mysqli_num_rows($res);
            ?>

            <h1>
                <?php echo $count; ?>
            </h1>
            <br>
            Kategorier
        </div>

        <div class="col-4 text-center">

            <?php
            $sql2 = "SELECT * FROM mat";
            // Utfør spørringen
            $res2 = mysqli_query($conn, $sql2);
            // Tell Rader
            $count2 = mysqli_num_rows($res2);
            ?>

            <h1>
                <?php echo $count2; ?>
            </h1>
            <br>
            Mat
        </div>

        <div class="col-4 text-center">

            <?php
                $sql3 = "SELECT * FROM bestilling";
                // Utfør spørringen
                $res3 = mysqli_query($conn, $sql3);
                // Tell Rader
                $count3 = mysqli_num_rows($res3);
            ?>

            <h1>
                <?php echo $count3; ?>
            </h1>
            <br>
            Total Bestillinger
        </div>
        <div class="col-4 text-center">

            <?php
                // Lag SQL-spørring for å hente total generert inntekt
                // Aggregate funksjon i SQL
                $sql4 = "SELECT SUM(total) AS Total FROM bestilling WHERE status='Levert'";

                // Utfør spørringen
                $res4 = mysqli_query($conn, $sql4);

                // Hent verdien
                $row4 = mysqli_fetch_assoc($res4);

                // Hent den totale inntekten
                $total_inntekt = $row4['Total'];
            ?>

            <h1><?php echo $total_inntekt; ?> kr</h1>
            <br>
            Inntekt
        </div>

        <div class="clearfix"></div>

    </div>
</div>
<!-- Hovedinnhold Seksjon Slutter -->

<?php include('deler/footer.php'); ?>