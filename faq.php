<?php include('deler-front/meny.php'); ?>

<!-- FAQ-delen starter her -->
<section class="faq">
    <div class="innpakning">
        <h2 class="text-center">Ofte stilte spørsmål</h2>

        <div class="faq-question">
            <h3>Hvordan legger jeg inn en bestilling?</h3>
            <div class="faq-answer">
                <p>Du kan legge inn en bestilling ved å fylle ut bestillingsskjemaet på nettsiden vår og bekrefte detaljene.</p>
            </div>
        </div>

        <div class="faq-question">
            <h3>Hvilke betalingsmetoder kan jeg bruke?</h3>
            <div class="faq-answer">
                <p>Vi godtar flere betalingsmetoder, inkludert kredittkort, debetkort og nettbankoverføring.</p>
            </div>
        </div>

        <div class="faq-question">
            <h3>Kan jeg se menyen og prisene før jeg legger inn en bestilling?</h3>
            <div class="faq-answer">
                <p>Ja, du kan se menyen og prisene for hver restaurant på nettsiden vår. Naviger til restaurantens side for å se deres tilgjengelige retter og priser.</p>
            </div>
        </div>

        <div class="faq-question">
            <h3>Hvor lang tid tar leveringen?</h3>
            <div class="faq-answer">
                <p>Leveringstiden avhenger av destinasjonen. Vanligvis tar det mellom 30 og 40 minutter.</p>
            </div>
        </div>

        <div class="faq-question">
            <h3>Hvordan kan jeg kontakte kundestøtte?</h3>
            <div class="faq-answer">
                <p>Du kan kontakte kundestøtte ved å bruke kontaktskjemaet på nettsiden vår eller ved å ringe vårt kundestøttenummer.</p>
            </div>
        </div>

        <div class="faq-question">
            <h3>Hva gjør jeg hvis jeg opplever problemer med min bestilling?</h3>
            <div class="faq-answer">
                <p>Hvis du opplever problemer med din bestilling, ber vi deg kontakte kundestøtte umiddelbart. Vi vil gjøre vårt beste for å løse eventuelle problemer og sikre at du er fornøyd med din matbestilling.</p>
            </div>
        </div>

        <div class="faq-question">
            <h3>Kan jeg endre eller avbestille bestillingen min?</h3>
            <div class="faq-answer">
                <p>Ja, du kan endre eller avbestille bestillingen din innen en viss tidsramme før levering. Vennligst kontakt kundestøtte for å få hjelp med endringer eller avbestillinger.</p>
            </div>
        </div>

    </div>
</section>
<!-- FAQ-delen slutter her -->

<?php include('deler-front/footer.php'); ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('.faq-question').click(function() {
    $(this).find('.faq-answer').slideToggle();
  });
});
</script>
