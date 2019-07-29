<?php 
// model ;)
  $db = IabDB::getInstance();
    
    $db = IabDB::getInstance();
    $q = "SELECT * "
            . " FROM j25f_zahlungen "
             ." WHERE userid = " . $ent->owner  . ""
            . " AND (anfrage = 3 OR anfrage = 6 OR anfrage = 12 OR status = 'creditkauf')"  // only load premium RE
            . " ORDER BY id DESC LIMIT 30";
    
    $query = $db->query($q);
    $items = $db->loadObjectList($query);

    
    
?>



<div class="box" >
   <h2><i class='icon-printer2'></i>Bisherige Rechnungen öffnen</h2>

   <style>
      .adminlist td {border-bottom: 1px dotted white}
   </style>

   <table id="rechnungen" class="list striped">

      <tr>
         <th>Datum</th>
         <th>status</th>
         <th>Button</th>
      </tr>
      
      <tbody>
         </tbody>

      <?php


      foreach ($items as $rechnung) {
        
          ?>
          <tr>
             <td>
                 <?php echo $rechnung->datum; ?>
             </td>
             <td>
                 <?php
                 // RE-Daten darstellen
                 if ($rechnung->status == "Rechnung gestellt") {
                     ?>
                    RE gestellt<br />
                       <button class="bookPremiumPayment small" data-id="<?php echo $rechnung->id ?>" >Zahlung verbuchen</button><br />
                    

                    <?php
                } else {
                    echo $rechnung->status;
                }
                ?>
             </td>
             <td>

                <?php
                // BUTTON "RECHNUNG ÖFFNEN"

                if (strlen($ent->ustid) > 10 and $ent->land != "Deutschland") {
                    // NETTO RECHNUNGen
                    if ($rechnung->status == "Completed") {
                        // Rechnung aus anfragenkauf, netto
                        $doc = "rechnung-nettobasis.php";
                        
                    } else {
                        // Rechnung aus premium, netto
                        $doc = "rechnung-premium-listing-netto.php";
                    }
                } else {
                    // BRUTTO RECHNUNGen
                    if ($rechnung->status == "Completed") {
                        // Rechnung aus anfragenkauf, brutto
                        $doc = "rechnung.php";
                       
                    }
                    if ($rechnung->status == "Premium erhalten" || $rechnung->status == "Rechnung gestellt") {
                        $doc = "rechnung-premium-listing.php";
                    }

                    if ($rechnung->status == "creditkauf") {
                        $doc = "rechnung-credits.php";
                    }
                }

                // für einzelne Credits-Zahlungen gibts keine Rechnung, sondern nur für andere
                if ($rechnung->status != 'credits') {
                    // Anzahl OS bei Premium Rechnungen extrahieren
                    $tx = explode('->', $rechnung->tx); // tx: Admin->Verzeichnis-> Anzahl Betriebssysteme
                    $numberOS = $tx[2];
                    ?>

                    <form action="<?php echo URLBACKEND . $doc ?>" target="_blank" method="post">

                       <input type="hidden" name="firma" value="<?php echo $ent->title; ?>"  />
                       <input type="hidden" name="strasse" value="<?php echo $ent->strasse; ?>"  />
                       <input type="hidden" name="plz" value="<?php echo $ent->plz; ?>"  />
                       <input type="hidden" name="ort" value="<?php echo $ent->ort; ?>"  />
                       <input type="hidden" name="name" value="<?php echo $ent->person; ?>"  />    
                       <input type="hidden" name="frist" value="<?php echo $ent->confirm; ?>"  />                                  
                       <input type="hidden" name="reid" value="<?php echo $rechnung->id; ?>"  />                                                                                                    
                       <input type="hidden" name="rechnungsdatum" value="<?php echo $rechnung->datum; ?>"  /> 
                       <input type="hidden" name="rechnungsnummer" value="AEV<?php echo date('Y') . "-" . $rechnung->id; ?>"  />                                      
                       <input type="hidden" name="vk" value="<?php echo $rechnung->amount; ?>"  />  
                       <input type="hidden" name="anfrage" value="<?php echo $rechnung->titel; ?>"  />      
                       <input type="hidden" name="monate" value="<?php echo $rechnung->anfrage ?>" /> 
                       <input type="hidden" name="numberOS" value="<?php echo $numberOS ?>" /> 

                       <button class="small">Rechnung <?php echo $rechnung->id ?> öffnen</button>                                                                                                                              
                    </form>
                    <?php
                }
                ?>
             </td>
            
             </td>
          </tr>    


      <?php } ?>

   </table>


   

</div>
