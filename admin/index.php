<?php include('deler/meny.php'); ?> <!-- Vi kaller bare filen, og trenger ikke å skrive den samme koden. Dette gjør det lettere å administrere, det er bare hovedinnholdet som må endres. -->

        <!-- Hovedinnhold Seksjon Starter -->
        <div class="hoved-innhold">
            <div class="innpakning">
                <h1>Dashboard</h1>
                <br><br>
                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>

                <div class="col-4 text-center">
                    <br>
                    <h1>5</h1>
                    Kategorier
                </div>
                <div class="col-4 text-center">
                    <br>
                    <h1>5</h1>
                    Kategorier
                </div>
                <div class="col-4 text-center">
                    <br>
                    <h1>5</h1>
                    Kategorier
                </div>
                <div class="col-4 text-center">
                    <br>
                    <h1>5</h1>
                    Kategorier
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Hovedinnhold Seksjon Slutter -->

<?php include('deler/footer.php'); ?>