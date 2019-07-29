<?php 


            $subject = "Budget Ihrer Anfrage im App Entwickler Verzeichnis";
            
            $body   = '<h2>Hallo '.$data["anrede"]. " " . $data["name"] . ',</h2>'
                    . '    Danke für Ihre Anfrage "'.$data["titel"].'" auf dem <a href="http://www.app-entwickler-verzeichnis.de">App
              Entwickler Verzeichnis</a>.<br>
			  Sie haben leider kein Budget angegeben. Anfragen ohne Budget erhalten oft nur sehr zögerlich Angebote. Daher empfehlen wir Ihnen anzugeben, wieviel Sie für das App zu zahlen bereit wären. Aufgrund der Konkurrenzsituation im App Entwickler Verzeichnis ergibt sich selbst wenn das Budget zu hoch liegt ein gesunder Marktpreis.<br> 
			  Aufgrund Ihrer Angaben würden wir ein Budget von '.$data["budget_vorschlag"].' EUR vorschlagen.
			<br>			  
			Wenn Sie einverstanden sind, können wir die Anfrage nach Änderung des Budgets gerne aktivieren. Falls Sie noch Fragen haben, können Sie mich gerne auch telefonisch kontaktieren.		  
            <br>';






?>