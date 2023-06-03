<?php include('deler/meny.php'); ?>

<div class="hoved-innhold">
    <div class="innpakning">
        <h1>Administrer Bestilling</h1>

        <br /> <br /> <br />

        <?php
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Mat</th>
                <th>Pris</th>
                <th>Kvantitet</th>
                <th>Total</th>
                <th>Bestilling Dato</th>
                <th>Status</th>
                <th>Kunde Navn</th>
                <th>Kontakt</th>
                <th>Epost</th>
                <th>Adresse</th>
                <th>Handlinger</th>
            </tr>

            <?php
            // Hent alle bestillinger fra database
            $sql = "SELECT * FROM bestilling ORDER BY id DESC"; // Vis siste bestilling først
            // Utfør spørringen
            $res = mysqli_query($conn, $sql);
            // Tell Rader
            $count = mysqli_num_rows($res);

            $sn = 1; // Lag en Serie Nummer og angi første verdi som 1

            if ($count > 0) {
                // Bestilling tilgjengelig
                while ($row = mysqli_fetch_assoc($res)) {
                    // Hente alle bestilling detaljer
                    $id = $row['id'];
                    $mat = $row['mat'];
                    $pris = $row['pris'];
                    $kvantitet = $row['kvantitet'];
                    $total = $row['total'];
                    $order_dato = $row['order_dato'];
                    $status = $row['status'];
                    $kunde_navn = $row['kunde_navn'];
                    $kunde_kontakt = $row['kunde_kontakt'];
                    $kunde_epost = $row['kunde_epost'];
                    $kunde_adresse = $row['kunde_adresse'];

                    ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $mat; ?></td>
                        <td><?php echo $pris; ?></td>
                        <td><?php echo $kvantitet; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $order_dato; ?></td>

                        <td>
                            <?php 
                                // Bestilt, Ved Levering, Levert, Avbrutt
                                if($status=="Bestilt")
                                {
                                    echo "<label>$status</label>";
                                }
                                elseif($status=="Ved Levering")
                                {
                                    echo "<label style='color: orange'>$status</label>";
                                }
                                elseif($status=="Levert")
                                {
                                    echo "<label style='color: green'>$status</label>";
                                }
                                elseif($status=="Avbrutt")
                                {
                                    echo "<label style='color: red'>$status</label>";
                                }
                            ?>
                        </td>

                        <td><?php echo $kunde_navn; ?></td>
                        <td><?php echo $kunde_kontakt; ?></td>
                        <td><?php echo $kunde_epost; ?></td>
                        <td><?php echo $kunde_adresse; ?></td>
                        <td>
                            <a href="<?php echo NETTSTEDURL; ?>admin/oppdater-order.php?id=<?php echo $id; ?>" class="btn-secondary">Oppdater Bestilling</a>
                        </td>
                    </tr>
                    
                    <?php
                }
            } else {
                // Bestilling ikke tilgjengelig
                echo "<tr><td colspan='12' class='error'>Bestilling ikke tilgjengelig.</td></tr>";
            }
            ?>

        </table>
    </div>
</div>

<?php include('deler/footer.php'); ?>