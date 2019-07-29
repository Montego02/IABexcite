<?php 
            $subject = "Ihre Reklamation ID".$data['id']." im AEV";            
            $body   = '<h2>Hallo '.$user->name.',</h2>'
					."Wir haben Ihre Reklamation zur Anfrage '".$data['titel']."' geprüft, konnten diese leider jedoch nicht akzeptieren. 
					Bei der Rücksprache mit dem Anfrager wurden Ihre Einwendungen nicht bestätigt."
					."<br><br>Sollten Sie noch Fragen haben, stehen wir immer gerne zur Verfügung.";
?>