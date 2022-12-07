<?php include('deler/meny.php'); ?> <!-- Vi kaller bare filen, og trenger ikke å skrive den samme koden. Dette gjør det lettere å administrere, det er bare hovedinnholdet som må endres. -->

        <!-- Hovedinnhold Seksjon Starter -->
        <div class="hoved-innhold">
            <div class="innpakning">
                <h1>Administrasjon</h1>

                <br />

                <?php
                    if(isset($_SESSION['ADD']))
                    {
                        echo $_SESSION['add']; // Viser økt-melding
                        unset($_SESSION['add']); // Fjerner økt-melding
                    }
                ?>
                <br><br><br>

                <!-- Knapp for å legge til Admin -->
                <a href="leggtil-admin.php" class="btn-primary">Legg til Admin</a>

                <br /> <br /> <br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Navn</th>
                        <th>Brukernavn</th>
                        <th>Handlinger</th>
                    </tr>

                    <tr>
                        <td>1. </td>
                        <td>Salahudin Ahmad</td>
                        <td>salahudin123</td>
                        <td>
                            <a href="#" class="btn-secondary">Oppdater Admin</a>
                            <a href="#" class="btn-danger">Slett Admin</a>
                        </td>
                    </tr>

                    <tr>
                        <td>2. </td>
                        <td>Salahudin Ahmad</td>
                        <td>salahudin123</td>
                        <td>
                            <a href="#" class="btn-secondary">Oppdater Admin</a>
                            <a href="#" class="btn-danger">Slett Admin</a>
                        </td>
                    </tr>

                    <tr>
                        <td>3. </td>
                        <td>Salahudin Ahmad</td>
                        <td>salahudin123</td>
                        <td>
                            <a href="#" class="btn-secondary">Oppdater Admin</a>
                            <a href="#" class="btn-danger">Slett Admin</a>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
        <!-- Hovedinnhold Seksjon Slutter -->

<?php include('deler/footer.php'); ?>