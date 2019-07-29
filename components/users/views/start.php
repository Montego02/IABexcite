<?php
$user = $_SESSION['user'];

if ($user->id > 0) {
    ?>
    <h1>Willkommen <?php echo $user->username; ?> <span class="small">(ID <?php echo $user->id ?>)</span></h1>

    
     <div class="flexRow">

           <div id="leftCol">
    
    <?php
    
   //$ent = false;
    
    if ($ent) {
        // get city alias
        $arrSuchen = array('ä', 'ö', 'ü', 'Ä', 'Ö', 'Ü', 'ß', ' ', '\\', '/', '*', '#', '&', '+', '.', ':', ';', '?', '!', '(', ')', '|', '<', '>', '"', '---');
        $arrErsetzen = array('ae', 'oe', 'ue', 'ae', 'oe', 'ue', 'ss', '-', '-', '-', '', '', '', '', '-', '', '', '', '', '', '', '-', '', '', '', '-');
        $city = str_replace($arrSuchen, $arrErsetzen, $ent->ort);
        $city = strtolower($city);


//        // get Referenzen
//        $query = "SELECT id FROM #__apps WHERE owner = '" . $user->id . "'";
//        $db->setQuery($query);
//        $apps = $db->loadObjectList();
        // wurde Ort schon gespeichert, sonst WARNUNG
        if ($ent->ort == '') {
            ?>
            <div class="warning" style="width: 540px">
               <img src="/images/icons/warning.png" style="float: left; margin: 10px 20px 50px 0;" />
               <h1>Ihr Profil hat keinen Ort</h1>
               <p>Es konnten bisher kein Ort zu Ihrer Postleitzahl ermittelt werden.</p>
               <p>Klicken Sie bitte auf den Button "Entwicklerprofil bearbeiten", geben Sie eine korrekte PLZ ein und speichern Sie Ihren Eintrag.</p>
               <p>Sie können nach der Speicherung prüfen, ob das System den korrekten Ort ermittelt hat und können diesen danach ggf. anpassen.</p>
               <br />
               <p><a class="button" href="/profil-bearbeiten"> Entwicklerprofil bearbeiten </a></p>
               <br />
            </div>

            <br />

            <?php
        } else if ($ent->lat == 0) {
            // wurden geodaten schon gespeichert, sonst WARNUNG
            ?>
            <!--            <div class="warning" style="width: 540px">
                            <img src="/images/icons/warning.png" style="float: left; margin: 10px 20px 50px 0;" />
                            <h1>Bitte aktualisieren Sie Ihr Profil</h1>
                            <p>Es konnten bisher keine Geodaten zu Ihrem eingetragenen Standort ermittelt werden.</p>
                            <p>Klicken Sie einfach den Button "Entwicklerprofil aktualisieren", prüfen Sie, dass das System den korrekten Standort in der Karte anzeigt und <strong>speichern</strong> Sie danach Ihren Eintrag</p>
                            <br />
                            <p><a class="button" href="profil-bearbeiten"> Entwicklerprofil aktualisieren </a></p>
                            <br />
                        </div>

                        <br />-->

            <?php
        }
        ?>

       

              <div class="box2 round shadow"  style="width: 546px"	>
                 <h2>Daten zu Ihrem Entwicklerprofil</h2>
                 <hr class="clearall" />
                 <table class="anfragenstart" width="500" border="0" cellspacing="1" cellpadding="2">
                    <tr>
                       <td class="titel" width="140">Titel des Profils</td>
                       <td>
                          <a href="/programmierer/<?php echo $ent->ort; ?>/<?php echo $ent->id; ?>-<?php echo $ent->alias ?>" target="_blank">
                              <?php echo $ent->title; ?>
                          </a>
                       </td>
                    </tr>

                    <tr>
                       <td class="titel">Score*</td>
                       <td><?php echo $ent->score ?> / 100</td>
                    </tr>



                                                <!--                <tr>
                                                                    <td class="titel">Referenzen</td>
                                                                    <td><?php
                    if ($apps) {
                        echo count($apps) . '  <a class="small" href="">verwalten</a>';
                    } else {
                        ?>
                                                                                                    <img src="/images/icons/warning.png" height="40" style="float: left; margin: 10px 20px 0px 0;" />  
                                                                                                    <p>Sie haben noch keine Referenzen hinterlegt!</p>
                                                                                                    <p><a class="button" href="referenzen">Jetzt App Referenz anlegen</a></p>          
                    <?php } ?>
                                                                    </td>
                                                                </tr>-->
                 </table>

                 <p class="small"><strong>* Wird alle 24h aktualisiert.</strong> <br />
                    Ihr Score bemisst sich daran, wie vollst&auml;ndig, umfangreich und korrekt (Backlink) die Daten sind, die Sie in Ihrem Entwicklerprofil eingepflegt haben. Profile mit h&ouml;herem Score werden bei der <a href="entwickler-suchen" target="_blank">Entwicklersuche</a> vor Profilen mit niedrigerem Score angezeigt.</p>

                 <br />

                 <p><a class="button"  href="profil-bearbeiten"> Entwicklerprofil bearbeiten </a></p>




              </div>
          <?php } else {
              ?>

              <div class="warning" style="width: 540px">
                 <img src="/images/icons/warning.png" style="float: left; margin: 10px 20px 50px 0;" />
                 <h1>Achtung - Sie haben kein Entwicklerprofil erstellt</h1>
                 <p>Sie haben bisher kein Entwicklerprofil erstellt und werden daher von den Besuchern des App Entwickler Verzeichnisses <strong>nicht</strong> gefunden.
                    Wenn Sie Anfragen direkt von dieser Seite erhalten m&ouml;chte, empfehlen wir Ihnen, ein Entwicklerprofil anzulgen.</p>
                 <p class="small">&Uuml;brigens: je mehr Informationen Sie in Ihrem Profil hinterlegen, umso weiter oben werden Sie in unseren Suchergebnissen angezeigt</p>

                 <br />

                 <p><a class="button" href="profil-bearbeiten">Jetzt Entwicklerprofil anlegen</a></p>
              </div>

              <?php
          }




          // CREDIT - Anzeige


          if ($credits) {
              ?>
              <br />
              <div class="box2 round" style="width: 546px">
                 <h2 style="margin: 0">Guthaben: <?php echo $credits ?> Credits</h2>
              </div>


          <?php } ?>

          <!--	<div class="note">
                  <h2>Bannerversteigerung Juni / Juli aktiviert</h2>
                  <img src="images/icon-info.jpg" />        
                  <strong>Topplatzierung auf der Startseite des App Entwickler Verzeichnisses</strong><br />
                  Unsere bisherigen Werbekunden haben im Vergleich zur regul�ren Schaltung zwischen 62% (Zuschlag bei EUR 150) und 95% (Zuschlag bei EUR 20) gegen�ber dem regul�ren Verkaufspreis (EUR 384) <strong>gespart</strong>. <br />
                  <span class="small">Versteigerung l�uft bis 10.Juni</span><br />
                     <a href="werbung"> Jetzt mitbieten und sparen</a>
                  </div>
          -->

          <!--  <div class="note">
            <h2>Ablehnung von Apps im AppStore - AppStoreRejects Datenbank</h2>
            <strong>Um f�r mehr Transparenz zu sorgen und Entwicklern die M�glichkeit zu geben, noch vor der Programmierung und Einreichung einer App, diese gegen die aktuelle "Rechtsprechung" von Apple zu pr�fen, bieten wir Ihnen unsere "App Store Rejects" Datenbank an.</strong>
            <p>Schauen Sie mal rein und machen Sie mit.</p>
            <p><strong>Die ersten 10 Eintrager erhalten einen Gutschein �ber EUR 100.- f�r Google AdWords</strong> <span class="small">(nur beim Anlegen eines neuen AdWords Kontos nutzbar)</span></p>
            <a href="/appstore-ablehnung-gruende">zur AppStoreRejects Datenbank</a>
            </div>-->

          <!--    
                  <div class="buttonbox" onclick="javascript:history.go(-2)" align="center">
                      <img src="images/icons/back.png" />
                      <a href="javascript:history.go(-2)">Zur�ck zur Seite vor Login</a>
                  </div>        
              
          --> 

          <hr class="clear" style="height: 8px" >
          <div class="buttonbox">
             <div class="imagecontainter" style="height: 80px; vertical-align: middle">

                <a href="aktuelle-anfragen"><img class="border1" height="100" src="/images/icons/iconAnfragen.png"></a> 
             </div>
             <a href="aktuelle-anfragen">Aktuelle Anfragen</a>
          </div>  

          <div class="buttonbox">
             <div class="imagecontainter" style="height: 80px; vertical-align: top">

                <a href="index.php?com=anfragen&view=zahlungen"><img class="border1" style="height: 60px" src="/images/icons/iconRechnung.png" /></a>
             </div>
             <a href="index.php?com=anfragen&view=zahlungen">Rechnungen</a>
          </div> 

          <div class="buttonbox">
             <div class="imagecontainter" style="height: 80px; vertical-align: middle">
                <a href="app-garantie">  
                   <img src="/images/icons/warning.png" style="height: 80px" />
                </a>
             </div>
             <a href="app-garantie">Anfrage reklamieren</a>
          </div>          




          <hr class="clearall" />

          <div class="buttonbox">
             <div class="imagecontainter" style="height: 80px; vertical-align: middle">
                <a href="profil-bearbeiten"><img style="height: 70px" src="/images/icons/entwickler-neu.png" /></a>
             </div>
             <a href="profil-bearbeiten">Entwicklerprofil</a>	
          </div>  

          <div class="buttonbox">
             <div class="imagecontainter" style="height: 80px; vertical-align: middle">
                <a href="premium-app-programmierung"><img src="/images/icons/premium.png" height="100" /></a>
             </div>
             <a href="premium-app-programmierung">Premium werden!</a>
          </div> 




          <div class="buttonbox">
             <div class="imagecontainter" style="height: 80px; vertical-align: middle">
                <a href="referenzen"><img src="/images/icons/apps.png" height="100" /></a>
             </div>
             <a href="referenzen">Referenz Apps</a>
          </div> 



          <!--
          <div class="buttonbox">
              <div class="imagecontainter" style="height: 80px; vertical-align: middle">
                  <a href="testing"><img src="/images/app-testing-aev.png" height="100" /></a>
              </div>
              <a href="testing">App Testing</a>
          </div> 
          -->


          <hr class="clearall" />  








          <div class="buttonbox">
             <div class="imagecontainter" style="height: 80px; vertical-align: middle">
                <a href="credits"><img src="/images/icons/credits-menu.png" /></a>
             </div>
             <a href="credits">Credits kaufen</a>
          </div> 





          <hr class="clearall" />    

          <br>

          <a id="deleteUser" class="btnRed" href="#" >Profil & User löschen</a>



          <!--   	<div class="buttonbox">
                  <div class="imagecontainter" style="height: 80px; vertical-align: middle">
                              <a href="werbung"><img src="/images/icons/banner.png" /></a>
                  </div>
                  <a href="werbung">Banner-Auktion<br />STARTSEITE
          </a>
              </div>  
              
              <div class="buttonbox">
                  <div class="imagecontainter" style="height: 80px; vertical-align: middle">
                              <a href="werbunganfragen"><img src="/images/icons/banner.png" /></a>
                  </div>
                  <a href="werbunganfragen">Banner-Auktion<br />ANFRAGENSEITE
          </a>
              </div>   -->  


          <hr class="clearall" />

       </div>







       <!-- ////////////////  RIGHT COL ///////////////////-->
       <div style="margin-left: 25px" >
          <div class="box4">
             <h4><b class="badgeNew" style="margin: -1px 10px 0 -6px">NEU</b> Medallien und Ranking</h4>
             <div class="pad15">
                <div class="flipContainer"  style="float: left; margin: 0 5px 50px 0">
                <img src="/images/corporate/medal.svg" class="flipper"  style="width: 50px; margin: 0"> 
                </div>
                Dokumentieren Sie jetzt, welche der im AEV ausgeschriebenen Anfragen Sie umgesetzt haben und erhalten Sie dafür eine hübsche <b>Medallie</b>.
                <br>Die sieht nicht nur kompetent in Ihrem Profil aus, sondern bestimmt künftig auch das <b>Ranking</b> in der Entwicklersuche (nach dem Score).
                <br><br><a class="button" href="index.php?com=anfragen&view=feedbackAuftrag">Auftrag beanspruchen</a>
             </div>
          </div>
          <!--  
                   <div>    
                     <p><a class="button" href="/index.php?task=logout">Logout</a></p>   -->
                       <!--<p><a href="/index.php?option=com_users&view=profile&layout=edit" class="small">Userdaten bearbeiten</a></p>
                      <hr class="clear" />
                   </div>
          -->

          <div class="box4">
             <h4>Premium Entwickler werden</h4>
             <div class="pad15">
                <img src="images/corporate/premium-tag.png" style=" width: 52px; float: left; margin: 0 15px 15px 0">
                <b>Wir haben die Vorteile f&uuml;r Premium-Entwickler nochmals deutlich ausgeweitet. Premium Entwickler profitieren jetzt von der Top-Platzierung im ganzen Verzeichnis:</b>

                <ol class="haken" style="margin-left: 15px">
                   <li>Firmenlogo auf der <strong><a href="/index.php#premiumentwickler" target="_blank">Startseite</a></strong></li>
                   <li><strong>Top Platzierung</strong> vor allen Basic-Eintr&auml;gen in der 
                      <a href="/component/verzeichnis/?view=verzeichnis&amp;layout=umkreissuche&amp;plzGesucht=10117&amp;umkreis=25" target="_blank">Umkreissuche</a>, der Suche nach <a href="http://www.app-entwickler-verzeichnis.de/iphone-ipad-programmierung" target="_blank">Betriebssystem</a>
                      und der Stadtsuche
                   </li>
                   <li><strong>Doppelter Platz</strong> zur Darstellung inkl. kompletter Entwicklerbeschreibung</li>
                </ol>

                <p><a class="button star" href="premium-app-programmierung">Weitere Informationen zu Premium</a></p>
             </div>                
          </div>


          <div class="box4" style="min-height: 170px">
             <h4>Backlink-Partnerschaft</h4>
             <div class="pad15">
                <a href="index.php?option=content&view=detail&id=30">
                   <img class="imgarticle" src="images/corporate/aev-mitglied-button3.png" style="width: 100px; margin-bottom: 1px">
                </a>
                Wenn Sie von Ihrer Website einen Backlink auf das AEV setzen, profitieren Sie von zahlreichen Vorzügen wie günstigeren Credits und besserer Platzierung.
                <br><br>

                <a class="button star" href="index.php?com=content&view=detail&id=30">Mehr Informationen</a>
             </div>
          </div>



          <div class="box4" >
             <h4>INFO | Score</h4>
             <div class="pad15">
                <h3 style="margin: 3px 0">Was ist der "Score"</h3>
                <p>Ihr Score bemisst sich danach, wie umfangreich Sie Ihr Profil mit Informationen ausgestattet haben. </p>
                <p>F&uuml;r Besucher des AEV sind aussagekr&auml;ftige Profile n&uuml;tzlicher als solche ohne Informationen. Daher zeigen wir informative Profile vor weniger informativen Profilen an.</p>
                
              
                <p>Punkte gibt es f&uuml;r:</p>
                <ul>
                   <li>Backlink zum AEV (50)</li> <span class="small">Ein Backlink von Ihrer Website dokumentiert Partnerschaft und bringt 50 Punkte. Bitte
                      vergessen Sie nicht, den Backlink auch in Ihrem Profil einzutragen, damit unser System diesen pr&uuml;fen und werten kann.</span>
                   <li>Firmenbeschreibung (20) <span class="small">Wenn mehr als 120 Zeichen lang</span></li>
                   <li>Logo (10)</li>
                   <li>Kurzbeschreibung (10) <span class="small">Wenn mehr als 50 Zeichen</span></li>
                   <li>Keywords (10) <span class="small">Wenn mehr als 20 Zeichen</span></li>
                </ul>
             </div>
          </div>
       </div>


       <!--<div class="box2" style="padding: 10px; position:absolute; left: 50%; margin-left: 180px; top: 360px; width: 280px">
               <h3>Tipp 1: Backlink setzen</h3>
         <h4 style="margin: 3px 0">Wozu Backlink setzen?</h4>
         <p>Der Backlink von Ihrer Website auf das AEV bringt Ihnen zahlreiche Vorteile</p>
         <ul style="padding: 3px; padding-left:20px">
           <li>Hervorgehobene, verlinkte Darstellung Ihres Profils MIT <strong>Logo</strong> in der <a href="entwickler-suchen" target="_blank" class="small">Entwicklersuche</a></li>
           <li>Anzeige eines <strong>klickbaren Links</strong> auf Ihre Website in Ihrem Profil. Dadurch mehr direkte Besucher und besseres Ranking Ihrer Website bei Google</li>
           <li>Bis zu <strong>20% Rabatt</strong> beim Kauf von Anfragedaten �ber Credits</li>
           <li><strong>Mehr Anfragen</strong> durch bessere Auffindbarkeit des AEV - die kommen auch Ihnen zugute</li>
           </ul>
       <br />


         <h4 style="margin: 3px 0">WIE Backlink setzen?</h4>
           <p><strong>1. </strong>Platzieren Sie einen unserer vorbereiteten <a class="small" target="_blank" href="http://www.app-entwickler-verzeichnis.de/impressum/30">Links</a> auf Ihrer Website. Es werden k�nftig nur Backlinks von Seiten gewertet, die auch von Google gefunden werden.<br />
               Bitte stellen Sie sicher, dass sich Ihr Backlink auf einer <strong>verlinkten</strong>, auffindbaren Seite Ihrer Webpr�senz befindet. Am zuverl�ssigsten wird der Link auf der <strong>Startseite</strong> gefunden, wo er z.B. als kleiner Textlink am Seitenende sehr unaufdringlich platziert werden kann.</p>
             <p>      
            <strong>2. </strong>Hinterlegen Sie die URL in Ihrem <a href="profil-bearbeiten" class="small">Profil</a>
         </p>
            
            <p><strong>Fertig!</strong> Unser Crawler findet Ihren Backlink innerhalb von 24h. Ihr Profil ist jetzt hervorgehoben und auf Ihre Website verlinkt</p>
           
           
       </div>-->


   <?php } else { ?>

       <h2>Sie sind nicht (mehr) angemeldet.</h2>
       <p>Aus Sicherheitsg&uuml;nden werden Sie nach 15 Minuten automatisch abgemeldet.</p>
       <p>Zum <a href="/index.php?com=users&view=login">login</a></p>
       <p></p>
   <?php } ?>