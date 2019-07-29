<?php 
if (!$data['person']) {
    $data['person'] = $ent->person;
    $data['confirm'] = $ent->confirm;
}

            $subject = "Ablauf Ihrer Premium-Mitgliedschaft im AEV";
            
            $body   = "<h2>Hallo ".$data['person'].",</h2>"
			."Ihre Premium-Mitgliedschaft im App Entwickler Verzeichnis ist nun abgelaufen."
                        ."<br>Sie können Ihre Mitgliedschaft jederzeit wieder erneuern unter:"
                        ."<br><br><a href='http://www.app-entwickler-verzeichnis.de/premium-app-programmierung'>http://www.app-entwickler-verzeichnis.de/premium-app-programmierung</a>"        
                        ."<br><br>Wir würden uns freuen, Sie wieder als Premium-Entwickler begrüßen zu dürfen und senden...<br>";

?>