<?php 


            $subject = "Ihre Anfrage wurde reklamiert";
            
            $body  = '<h2>Hallo '.$data["anrede"]." ".$data["name"].", </h2>";
			$body .= 'Ihre Anfrage zur App-Entwicklung <b>"'.$data["titel"].'"</b> wurde reklamiert.<br>
			Laut Entwickler wurde der Auftrag bereits vergeben oder wird nicht umgesetzt.
			<br><br>
			
            <b>Bitte</b> geben Sie uns dringend ein Feedback:<br>
            <ul>
			  <li>Soll Ihre Anfrage in unserem Verzeichnis deaktiviert werden?</li>
              <li>Haben Sie einen Entwickler gefunden?</li>
            </ul>
			<br>
			<br>
			Vielen Dank für Ihr Feedback.
			
			';
			



?>