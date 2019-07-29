<?php 


            $subject = "Budget Ihrer Anfrage im App Entwickler Verzeichnis";
            
            $body   = '<h2>Hallo '.$data["anrede"]. " " . $data["name"] . ',</h2>'
                    . '    Danke für Ihre Anfrage "'.$data["titel"].'" auf dem <a href="http://www.app-entwickler-verzeichnis.de">App
              Entwickler Verzeichnis</a>.<br>
			  Sie haben eine Vielzahl von Betriebssystemen angegeben, für die Ihre App umgesetzt werden soll. 
			  Bitte bedenken Sie, dass sich der Arbeitsaufwand - je nach App - für jedes zusätzliche Betriebssystem um 40% bis 70% erhöht. Daher ist Ihr angegebenes Budget nicht realistisch. Wir empfehlen die Umsetzung für iOS (iPhone, iPad) und Android.
			  Ein Budget von '.$data["budget_vorschlag"].' EUR wäre dann nach unserer Auffassung zu erwarten.
			<br>			  
			Wenn Sie einverstanden sind, können wir die Anfrage nach Änderung gerne aktivieren. Falls Sie noch Fragen haben, können Sie mich gerne auch telefonisch kontaktieren.		  
            <br>';






?>