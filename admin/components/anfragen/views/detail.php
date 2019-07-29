<?php
$user = $_SESSION['user'];



if ($item->id) {
    ?>
    <h2><span class="icon-inbox"></span> Anfrage ID <?php echo $item->id ?></h2>
<?php } else { ?>
    <h2><span class="icon-inbox"></span> Neue Anfrage anlegen</h2>
<?php } ?>

<form id="formDetail" action="index.php?comp=anfragen&task=" method="POST" >
   <input type="hidden" name="id" id="id" value="<?php echo $item->id ?>" >

   <?php echo layoutHelper::detailButtons(); ?>



   <div id="rightcol" >

      <?php
      // Projektlink Button
      if ($item->pid < 1) {
          ?>
          <a id="btnCreateProject" class="lens" style="float: right" href="#">Projekt ANLEGEN</a>           
      <?php } else {
          ?>
          <a class="lens" style="float: right" href="index.php?comp=pm&view=detail&id=<?php echo $item->pid; ?>">Projekt ansehen</a>               
          <?php
      }
      ?>



      <div id="fragen" class="box">
         <h2><i class='icon-question'></i>Fragen</h2> 
      </div> 




      <div class="box" style="">
         <h2><i class='icon-folder'></i>History</h2> 
         <table id="tblHistory" class="striped small" >
            <tr><th class="date" >Date</th><th>Action</th></tr>
         </table>

      </div>


   </div>


   <div id="leftcol">
      <br>


      <table class="" style="width: 100%">

         <tr>
            <td class="key">
               <label for="titel">Titel</label>
            </td>
            <td>
               <input type="text" name="titel" id="titel" class="big" style="width: 500px; font-weight: bold"  value="<?php echo $item->titel; ?>" />
            </td>
         </tr>

         <tr>     <td colspan="2">  <hr class="narrow">          </td>      </tr>

         <tr>
            <td class="key">
               <label for="firma">TYP</label>
            </td>
            <td>
               <input name="privat" id="private" type="radio" value="1" <?php
               if ($item->privat == 1) {
                   echo "checked='checked'";
               }
               ?> />privat &nbsp;&nbsp;&nbsp;&nbsp;
               <input name="privat" type="radio" value="0" <?php
               if ($item->privat == "" OR $item->privat == "0") {
                   echo "checked='checked'";
               }
               ?> />öffentlich&nbsp;&nbsp;&nbsp;&nbsp;
               <input name="privat" type="radio" value="5" <?php
               if ($item->privat == "" OR $item->privat == "5") {
                   echo "checked='checked'";
               }
               ?> />Firma&nbsp;&nbsp;&nbsp;&nbsp;                
               <input name="privat" type="radio" value="3" <?php
               if ($item->privat == "" OR $item->privat == "3") {
                   echo "checked='checked'";
               }
               ?> />Stellenangebot&nbsp;&nbsp;&nbsp;&nbsp;                
               <input name="privat" type="radio" value="2" <?php
               if ($item->privat == "" OR $item->privat == "2") {
                   echo "checked='checked'";
               }
               ?> />eigene                
            </td>
         </tr>


         <tr>
            <td class="key">
               <label for="hot">HOT</label>
            </td>
            <td>
               <input name="hot" type="radio" value="0" <?php
               if ($item->hot == "" OR $item->hot == "0") {
                   echo "checked='checked'";
               }
               ?> />lau                
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="hot" type="radio" value="1" <?php
               if ($item->hot == 1) {
                   echo "checked='checked'";
               }
               ?> />HOT 
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="hot" type="radio" value="2" <?php
               if ($item->hot == 2) {
                   echo "checked='checked'";
               }
               ?> />PREMIUM active                
            </td>
         </tr>



         <tr>
            <td class="key">
               <label for="firma">Firma</label>
            </td>
            <td>
               <input type="text" name="firma" id="firma" size="50"   value="<?php echo $item->firma; ?>" />
            </td>
         </tr>

         <tr>
            <td class="key">
               <label for="strasse">Straße/Nr.</label>
            </td>
            <td>
               <input type="text" name="strasse" id="strasse" size="40"   value="<?php echo $item->strasse; ?>" />
               <input type="text" name="hausnummer" id="hausnummer" style="width: 60px;"    value="<?php echo $item->hausnummer; ?>" />
            </td>
         </tr>        


         <tr>
            <td class="key"  valign="top">
               <label for="ort">Ort</label>
            </td>
            <td>
               <input class="text_area" type="text" name="plz" id="plz" style="width: 60px;" value="<?php echo $item->plz; ?>" />

               <input class="text_area" type="text" name="ort" id="ort" value="<?php echo $item->ort; ?>" />
            </td>
         </tr>


         <tr>
            <td class="key">
               <label for="name">Regionalität</label>
            </td>
            <td>
               <input type="radio" name="regional" value="2" <?php if ($item->regional == 2) echo 'checked="checked"' ?>  />NUR regional
               &nbsp;&nbsp;&nbsp;&nbsp;
               <input type="radio" name="regional" value="1" <?php if ($item->regional == 1) echo 'checked="checked"' ?>  />regional bevorzugt
               &nbsp;&nbsp;&nbsp;&nbsp;
               <input type="radio" name="regional" value="-1"  <?php if ($item->regional < 1) echo 'checked="checked"' ?>  />überregional                 
               &nbsp;&nbsp;&nbsp;      
               <?php if ($item->regional > 0) echo "<br> <strong style='color:#C00'>(REGIONAL BEVORZUGT)</strong>"; ?>
            </td>
         </tr>



         <tr>
            <td class="key">
               <label for="name">Name</label>
            </td>
            <td>
               <input type="text" name="anrede" id="anrede" style="width: 50px;"    value="<?php echo $item->anrede; ?>" />
               <input type="text" name="name" id="name" size="40"   value="<?php echo $item->name; ?>" />

            </td>
         </tr>

         <tr>
            <td class="key">
               <label for="name">eMail</label>
            </td>
            <td>
               <input type="text" name="email" id="email" size="50" maxlength="250" value="<?php echo $item->email; ?>" />
            </td>
         </tr>
         <tr>
            <td class="key">
               <label for="firma">Telefon</label>
            </td>
            <td>
               <input type="text" name="telefon" id="telefon" size="50" maxlength="250" value="<?php echo $item->telefon; ?>" />	
            </td>
         </tr>        






         <tr>     <td colspan="2">  <hr class="narrow">          </td>      </tr>

         <tr>
            <td class="key">
               <label for="titel">OS</label>
            </td>
            <td> 
               <!--set to 0 if not checked-->
               <input name="ios" value="" type="hidden" /><input name="android" value="" type="hidden" /><input name="windows" value="" type="hidden" /><input name="rim" value="" type="hidden" />
               <input name="bada" value="" type="hidden" /><input name="symbian" value="" type="hidden" /><input name="browser" value="" type="hidden" /><input name="facebook" value="" type="hidden" />

               <input name="ios" value="ios" type="checkbox" <?php if ($item->ios) echo "checked='checked'"; ?> />iOS &nbsp;&nbsp;&nbsp;
               <input name="android" value="android"  type="checkbox" <?php if ($item->android) echo "checked='checked'"; ?> />android &nbsp;&nbsp;&nbsp;
               <input name="windows" value="windows"  type="checkbox" <?php if ($item->windows) echo "checked='checked'"; ?> />WP7 &nbsp;&nbsp;&nbsp;
               <input name="browser" value="browser"  type="checkbox" <?php if ($item->browser) echo "checked='checked'"; ?> />WebAPP &nbsp;&nbsp;&nbsp;
               <input name="facebook" value="Facebook"  type="checkbox" <?php if ($item->facebook) echo "checked='checked'"; ?> />Facebook &nbsp;&nbsp;&nbsp;

            </td>
         </tr>

         <tr>     <td colspan="2">  <hr class="narrow">          </td>      </tr>



         <tr>
            <td class="key top">
               <label for="titel">Beschreibung</label>
            </td>
            <td>
               <textarea name="description" class="text_area big"  id="description" style="height: 400px" ><?php echo $item->description; ?></textarea>
            </td>
         </tr>

         <tr>
            <td class="key top">
               <label for="titel">Qualifizierung <span class="small">(Öffentlich sichtbare Informationen aus telefonischem Kontakt)</span></label>
            </td>
            <td>
               <textarea name="qualifizierung"  class="text_area"  id="qualifizierung" ><?php echo $item->qualifizierung; ?></textarea>
            </td>
         </tr>        

         <tr>
            <td class="key">
               <label for="titel">Dokument <span class='small'>(öffentlich sichtbar)</span></label>
            </td>
            <td>
               <input name="dokument" type="text" id="dokument" class="big" value="<?php echo $item->dokument; ?>" size="60" placeholder='öffentl. sichtbares Dokument'  />
               <a href="http://app-entwickler-verzeichnis.de/images/uploads/<?php echo $item->dokument; ?>" target="_blank">Anhang öffnen</a>

            </td>
         </tr>


         <tr>
            <td class="key top">
               <label for="detailinfo">Detailinfo (nicht öffentlich sichtbar)</label>
            </td>
            <td>
               <textarea  style="background: #eda" name="detailinfo"  class="text_area" id="detailinfo" ><?php echo $item->detailinfo; ?></textarea>
            </td>
         </tr>   

         <tr>
            <td class="key">
               <label for="detailpdf">Dokument</label>
            </td>
            <td>
               <input  style="background: #eda"  name="detailpdf"  id="detailpdf" type="text" class="big" value="<?php echo $item->detailpdf; ?>" placeholder='nicht öffentl. Dokument' />
               <a href="http://app-entwickler-verzeichnis.de/images/uploads/<?php echo $item->detailpdf; ?>" target="_blank">DetailPDF öffnen</a>                        </td>

         </tr>    



         <tr>
            <td class="key">
               <label for="firma">Budget</label>
            </td>
            <td>
               <input type="text" name="budget" id="budget" class="numeric" value="<?php echo $item->budget; ?>" />
               &nbsp;&nbsp;&nbsp;&nbsp;
               Budget Vorschlag <input type="text" name="budget_vorschlag"  class="numeric" value="<?php echo $item->budget_vorschlag; ?>" />
            </td>
         </tr>    


         <tr>
            <td class="key">
               <label for="firma">Investitionsb.</label>
            </td>
            <td>
               <select name="investitionsbereitschaft">
                  <option <?php if ($item->investitionsbereitschaft == "Projekt wird sicher umgesetzt") echo 'selected="selected"' ?> >Projekt wird sicher umgesetzt</option>
                  <option <?php if ($item->investitionsbereitschaft == "Finanzierung muss noch geklärt werden") echo 'selected="selected"' ?>>Finanzierung muss noch geklärt werden</option>
                  <option <?php if ($item->investitionsbereitschaft == "zunächst nur Preisanfrage") echo 'selected="selected"' ?>>zunächst nur Preisanfrage</option>
               </select>
            </td>
         </tr>


         <tr>
            <td class="key">
               <label for="firma">Recordtime</label>
            </td>
            <td>
               <input type="text" name="recordtime" size="25" value="<?php echo $item->recordtime ?>" />
            </td>
         </tr>       


         <tr>
            <td class="key">
               <label for="firma">Angebotsfrist</label>
            </td>
            <td>
               <input type="text" name="frist"  class="date" value="<?php echo $item->frist ?>" />

            </td>
         </tr>       


         <tr>
            <td class="key">
               <label for="firma">Termin</label>
            </td>
            <td>
               <input type="text" name="termin" class="date" value="<?php echo $item->termin ?>" />

            </td>
         </tr>          




         <tr>
            <td class="key" valign="top">
               <label for="active">Status</label>
            </td>
            <td>
               <input name="active" id="activeon"  type="radio" value="new" <?php
               if ($item->active == "new") {
                   echo "checked";
               }
               ?>/>NEU<br />

               <input name="active"  type="radio" value="1" onclick="checkPrice()" <?php
               if ($item->active == "1") {
                   echo "checked";
               }
               ?>/>aktiv <br />
               <input name="active" id="activeoff" type="radio" value="no" <?php
               if ($item->active == "no") {
                   echo "checked";
               }
               ?>/>Archiv<br />
               <input name="active"  type="radio" value="del" <?php
               if ($item->active == "del") {
                   echo "checked";
               }
               ?>/>deleted                

            </td>
         </tr>       

      </table>
      <hr />







      <h3> Verkaufsdaten</h3>
      <table class="admintable" style="float: left; margin-right: 30px; ">
          <?php ?>
         <tr>
            <td class="key">
               <label for="firma">VK Preis EUR</label>
            </td>
            <td>
               <input type="text" name="vk" id="vk" class="numeric big greenborder"  value="<?php echo $item->vk; ?>" />
            </td>
         </tr>       

         <tr>
            <td class="key"> <label for="verkauft">Anzahl Verkauft</label>      </td>
            <td><input type="text" name="verkauft" id="verkafut" class="numeric" readonly="readonly"  value="<?php echo $item->verkauft; ?>" /></td> 
         </tr>

                    <!-- <tr>
                        <td class="key">
                            <label for="firma">Abschlussdatum</label>
                        </td>
                       
                        <td>
                            <input type="text" name="datumAbschluss" id="datumAbschluss" size="8"  value="<?php echo $item->datumAbschluss; ?>" /> 
                            <span class="small">(TT.MM.JJ)</span>
                        </td>
                        
                    </tr>  -->
      </table>   



      <table id='zahlungen' class="small striped" style="width: 300px; margin-left: 30px; border: 1px solid silver; padding: 2px ">
         <caption style="background: white; font-weight: bold">KÄUFER</caption>
      </table>                    
   </div>




