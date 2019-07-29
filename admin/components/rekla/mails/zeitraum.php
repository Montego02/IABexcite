<?php

$subject = "Ihre Reklamation ID" . $data['id'] . " im AEV";

$body = "<h2>Hallo " . $user->name . ",</h2>"
        . "Wir haben Ihre Reklamation zur Anfrage '" . $data['titel'] . "' geprüft, jedoch ist der Zeitraum für eine mögliche Reklamation bereits überschritten."
        . "<br><br>Bitte haben Sie Verständnis, dass wir nur innerhalb der veröffentlichten Fristen Reklamationen annehmen können.<br>";
?>