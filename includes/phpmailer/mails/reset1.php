<?php

$url = "http://app-entwickler-verzeichnis.de/index.php?com=users&task=resetPass2&activation=" . $activation ;

$mail->Subject = 'Änderung Ihrer Anmeldedaten im App Entwickler Verzeichnis';

$msgBody = "<p>Hallo " . $item->username . ",</p>"
        . "<p>Sie haben die Änderung Ihres Passwortes im App Entwickler Verzeichnis beantragt.</p>"
        . "Bitte klicken Sie den nachfolgenden Link und vergeben Sie ein neues Passwort.<br><br>"
        
        . "<a href='".$url."' >".$url."</a><br><br>";


ob_start();
require_once('includes/phpmailer/mails/footer.php');
$msgBody .= ob_get_clean();

/*

  ."<p><a href='".URL."views/rechnung.php?token=".$token."'>Print an invoice</a><br><br><br>"
  ."<p>Kind regards</p>";
 */
?>

