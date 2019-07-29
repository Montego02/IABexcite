<?php
$user = $_SESSION['user'];
?>

<h2><span class="icon-alarm"></span> Reklamationen</h2>

<?php echo layoutHelper::listButtons(); ?>


<?php
if ($_SESSION['msg']) {
    echo "<div class='box2' style='padding: 0px; margin-bottom: 20px'><ul>" . $_SESSION['msg'] . "</ul></div>";
}
?>


<table class="list striped tablesorter">

   <thead>
      <tr>
         <th width="5">ID</th> <!-- cf_id -->
         <th>Entwickler</th>
<!--         <th>ZahlungsID/Status</th>-->
         <th width="150">Transaktion / RE-Nr.</th>            
         <th>aID</th>
         <th>Anfragentitel</th>
         <th>Tage*</th>
         <th>Alter**</th>
         <th>Grund</th>            
         <th>Grund Text</th>
         <th>Zahlart</th>
         <th>Betrag</th>                        
<!--         <th>Status</th>-->
         <th>Aktionen</th>
      </tr>            
   </thead>
   <?php
   foreach ($items as $item) {

//              // id der zahlung abfragen
//
//              $db = & JFactory::getDBO();
//
//              if (is_numeric($anfrageid)) {
//                  $query = "SELECT id, status, amount, tx FROM #__zahlungen WHERE anfrage = " . $anfrageid . " AND userid = " . $item->userid;
//                  $db->setQuery($query);
//                  $item->zahlung = $db->loadObject();
//
//
//                  if ($item->userid) {
//                      $query = "SELECT id, title FROM #__verzeichnis WHERE owner = " . $item->userid;
//                      $db->setQuery($query);
//                      $ent = $db->loadObject();
//                  }
//
//                  if (is_numeric($anfrageid)) {
//                      // Betrag abfragen, wenn Credits, um brutto/netto Problem zu umgehen
//                      $query = "SELECT vk FROM #__anfragen WHERE id = " . $anfrageid;
//                      $db->setQuery($query);
//                      $anfragePreis = $db->loadResult();
//                  }
       // abgelaufene Einträge markieren
       if ($item->status == "archiv" OR $item->active == "del") {
           // DEAKTIVIERT: inaktive nicht zeigen	
       } else {
           if ($item->status == 'erstattet' or $item->status == 'deleted') {
               $active = "inactive";
               $noInactive ++;
           } else {
               $active = "active";
           }

           $anfragelink = "index.php?comp=anfragen&view=detail&id=" . $item->anfrageid;
           $entLink = "index.php?comp=verzeichnis&view=detail&id=" . $item->ent->id;
           ?>


           <tr>

              <td><?php echo $item->id ?></td>
              <td><?php
                  if (strlen($item->ent->title) > 0) {
                      ?>
                     <a href="<?php echo $entLink ?>" target="_blank"><?php echo substr($item->ent->title, 0, 20) ?></a>
                     <?php
                 } else {
                     echo "UserID: " . $item->userid;
                 }
                 ?>          	                  
              </td>

                <!--              <td><?php echo $item->zahlung->id . "(" . $item->zahlung->status . ")"; ?></td>-->
              <td><?php echo $item->zahlung->tx . "<br>AEV-" . $item->userid . "-" . $item->anfrageid ?></td>            
              <td><?php echo $item->anfrageid ?></td>
              <td><a href="<?php echo $anfragelink; ?>" target="_blank"><?php echo $item->titel ?></a></td>

              <td class="numeric"><?php
                  $datRekla = strtotime($item->date);
                  $datKauf = strtotime($item->kaufdatum);
                  $diff = round(($datRekla - $datKauf) / 60 / 60 / 24);
                  $cl = ($diff > 21)? 'red' : '';
                  //echo $item->kaufdatum; echo $item->date 
                  ?>
                 <span class="<?php echo $cl ?>   "><?php echo $diff ?></span>
              </td>         
              
              <td class="numeric"><?php
                 $heute = time();
                  $datRekla = strtotime($item->date);
                  $diff = round(($heute - $datKauf) / 60 / 60 / 24);
                  //echo $item->kaufdatum; echo $item->date 
                  ?>
                 <span><?php echo $diff ?></span>
              </td>    


              <td align="center">
                  <?php
                  switch ($item->grund) {
                      case 1: $grund = "Anfrage bei Erstkontakt bereits vergeben";
                          break;
                      case 2: $grund = "Anfrage wird nicht umgesetzt";
                          break;
                      case 3: $grund = "Anfrager innerhalb von 21 Tagen nicht erreicht";
                          break;
                      case 4: $grund = "anderer Grund ";
                          break;
                  }
                  ?>



                 <a href="#" style="font-weight: bold; padding: 2px 5px; border: 1px solid #ccc; background: #EEE" title="<?php echo $grund ?>">
        <?php echo $item->grund ?>
                 </a>
              </td>

              <td >
                 <div style="overflow-y: scroll; max-height: 90px; font-size: 11px">
                     <?php
                     echo $item->grundtext;
                     ?>
                 </div>
              </td>
              <td><?php
                  echo $item->erstattungsweise;
                  if ($item->zahlung->status == "credits") {
                      echo "<br>STATUS != ZAHLART";
                  }
                  ?></td>   

              <td><?php
//                  switch ($item->zahlung->status) {
//                      case 'credits': $betrag = $anfragePreis;
//                          break;
//                      case 'Completed':
//                          if ($item->erstattungsweise == "Credits") { // falls per paypal gezahlt, aber doch per Credits Erstattung gewünscht
//                              $betrag = $anfragePreis;
//                          } else {
//                              $betrag = $item->zahlung->amount;
//                          }
//                          break;
//                      default:
//                          $betrag = $item->zahlung->amount;
//                  }

                  echo $item->zahlung->amount;
                  ?>
              </td>                                                            
        <!--				<td><input style="width: 100px" value="<?php echo $item->actions ?>"></td>-->
        <!--              <td align="center"><?php
              switch ($item->status) {
                  case "erstattet":
                      echo '<img  src="/images/M_images/money.jpg">';
                      break;
                  case "deleted":
                      echo '<img class="button"  src="/images/M_images/loeschen.jpg">';
                      break;
              }
              ?></td>-->
              <td>
                  <?php
                  if ($item->erstattungsweise == "Credits" or $item->zahlung->status == "credits") {
                      // CREDITS ERSTATTEN
                      ?>
                     <a style="cursor:pointer" class="button" onclick="doIt(<?php echo $item->id ?>, 'erstattet', <?php echo $item->zahlung->id ?>, 'Credits', <?php echo $item->zahlung->amount ?>, <?php echo $item->userid ?>, '<?php echo $item->titel ?>', '<?php echo $item->ent->email ?>')" href="#" >CR.</a>
                     <?php
                 } else {
                     // PAYPAL ERSTATTEN
                     ?>
                     <img style="cursor:pointer"  onclick="doIt(<?php echo $item->id ?>, 'erstattet', <?php echo $item->zahlung->id ?>, 'PayPal', 0, <?php echo $item->userid ?>, '<?php echo $item->titel ?>', '<?php echo $item->ent->email ?>')" src="/admin/images/icons/paypal.png">                
                     <?php
                 }
                 // ABLEHNEN -> nichts erstatten
                 ?>
                 &nbsp;&nbsp;                     
                 <i style="cursor:pointer; float: right"  class="btn btnRed btnSmall icon-cross"  onclick="doIt(<?php echo $item->id ?>, 'deleted', 0, '', 0, <?php echo $item->userid ?>, '<?php echo $item->titel ?>')" > </i>               
              </td>

           </tr>


           <?php
       }
   }
   ?>

