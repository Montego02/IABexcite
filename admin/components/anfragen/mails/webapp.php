<?php 


            $subject = "Ihre Anfrage im App Entwickler Verzeichnis - Tipp: Webapp";
            
            $body   = '<h2>Hallo '.$data["anrede"]. " " . $data["name"] . ',</h2>'
                    . '    Danke für Ihre Anfrage "'.$data["titel"].'" auf dem <a href="http://www.app-entwickler-verzeichnis.de">App
              Entwickler Verzeichnis</a>.<br>
			Aufgrund Ihrer Aufgabenstellung würde ich Ihnen empfehlen, die App als WebApp zu erstellen; damit ist sie für alle Smartphones sowie über den Browser nutzbar. Andernfalls ergeben sich für jedes weitere Betriebssystem zusätzliche Entwicklungskosten.
			Die Kosten für die Erstellung einer WebApp entsprechend Ihrer Angaben dürften bei etwa '.$data["budget_vorschlag"].' EUR liegen.
			<br>			  
			Bitte melden Sie noch kurz bei uns, um zu klären, wie wir weiter verfahren.		  
            <br>';






?>