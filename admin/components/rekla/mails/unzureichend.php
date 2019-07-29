<?php 
            $subject = "Ihre Reklamation ID".$data['id']." im AEV";            
            $body   = '<h2>Hallo '.$user->name.',</h2>'
					."Wir haben Ihre Reklamation zur Anfrage '".$data['titel']."' geprüft, konnten diese leider jedoch nicht akzeptieren. 
					Ihr angegebener Reklamationsgrund ist unzureichend."
					."<br><br>Sollten Sie noch Fragen haben, stehen wir immer gerne zur Verfügung.";
?>