</table>

<form id="frmSolve" action="index.php?comp=rekla&task=solveRekla" method="post">
   <input type="hidden" name="id" id="id" value="" />
   <input type="hidden" name="actions" id="actions" value="" />    
   <input type="hidden" name="zahlungsId" id="zahlungsId" value="" />    
   <input type="hidden" name="credits" id="credits" value="" />  
   <input type="hidden" name="user" id="user" value="" />        
   <input type="hidden" name="titel" id="titel" value="" />                
   <input type="hidden" name="email" id="email" value="" />                
   <input type="hidden" name="status" id="status" value="" />    



   <div class="box">
      <h3 style="margin-top: 0">Messaging</h3>
      <p>Für die <strong>Ablehnung</strong> von Reklamationen</p>
      <p>         Die eingestellte Nachricht wird beim Anklicken von Storno versendet</p>

      <select name="message" id="message">
         <option>- keine -</option>
         <option value="zeitraum">Zeitraum seit Kauf: 21 überschritten</option>
         <option value="falsch">falsch / unbegründet</option>
         <option value="frist">21 Tages Frist noch nicht abgelaufen</option>
         <option value="unzureichend">Begründung unzureichend</option>                        
      </select>
   </div>
</form>



<br />



<br />

<div class="box">
   <h3>Legende</h3>
   <p class='small'>
      * Tage von Kauf bis Reklamation (Rekladatum - Kaufdatum - sollten <21 sein) - <br>
      ** Alter der Reklamation (Heute - Rekladatum)
      
   </p>

   <h3>Gründe</h3>
   <p>1 - Anfrage bei Erstkontakt bereits vergeben              
   <p>2 - Anfrage wird nicht umgesetzt</p>                                
   <p>3 - Anfrager innerhalb von 21 Tagen nicht erreicht</p>
   <p>4 - anderer Grund</p>
</div>

<script src="components/rekla/rekla.js"></script>


<?php
unset($_SESSION['msg']);
?>