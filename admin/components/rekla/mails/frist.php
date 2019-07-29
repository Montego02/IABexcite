<?php 

            $subject = "Ihre Reklamation ID".$data['id']." im AEV";
            
            $body   = '<h2>Hallo '.$user->name.',</h2>'
					."Seit Ihrem Kauf der Anfrage '".$data['titel']."' sind noch keine 21 Tage verstrichen." 
					."<br><br>Wir bitten Sie, nochmals den Versuch zu unternehmen, mit dem Anfrager in Kontakt zu treten und nach Ablauf der Frist ggf. die Reklamation erneut zu stellen.";
					

?>