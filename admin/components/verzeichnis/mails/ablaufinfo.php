<?php 

if (!$data['person']) {
    $data['person'] = $ent->person;
    $data['confirm'] = $ent->confirm;
}


            $subject = "Ihre Premium-Mitgliedschaft im AEV endet bald";
            
            $body   = "<h2>Hallo ".$data['person'].",</h2>"
			."Ihre Premium-Mitgliedschaft im App Entwickler Verzeichnis endet am ".$data['confirm']."."
                        ."<br>Da sich die Mitgliedschaft nicht automatisch verlängert, möchten wir Ihnen hiermit den Link zusenden, mit dem Sie die Mitgliedschaft (nach Login) verlängern können:"
                        ."<br><br><a href='http://www.app-entwickler-verzeichnis.de/premium-app-programmierung'>http://www.app-entwickler-verzeichnis.de/premium-app-programmierung</a>"        
                        ."<br><br>Buchen Sie am besten gleich die Verlängerung, um weiterhin von diesen Vorteilen zu profitieren:
                            <ol>
<li>Darstellung Ihres Logos auf der <strong>Startseite des AEV</strong> als Premium
  Entwickler und Verlinkung auf Ihr Profil</li>
<li><strong>Top-Listung</strong> vor allen Basic-Einträgen in Ihrer <strong>Stadt</strong> und
  in der <strong>Umkreissuche</strong></li>

<li><strong>Doppelte Größe</strong> Ihres Eintrages in der Stadt- und Betriebssystemsuche mit
  Ihrem vollen Beschreibungstext</li>
<li><strong>Verlinkung Ihrer Website</strong>, auch wenn Sie keinen Backlink gesetzt haben</li>
<li>Aufnahme in unsere Liste 'Premium Entwickler' </li>
</ol>"
                        ."<br><br>Wir würden uns freuen, Sie weiterhin 'an Bord' zu haben und senden...<br>";

?>