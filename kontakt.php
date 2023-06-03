<?php include('deler-front/meny.php'); ?>

<!-- Kontakt-siden starter her -->
<section class="kontakt">
    <div class="innpakning">
        <h2 class="text-center">Kontakt oss</h2>

        <div class="kontakt-informasjon">
            <h3>Kundeservice</h3>
            <p>Har du spørsmål, tilbakemeldinger eller trenger hjelp? Kontakt vår kundeservice for support.</p>
            <p>Telefon: 12345678</p>
            <p>E-post: kundeservice@example.com</p>
        </div>

        <div class="kontakt-skjema">
            <h3>Send oss en melding</h3>
            <form id="kontakt-form" action="send_email.php" method="POST">
                <label for="navn">Navn:</label>
                <input type="text" id="navn" name="navn" required>

                <label for="epost">E-post:</label>
                <input type="email" id="epost" name="epost" required>

                <label for="melding">Melding:</label>
                <textarea id="melding" name="melding" rows="5" required></textarea>

                <button type="submit">Send</button>
            </form>
        </div>
    </div>
</section>
<!-- Kontakt-siden slutter her -->

<?php include('deler-front/footer.php'); ?>

<script>
  // Funksjon for å sende skjemadata til serveren
  function sendEmail(event) {
    event.preventDefault(); // Forhindrer skjemaets innsending

    // Hent skjemaverdiene
    var navn = document.getElementById('navn').value;
    var epost = document.getElementById('epost').value;
    var melding = document.getElementById('melding').value;

    // Opprett et objekt for å lagre skjemadataene
    var skjemaData = {
      navn: navn,
      epost: epost,
      melding: melding
    };

    // Send skjemadataene til serveren ved hjelp av AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'send_email.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(skjemaData));

    // Tilbakestill skjemafeltene
    document.getElementById('navn').value = '';
    document.getElementById('epost').value = '';
    document.getElementById('melding').value = '';

    // Vis en suksessmelding
    alert('Meldingen ble sendt!');
  }

  // Legg til en hendelseslytter for skjemainnsendingen
  document.getElementById('kontakt-form').addEventListener('submit', sendEmail);
</script>