</form>







<hr />






<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
<!--  BENACHRICHTIGUNGEN -->
<div class="box" >   

   <h2>Benachrichtigungen</h2>

   <select id="message" class="big">
      <optgroup label="administrativ">
         <option value="aktiviert" > Aktiviert</option>                                
         <option value="abgelaufen"  > deaktiviert / abgelaufen</option>                                                    
         <option value="nichtErreicht"  > nicht Erreicht - Rückrufbitte</option>                                    
         <option value="aenderung"  > Typänderung: Stellenanzeige</option>                                    
      </optgroup>
      <optgroup label="Rückfragen">
         <option value="details" >Mehr Details</option>            
         <option value="detailsbudget" >Mehr Details und Budget</option>            
         <option value="budget" >Budget zu niedrig (Budgetvorschlag setzen)</option>
         <option value="budget-fehlt" >Budget fehlt (Budgetvorschlag setzen)</option>                            
         <option value="budget-betriebssysteme" >Budget - zu viele Betriebssysteme (BF)</option>                                            
         <option value="betriebssysteme-keinBudgtetVorschlag" >Viele Betriebssysteme - OHNE Budgetvorschlag</option>                                                            
         <option value="umsetzungswille" >Mickey Mouse</option>                                                            
         <option value="webapp" >Vorschlag: Webapp</option>                                            
      </optgroup>

      <optgroup label="Reklamationen">
         <option value="reklamation" >Reklamation / Anfrage aktiv</option>            
         <option value="reklamation-abgelaufener" >Reklamation / Anfrage Inaktiv</option>                            
      </optgroup>

      <optgroup label="Stellenanzeigen">
         <option value="stellenanzeige-aktiv" >Stellenanzeige aktiviert</option>            
      </optgroup>                        
   </select>

   <button id="sendMessage"> Benachrichtigung JETZT senden</button>

   <br />
   <br />

</div>







<hr />




<script src="components/anfragen/anfragen.js"></script>





<?php if ($user->id == $item->id || $user->level < 3) { ?>
    <script>$('#XXXXXdelete').addClass('hidden');</script>
<?php } ?>



