<?php include('deler/meny.php'); ?> <!-- Vi kaller bare filen, og trenger ikke å skrive den samme koden. Dette gjør det lettere å administrere, det er bare hovedinnholdet som må endres. -->

        <!-- Hovedinnhold Seksjon Starter -->
        <div class="hoved-innhold">
            <div class="innpakning">
                <h1>Administrasjon</h1>

                <br />

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; // Viser økt-meldingen
                        unset($_SESSION['add']); // Fjerner økt-meldingen
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['bruker-ikke-funnet']))
                    {
                        echo $_SESSION['bruker-ikke-funnet'];
                        unset($_SESSION['bruker-ikke-funnet']);
                    }

                    if(isset($_SESSION['passord-stemmer-ikke']))
                    {
                        echo $_SESSION['passord-stemmer-ikke'];
                        unset($_SESSION['passord-stemmer-ikke']);
                    }

                    if(isset($_SESSION['endre-passord']))
                    {
                        echo $_SESSION['endre-passord'];
                        unset($_SESSION['endre-passord']);
                    }
                ?>
                <br><br><br>

                <!-- Knapp for å legge til Admin -->
                <a href="add-admin.php" class="btn-primary">Legg til Admin</a>

                <br /> <br /> <br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Navn</th>
                        <th>Brukernavn</th>
                        <th>Handlinger</th>
                    </tr>

                    <?php
                        // Spørring for å få alle Admin
                        $sql = "SELECT * FROM admin";
                        // Utføre spørringen
                        $res = mysqli_query($conn, $sql);

                        // Sjekke om spørringen er utført
                        if($res==TRUE)
                        {
                            // Tell rader for å sjekke om vi har data i databasen
                            $count = mysqli_num_rows($res); // Funksjon for å få alle radene i databasen

                            $sn=1; // Opprett en variabel og tilordne verdien

                            // Sjekk antall rader
                            if($count>0)
                            {
                                // Vi har data i databasen
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    // Bruker while-løkke for å få alle dataene fra databasen
                                    // While-løkken vil kjøre så lenge vi har data i databasen

                                    // Få individuelle data
                                    $id=$rows['id'];
                                    $full_navn=$rows['full_navn'];
                                    $brukernavn=$rows['brukernavn'];

                                    // Vise verdiene i tabellen
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_navn; ?></td>
                                        <td><?php echo $brukernavn; ?></td>
                                        <td>
                                            <a href="<?php echo NETTSTEDURL; ?>/admin/oppdater-passord.php?id=<?php echo $id; ?>" class="btn-primary">Endre Passord</a>
                                            <a href="<?php echo NETTSTEDURL; ?>/admin/oppdater-admin.php?id=<?php echo $id ?>" class="btn-secondary">Oppdater Admin</a>
                                            <a href="<?php echo NETTSTEDURL; ?>/admin/slett-admin.php?id=<?php echo $id; ?>" class="btn-danger">Slett Admin</a>
                                        </td>
                                    </tr>

                                    <?php

                                }
                            }
                            else
                            {
                                // Vi har ikke data i databasen
                            }
                        }
                    ?>

                </table>

            </div>
        </div>
        <!-- Hovedinnhold Seksjon Slutter -->

<?php include('deler/footer.php'); ?>