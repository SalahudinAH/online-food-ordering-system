<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Hent skjemadataene
  $navn = $_POST['navn'];
  $epost = $_POST['epost'];
  $melding = $_POST['melding'];

  // Angi e-postadressen til mottakeren
  $til = 'salahthegoatyt@gmail.com';

  // Angi e-postens emne
  $emne = 'Ny melding fra kontaktskjema';

  // Angi e-postens hodeinformasjon
  $hoder = "Fra: $navn <$epost>" . "\r\n";
  $hoder .= "Svar-til: $epost" . "\r\n";
  $hoder .= "Content-Type: text/plain; charset=utf-8" . "\r\n";

  // Send e-posten
  $suksess = mail($til, $emne, $melding, $hoder);

  // Returner en respons til klienten
  if ($suksess) {
    http_response_code(200);
    echo json_encode(['melding' => 'E-posten ble sendt']);
  } else {
    http_response_code(500);
    echo json_encode(['melding' => 'Kunne ikke sende e-post']);
  }
} else {
  http_response_code(400);
  echo json_encode(['melding' => 'Ugyldig forespørsel']);
}
?>
