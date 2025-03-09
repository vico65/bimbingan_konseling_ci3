<?php
require_once 'vendor/autoload.php';

use Twilio\Rest\Client;

// Ganti dengan kredensial Twilio kamu
$sid    = "ACdef3933d3194f7a9c01a69c323935d48";
$token  = "92b8ad3aaec6f5a743c3b2b564649666";
$twilio = new Client($sid, $token);

$message = $twilio->messages
      ->create("whatsapp:+6281234567890", // Nomor tujuan (ganti dengan nomor penerima)
        array(
          "from" => "whatsapp:+14155238886", // Nomor Twilio WhatsApp
          "body" => "Halo, ini pesan otomatis dari Twilio WhatsApp!"
        )
      );

echo "Pesan terkirim dengan SID: " . $message->sid;
?>
