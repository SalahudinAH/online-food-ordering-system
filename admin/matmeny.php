<?php include('deler/meny.php'); ?>

<div class="hoved-innhold">
    <div class="innpakning">
        <h1>Administrer Mat</h1>

        <br /> <br />

        <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['unauthorize']))
            {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        
        
        ?>

        <br><br>

                <!-- Knapp for å legge til Admin -->
                <a href="<?php echo NETTSTEDURL; ?>admin/add-mat.php" class="btn-primary">Legg til Mat</a>

                <br /> <br /> <br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Tittel</th>
                        <th>Pris</th>
                        <th>Bilde</th>
                        <th>Utvalgte</th>
                        <th>Aktiv</th>
                        <th>Handlinger</th>
                    </tr>

                    <?php
                        // Lag SQL-spørring for å hente all Mat
                        $sql = "SELECT * FROM mat";

                        // Utfør spørringen
                        $res = mysqli_query($conn, $sql);

                        // Tell Rader for å sjekke om vi har mat
                        $count = mysqli_num_rows($res);

                        // Lag Serie Nummer Variabel og Angi Standard Verdi som 1
                        $sn=1;

                        if($count>0)
                        {
                            // Vi har mat i Databasen
                            // Hent Mat fra Databasen
                            while($row=mysqli_fetch_assoc($res))
                            {
                                // Hent verdiene fra individuelle kolonner
                                $id = $row['id'];
                                $tittel = $row['tittel'];
                                $pris = $row['pris'];
                                $bilde_navn = $row['bilde_navn'];
                                $utvalgte = $row['utvalgte'];
                                $aktiv = $row['aktiv'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?> </td>
                                    <td><?php echo $tittel; ?></td>
                                    <td><?php echo $pris; ?></td>
                                    <td>
                                        <?php 
                                            // Sjekk om vi har bilde
                                            if($bilde_navn == "")
                                            {
                                                // Vi har ikke bilde, vis Error Melding
                                                echo "<div class='error'>Bildet ikke lagt til.</div>";
                                            }
                                            else 
                                            {
                                                // Bilde er tilgjengelig, vis Bilde
                                                ?>
                                                <img src="<?php echo NETTSTEDURL; ?>images/mat/<?php echo $bilde_navn; ?>" width="150px";>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $utvalgte; ?></td>
                                    <td><?php echo $aktiv; ?></td>
                                    <td>
                                        <a href="<?php echo NETTSTEDURL; ?>admin/oppdater-mat.php?id=<?php echo $id; ?>" class="btn-secondary">Oppdater Mat</a>
                                        <a href="<?php echo NETTSTEDURL; ?>admin/slett-mat.php?id=<?php echo $id; ?>&bilde_navn=<?php echo $bilde_navn; ?>" class="btn-danger">Slett Mat</a>
                                    </td>
                                </tr>
                                
                                <?php
                            }
                            }
                            else 
                            {
                                // Mat ikke lagt til i Databasen
                                echo  "<tr> <td colspan='7' class='error'>Mat er ikke lagt til ennå.</td> </tr>";   
                            }
                    ?>
                </table>
    </div>
</div>

<?php include('deler/footer.php'); ?>