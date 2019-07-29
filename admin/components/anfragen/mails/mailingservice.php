<?php

$body = '<h2>Hallo ' . $recipient->person.", </h2>";
$body .= 'Wir haben soeben eine neue Anfrage freigeschaltet.<br>
          Bitte verwenden Sie den folgenden Link zum Öffnen der Anfrage, da diese erst in ca. 30 Minuten online sichtbar wird<br>';


$body .= '<a href="http://www.app-entwickler-verzeichnis.de/index.php?option=com_anfragen&view=anfrage&layout=detail&aid='.$data['cf_id'].'" >Anfrage ID'.$data['cf_id'].'</a>';

$body .= '<br><p>Wir wünschen viel Erfolg mit der Anfrage.</p>';

          
?>