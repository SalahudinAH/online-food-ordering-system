<?php include('deler/meny.php'); ?>

<div class="hoved-innhold">
    <div class="innpakning">
        <h1>Administrer Kategorier</h1>

        <br /> <br />
        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }

        ?>
        <br><br>

                <!-- Knapp for å legge til Kategori -->
                <a href="<?php echo NETTSTEDURL; ?>admin/add-kategori.php" class="btn-primary">Legg til Kategori</a>

                <br /> <br /> <br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Tittel</th>
                        <th>Bilde</th>
                        <th>Utvalgte</th>
                        <th>Aktiv</th>
                        <th>Handlinger</th>
                    </tr>

                    <?php 

                        // Spørring for å få alle kategorier fra database
                        $sql = "SELECT * FROM kategori";

                        // Utfør spørring
                        $res = mysqli_query($conn, $sql);

                        // Tell Rader
                        $count = mysqli_num_rows($res);

                        // Lag Serie Nummer Variabel og angi verdien som 1
                        $sn=1;

                        // Sjekk om vi har data i databasen
                        if($count>0)
                        {
                            // Vi har data i databasen
                            // Hent data og fremvis
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $tittel = $row['tittel'];
                                $bilde_navn = $row['bilde_navn'];
                                $utvalgte = $row['utvalgte'];
                                $aktiv = $row['aktiv'];

                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $tittel; ?></td>

                                        <td>

                                            <?php
                                                // Sjekk om bildenavn er tilgjengelig
                                                if($bilde_navn!="")
                                                {
                                                    // Vis Bilde
                                                    ?>

                                                    <img src="<?php echo NETTSTEDURL; ?>images/kategori/<?php echo $bilde_navn; ?>" width="150px">

                                                    <?php
                                                }
                                                else 
                                                {
                                                    // Vis melding
                                                    echo "<div class='error'>Bilde ikke lagt til.</div>";   
                                                }
                                            ?>

                                        </td>

                                        <td><?php echo $utvalgte; ?></td>
                                        <td><?php echo $aktiv; ?></td>
                                        <td>
                                            <a href="<?php echo NETTSTEDURL ?>admin/oppdater-kategori.php?id=<?php echo $id; ?>" class="btn-secondary">Oppdater Kategori</a>
                                            <a href="<?php echo NETTSTEDURL ?>admin/slett-kategori.php?id=<?php echo $id; ?>&bilde_navn=<?php echo $bilde_navn; ?>" class="btn-danger">Slett Kategori</a>
                                        </td>
                                    </tr>

                                <?php
                            }
                        }
                        else 
                        {
                            // Vi har ikke data 
                            // Vi vil vise meldingen i tabellen
                            ?>

                            <tr>
                                <td colspan="6"><div class="error">Ingen Kategori lagt til.</div></td>
                            </tr>

                            <?php    
                        }
                    
                    ?>

                </table>
    </div>
</div>

<?php include('deler/footer.php'); ?>
