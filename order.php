<?php include('deler-front/meny.php'); ?>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

    <?php
        // Sjekk om mat id er satt
        if(isset($_GET['mat_id']))
        {
            // Hent mat id
            $mat_id = $_GET['mat_id'];

            // Hent detaljer av valgt mat
            $sql = "SELECT * FROM mat WHERE id=$mat_id";
            // Utfør spørringen
            $res = mysqli_query($conn, $sql);
            // Tell Rader
            $count = mysqli_num_rows($res);
            // Sjekk om data er tilgjengelig
            if($count==1)
            {
                // Vi har Data
                $row = mysqli_fetch_assoc($res);

                $tittel = $row['tittel'];
                $pris = $row['pris'];
                $bilde_navn = $row['bilde_navn'];
            }
            else
            {
                // Mat ikke tilgjengelig
                // Omdirigere til Hjemmesiden
                header('location:'.NETTSTEDURL);
            }
        }
        else
        {
            // Omdirigere til hjemmesiden
            header('location:'.NETTSTEDURL);
        }
    ?>

    <!-- Seksjonen for mat-søk starter her -->
    <div class="background-order">
        <section class="mat-search">
            <div class="container">
                
                <h2 class="text-center text-white">Fyll ut dette skjemaet for å bekrefte bestillingen din.</h2>
    
                <form action="" method="POST" class="bestilling">
                    <fieldset> <!-- <fieldset>-taggen tegner en boks rundt de relaterte elementene. -->
                        <legend>Utvalgt mat</legend> <!-- <legend>-taggen definerer overskrift for fieldset-elementet. -->
    
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
                                    <img src="<?php echo NETTSTEDURL; ?>images/mat/<?php echo $bilde_navn; ?>" alt="Samosa" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
    
                        </div>
        
                        <div class="mat-meny-desc">
                            <h3><?php echo $tittel; ?></h3>
                            <input type="hidden" name="mat" value="<?php echo $tittel; ?>">

                            <p class="mat-pris"><?php echo $pris; ?> kr</p>
                            <input type="hidden" name="pris" value="<?php echo $pris; ?>">
    
                            <div class="bestilling-label">Kvantitet</div>
                            <input type="number" name="kvantitet" class="input-responsive" value="1" required>
                            
                        </div>
    
                    </fieldset>
                    
                    <fieldset>
                        <legend>Leveringsdetaljer</legend>
                        <div class="bestilling-label">Full Navn</div>
                        <input type="text" name="full-navn" placeholder="F.eks. Salahudin Ahmad" class="input-responsive" required>
    
                        <div class="bestilling-label">Telefonnummer</div>
                        <input type="tel" name="kontakt" placeholder="F.eks. +47 XXX XXX XXX" class="input-responsive" required>
    
                        <div class="bestilling-label">E-post</div>
                        <input type="email" name="epost" placeholder="F.eks. navn@eksempel.com" class="input-responsive" required>
    
                        <div class="bestilling-label">Adresse</div>
                        <textarea name="adresse" rows="10" placeholder="F.eks. Gate, by, land" class="input-responsive" required></textarea>
    
                        <input type="submit" name="submit" value="Bekreft bestilling" class="btn btn-primary">
                    </fieldset>
    
                </form>

                <?php 
                    // Sjekk om submit knapp er klikket
                    if(isset($_POST['submit']))
                    {
                        // Hent alle detaljene fra skjema
                        $mat = $_POST['mat'];
                        $pris = $_POST['pris'];
                        $kvantitet = $_POST['kvantitet'];

                        $total = $pris * $kvantitet; // Total = pris * kvantitet

                        $order_dato = date("Y-m-d H:i:s"); // Bestilling dato

                        $status = "Bestilt"; // Bestilt, ved levering, levert, avbrutt 

                        $kunde_navn = $_POST['full-navn'];
                        $kunde_kontakt = $_POST['kontakt'];
                        $kunde_epost = $_POST['epost'];
                        $kunde_adresse = $_POST['adresse'];

                        // Lagre bestilling i database
                        // Lag SQL-spørring  for å lagre data
                        $sql2 = "INSERT INTO bestilling SET
                            mat = '$mat',
                            pris = $pris,
                            kvantitet = $kvantitet,
                            total = $total,
                            order_dato = '$order_dato',
                            status = '$status',
                            kunde_navn = '$kunde_navn',
                            kunde_kontakt = '$kunde_kontakt',
                            kunde_epost = '$kunde_epost',
                            kunde_adresse = '$kunde_adresse'
                        ";

                        // Utfør spørringen
                        $res2 = mysqli_query($conn, $sql2);

                        // Sjekk om spørring er utført velykket
                        if($res2==true)
                        {
                            // Spørring utført og bestilling lagret
                            $_SESSION['order'] = "<div class='suksess text-center'>Bestilling plassert.</div>";
                            header('location:'.NETTSTEDURL);
                        }
                        else
                        {
                            // Kunne ikke lagre bestilling
                            $_SESSION['order'] = "<div class='error text-center'>Mislykket. Kunne ikke bestille mat.</div>";
                            header('location:'.NETTSTEDURL);
                        }
                    }
                ?>
    
            </div>
        </section>
    </div>
    <!-- Seksjonen for mat-søk slutter her -->

    <?php include('deler-front/footer.php'); ?>