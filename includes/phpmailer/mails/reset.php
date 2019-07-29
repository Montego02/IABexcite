<?php

$mail->Subject = 'Ihr Passwort wurde zurückgesetzt';

$msgBody = "<p>Hallo ".$item->username.",</p>"
        ."<p>Sie können sich auf der Seite mit Ihrem</p>"
        . "Benutzernamen: ".$item->username."<br>"
        ."<p>und dem neu gewählten Passwort einloggen.</p>"
      //. "<a href='".URL."index.php?task=showBannerBooked&token=".$token."' >Your Banner Booking</a><br><br>";
        . "Zum <a href='".URL."' >App Entwickler Verzeichnis</a><br><br>";


ob_start();
require_once('includes/phpmailer/mails/footer.php');
$msgBody .= ob_get_clean();

/*
  
        ."<p><a href='".URL."views/rechnung.php?token=".$token."'>Print an invoice</a><br><br><br>"
        ."<p>Kind regards</p>";
*/
        