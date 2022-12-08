<?php include('../konfig/konstanter.php') ?>

<html>
    <head>
        <title>Login - Mat bestilling System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['ingen-påloggingsmelding']))
                {
                    echo $_SESSION['ingen-påloggingsmelding'];
                    unset($_SESSION['ingen-påloggingsmelding']);
                }
            ?>
            <br><br>

            <!-- Login Form starter her -->
            <form action="" method="POST" class="text-center"> 
                Brukernavn: <br>
                <input type="text" name="brukernavn" placeholder="Skriv inn brukernavn"> <br><br>

                Passord: <br>
                <input type="password" name="passord" placeholder="Skriv inn passord"> <br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!-- Login form slutter her -->


        </div>

    </body>
</html>

<?php

    // Sjekk om submit-knappen er klikket
    if(isset($_POST['submit']))
    {
        // Prosess for pålogging
        // 1. Hente dataene fra Login form
        $brukernavn = $_POST['brukernavn'];
        $passord = md5($_POST['passord']);

        // 2. Lage en SQL-spørring for å sjekke om brukeren med brukernavn og passord eksisterer i systemet
        $sql = "SELECT * FROM admin WHERE brukernavn='$brukernavn' AND passord='$passord'";

        //  3. Utføre spørringen
        $res = mysqli_query($conn, $sql);

        // 4. Telle rader for å sjekke om brukeren eksisterer
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            // Bruker tilgjengelig
            $_SESSION['login'] = "<div class='suksess'>Pålogging velykket.</div>";
            $_SESSION['bruker'] = $brukernavn; // Sjekke om brukeren er logget inn
            
            // Omdirigere til Hjemmeside/Dashboard
            header('location:'.NETTSTEDURL.'admin/');
        }
        else
        {
            // Bruker ikke tilgjengelig og pålogging feilet
            $_SESSION['login'] = "<div class='error text-center'>Pålogging mislykket.</div>";
            // Omdirigere til Hjemmeside/Dashboard
            header('location:'.NETTSTEDURL.'admin/login.php');
        }
    }
?>