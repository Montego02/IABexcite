<?php
$user = $_SESSION['user'];
$ent = $item; // okay here we call it ent because its so cute

if ($ent->id) {
    ?>
    <h2><span class="icon-globe"></span>  <?php echo $ent->title . " (ID " . $ent->id . ")" ?></h2>
<?php } else { ?>
    <h2><span class="icon-globe"></span> Neuen Firmeneintrag anlegen</h2>
<?php } ?>



<form id="formDetail" action="index.php?comp=verzeichnis&task=" method="POST"  >
   <input type="hidden" name="id" id="id" value="<?php echo $ent->id ?>" >

   <?php echo layoutHelper::detailButtons(); ?>

   <table class="detail" style="width:750px; float: left">

      <tbody><tr>
            <td>
               <label for="entry_name" class="entry_name">Entwickler * </label>
            </td>
            <td>
               <input type="text" value="<?php echo $ent->title ?>" maxlength="50" size="50" name="title" class="required" id="Entwicklername" title="Bitte Entwickler/Firmennamen angeben" >
            </td>
         </tr>
         <tr>
            <td><label for="street" class="street">Straße / Hausnr.  * </label></td>
            <td><input type="text" maxlength="100" value="<?php echo $ent->strasse ?>"  size="50" name="strasse" class="inputbox" id="street">&nbsp;</td>
         </tr>
         <tr>
            <td><label for="postcode" class="postcode">PLZ* / Ort* </label></td>
            <td><input type="text" maxlength="5" size="5" name="plz"  value="<?php echo $ent->plz ?>" class="required" title="Bitte PLZ angeben" id="postcode">&nbsp;

               <input type="text" maxlength="100" size="39" name="ort"  value="<?php echo $ent->ort ?>" class="required" title="Bitte Ort angeben" id="city">&nbsp;
            </td>
         </tr>
         <tr>
            <td><label for="country" class="country">Land </label></td>
            <td>
               <select class="inputbox" size="1" id="country" name="land"  >
                  <option value="Deutschland" <?php if ($ent->land == "Deutschland") echo "selected" ?> >Deutschland</option>
                  <option value="Österreich"  <?php if ($ent->land == "Österreich") echo "selected" ?> >Österreich</option>
                  <option value="Schweiz"  <?php if ($ent->land == "Schweiz") echo "selected" ?> >Schweiz</option>
                  <option value="anderes EU Land"  <?php if ($ent->land == "anderes EU Land") echo "selected" ?> >anderes EU Land</option>
                  <option value="außerhalb EU"  <?php if ($ent->land == "außerhalb EU") echo "selected" ?> >außerhalb EU</option>
               </select>
               &nbsp;</td>
         </tr>
         <tr>
            <td><label for="contact_person" class="contact_person">Kontaktperson </label></td>
            <td><input type="text" maxlength="100" size="40"  value="<?php echo $ent->person ?>"  name="person" class="inputbox" id="person">&nbsp;<span class="small">Vorname/Name</span></td>
         </tr>
         <tr>
            <td><label for="email" class="email">Email  * </label></td>
            <td><input type="text" maxlength="100" size="60" name="email"  value="<?php echo $ent->email ?>"  class="inputbox" id="email">&nbsp;
               &nbsp;&nbsp;                <a href="mailto:<?php echo $ent->email ?>">mailto: <?php echo $ent->email ?></a>

            </td>
         </tr>
         <tr>
            <td><label for="website" class="website">Website </label></td>
            <td><input type="text" maxlength="100" size="60" name="website"   value="<?php echo $ent->website ?>"  class="inputbox" id="website">&nbsp;</td>
         </tr>

         <tr>
            <td valign="top"><label for="backlink" class="backlink">URL des Backlinks </label></td>
            <td><input type="text" size="60" name="backlink" class="inputbox"   value="<?php echo $ent->backlink ?>"  id="backlink">&nbsp;<br>
            </td>
         </tr>
         <tr>
            <td><label for="phone" class="phone">Telefon </label></td>
            <td><input type="text" maxlength="100" size="40" name="telefon"   value="<?php echo $ent->telefon ?>" class="inputbox" id="phone" style="font-size: 14px">&nbsp;</td>
         </tr>

         <tr>
            <td valign="top" ><label for="phone" class="phone">Betriebssysteme<br /><br /><br />
                  1: Eingetragener Entwickler<br />
                  2: Premium Entwickler
                  <br />
                  <br />
               </label></td>
            <td>
               <table width="100%" border="0" cellspacing="1" cellpadding="3">
                  <tr>
                     <td width="20" align="center" bgcolor="#CCCCCC">0</td>
                     <td width="20" align="center" bgcolor="#CCCCCC">1</td>
                     <td width="20" align="center" bgcolor="#CCCCCC">2</td>
                     <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
                  </tr>      

                  <tr>
                     <td align="center"><input name="ios" value="0" type="radio" /></td>
                     <td align="center"><input type="radio" name="ios" value="1"  <?php if ($ent->ios == 1) echo "checked='checked'" ?> /></td>
                     <td align="center"><input type="radio" name="ios" value="2"  <?php if ($ent->ios == 2) echo "checked='checked'" ?> /></td>
                     <td>iOS</td>
                  </tr>
                  <tr>
                     <td align="center"><input name="android" value="0" type="radio" /></td>
                     <td align="center"><input name="android" value="1" type="radio" <?php if ($ent->android == 1) echo "checked='checked'" ?> /></td>
                     <td align="center"><input name="android" value="2" type="radio" <?php if ($ent->android == 2) echo "checked='checked'" ?> /></td>
                     <td align="left">Android</td>
                  </tr>
                  <tr>
                     <td align="center"><input name="windows" value="0" type="radio" /></td>
                     <td align="center"><input name="windows" value="1" type="radio" <?php if ($ent->windows == 1) echo "checked='checked'" ?> /></td>
                     <td align="center"><input name="windows" value="2" type="radio" <?php if ($ent->windows == 2) echo "checked='checked'" ?> /></td>
                     <td><label for="windows">Windows Phone 7</label></td>
                  </tr>
                  <tr>
                     <td align="center"><input name="rim" value="0" type="radio" /></td>
                     <td align="center"><input name="rim" value="1" type="radio" <?php if ($ent->rim == 1) echo "checked='checked'" ?> /></td>
                     <td align="center"><input name="rim" value="2" type="radio" <?php if ($ent->rim == 2) echo "checked='checked'" ?> /></td>
                     <td>Blackberry</td>
                  </tr>
                  <tr>
                     <td align="center"><input name="web" value="0" type="radio" /></td>
                     <td align="center"><input name="web" value="1" type="radio" <?php if ($ent->web == 1) echo "checked='checked'" ?> /></td>
                     <td align="center"><input name="web" value="2" type="radio" <?php if ($ent->web == 2) echo "checked='checked'" ?> /></td>
                     <td><label for="browser">Browser / Web-Apps</label></td>
                  </tr>
                  <tr>
                     <td align="center"><input name="facebook" value="0" type="radio" /></td>
                     <td align="center"><input name="facebook" value="1" type="radio" <?php if ($ent->facebook == 1) echo "checked='checked'" ?> /></td>
                     <td align="center"><input name="facebook" value="2" type="radio" <?php if ($ent->facebook == 2) echo "checked='checked'" ?> /></td>
                     <td>Facebook</td>
                  </tr>

               </table></td> 
         </tr>
         <tr>
            <td><label for="description" class="description">Firmenbeschreibung </label></td>
            <td><textarea class="inputbox" name="beschreibung" id="description" cols="50" rows="5"><?php echo $ent->beschreibung ?></textarea>&nbsp;</td>

         <tr>
            <td colspan="2"><hr class="trenner">
               <h3>Firmenlogo und Metadaten</h3>
            </td>
         </tr>

         <tr>
            <td><label  >Icon</label>
            </td>
            <td>
               <input size="20" class="inputbox"  name="icon" value="<?php echo $ent->icon ?>">	<img src="http://app-entwickler-verzeichnis.de/images/ents/<?php echo $ent->icon ?>" width="50" />
            </td>             
         <tr>

         <tr>
            <td><label for="sobi2Ico" >Owner (Joomla Benutzer)</label>
            </td>
            <td>
               <input size="4" class="inputbox"  name="owner" value="<?php echo $ent->owner ?>">
            </td>             
         <tr>
            <td><label for="ustid" class="ustid">Ust-IdNr. </label></td>
            <td><input type="text" maxlength="14" size="14"    value="<?php echo $ent->ustid ?>"  name="ustid" class="inputbox" id="ustid">&nbsp;<br>
         </tr>

         <tr>
            <td><label for="sobi2MetaKey" class="sobi2MetaKey">Meta Keywords<br>
                  (kommagetrennt)</label></td>
            <td>
               <textarea class="short" id="sobi2MetaKey" name="metakey"  class="inputbox"><?php echo $ent->metakey ?> </textarea>&nbsp;
            </td>
         </tr>
         <tr>
            <td><label for="sobi2MetaDesc" class="sobi2MetaDesc">Meta Beschreibung</label></td>
            <td>
               <textarea class="short"  id="sobi2MetaDesc" name="metadesc" class="short"  class="inputbox"><?php echo $ent->metadesc ?></textarea>&nbsp;
            </td>
         </tr>

         <tr>
            <td colspan="2"><hr class="trenner">
               <h3>ADMINISTRATIV</h3>
            </td>
         </tr>

         <tr>
            <td><label >Score</label></td>
            <td><input name="score" size="5" value="<?php echo $ent->score ?>"   />              </td>
         </tr>

<!--               <tr>
                  <td><label>Special</label></td>
                  <td><input name="special" size="5" value="<?php echo $ent->special ?>"   /> spec = Special User mit Vermittlungsvertrag
                  </td>
               </tr>-->
         <tr>
            <td><label>Published</label></td>
            <td><input name="published" class="numeric" value="<?php echo $ent->published ?>"   /> 0: DEAKTIVIERTER EINTRAG  |  1: aktiv
            </td>
         </tr>             
         <tr>
            <td><label>Confirmed</label></td>
            <td><input name="confirm" class="numeric" value="<?php echo $ent->confirm ?>"   /> Datum ('YYYY-MM-DD') = Bezahlter Premiumeintrag bis [Datum]
            </td>
         </tr> 

         <tr>
            <td colspan="2"><hr class="trenner">			    <h3>Mailer</h3>				</td>             </tr>

         <tr style="padding-top: 10px">

            <td colspan="2">
               <a id="btnSendActivatedMessage" class="lens" >"Aktiviert Info" mailen</a>

               <a class="lens" href="mailto:<?php echo $ent->email ?>?subject=Rechnung für Ihren Premium-Eintrag im AEV&body=<?php include ('components/verzeichnis/mails/rechnung.php'); ?>">Rechnung mailen</a>

            </td>
         </tr> 

      </tbody>
   </table>

   <div id="kommentare" style="width: 305px; padding: 20px; float: right; margin: 20px 0 0 20px; background: #eee">
      <h3>Interne Kommentare</h3>
      <textarea name="kommentar" rows="10" style="width: 290px; font-size: 10px"><?php echo $ent->kommentar ?></textarea>
      <hr class="clearall" />
   </div>

   <div id="stornoQuota" style="">
      <h2 style="font-size: 60px; text-align: center"></h2>
      <p class="small" style="text-align: center">Quote <b>nicht</b> reklamierter Anfragen</p>
      <hr>
      <div style="text-align: center"></div>
   </div>


   <hr class="clearall"        />


</form>



<?php
//    R E F E R E N Z   -  A P P S
/* $db =& JFactory::getDBO();
  $query = "SELECT * FROM #__apps WHERE owner = ".JRequest::getVar('itemid');
  $db->setQuery($query);
  $column= $db->loadResultArray();

  @print_r(implode(",",$colum));
 */
?>





<!--  Rechnung erstellen für Premiumeintrag  -->

<hr />

<div class='flexRow equal'>
   <div class="box2" >
      <h2><i class='icon-file-plus'></i> Premium-Rechnung erstellen</h2>    

      <style>
          #frmInvoice select {margin: 6px 10px 6px 0}
      </style>

      <form id="frmInvoice" action="ajx" method="post">

         <select name="anfrage">
            <option>3</option>
            <option>6</option>
            <option>12</option>
         </select> <strong>Monate</strong> <span class="small">(setzt AID des Kauf auf Anzahl der Monate (wichtig!))</span>
         <br />

         <select name="numberOS">
            <option>1</option><option>2</option><option>3</option><option>4</option>
         </select> <strong>Anzahl OS</strong> <span class="small">(setzt tx für Textausgabe in RE)</span>
         <br />


         <select name="amount">
            <!--
            reduzierter Preis
            <optgroup label="3 Monate">
                    <option value="428.4">1 OS (EUR 360 netto)</option>
                    <option value="571.2">2 OS (EUR 480 netto)</option>
                    <option value="690.2">3 OS (EUR 580 netto)</option>
                    <option value="809.2.6">4 OS (EUR 680 netto)</option>                                    
            </optgroup>
            <optgroup label="6 Monate">
                    <option value="690.2">1 OS (EUR 580 netto)</option>
                    <option value="928.2">2 OS (EUR 780 netto)</option>
                    <option value="1166.2">3 OS (EUR 980 netto)</option>
                    <option value="1285.2">4 OS (EUR 1080 netto)</option>                                    
            </optgroup>     
            -->
            <?php
            // premium prices
//$pricePrem3 = [0, 360, 480, 580, 680]; // till 05/2018
//$pricePrem6 = [0, 660, 890, 1090, 1290]; // till 05/2018
            $pricePrem3 = [0, 420, 540, 640, 740]; // from 05/2018
            $pricePrem6 = [0, 740, 980, 1160, 1290];
            ?>



            <optgroup label="3 Monate">
               <option value="<?php echo $pricePrem3[1] * 1.19; ?>">1 OS (EUR <?php echo $pricePrem3[1] ?> netto)</option>
               <option value="<?php echo $pricePrem3[2] * 1.19; ?>">2 OS (EUR <?php echo $pricePrem3[2] ?> netto)</option>
               <option value="<?php echo $pricePrem3[3] * 1.19; ?>">3 OS (EUR <?php echo $pricePrem3[3] ?> netto)</option>
               <option value="<?php echo $pricePrem3[4] * 1.19; ?>">4 OS (EUR <?php echo $pricePrem3[4] ?> netto)</option>                                    
            </optgroup>
            <optgroup label="6 Monate">
               <option value="<?php echo $pricePrem6[1] * 1.19; ?>">1 OS (EUR <?php echo $pricePrem6[1] ?> netto)</option>
               <option value="<?php echo $pricePrem6[2] * 1.19; ?>">2 OS (EUR <?php echo $pricePrem6[2] ?> netto)</option>
               <option value="<?php echo $pricePrem6[3] * 1.19; ?>">3 OS (EUR <?php echo $pricePrem6[3] ?> netto)</option>
               <option value="<?php echo $pricePrem6[4] * 1.19; ?>">4 OS (EUR <?php echo $pricePrem6[4] ?> netto)</option>                                    
            </optgroup>    
            <optgroup label="12 Monate">
               <option value="1487.5">1 OS (EUR <?php echo $pricePrem12[1] ?> netto)</option>
               <option value="2011.1">2 OS (EUR <?php echo $pricePrem12[2] ?> netto)</option>
               <option value="2368.1">3 OS (EUR <?php echo $pricePrem12[3] ?> netto)</option>
            </optgroup>    

         </select>

         (siehe <a href="http://app-entwickler-verzeichnis.de/premium-app-programmierung" target="_blank">Preise</a>)
         <br />

         <input size="5" class="inputbox"  name="userid" value="<?php echo $ent->owner ?>"> User ID


         <br /><br />


         <button id="btnGenerateInvoice">Rechnung erstellen</button><br />
         <p class="small">Die Rechnung wird in der Tabelle "zahlungen" als "Rechnung gestellt" eingetragen.</p>


      </form>


      <br />
      <br />





      <a href="#rechnungen"></a>
      <h3 >Vorhandene Rechnungen ansehen</h3>    
      <a href="https://app-entwickler-verzeichnis.de/gekaufte-anfragen?userid=<?php echo $ent->owner ?>">Gekaufte Anfragen</a>
   </div>

   <?php
// "bisherige Rechnungen öffnen"
   include 'components/verzeichnis/views/detailRechnungen.php';
   ?>

</div>

<hr class="clearall" />



<script src="components/verzeichnis/verzeichnis.js"></script>

<script>




    // load zahlungen - see detailRechungen
//         $.ajax({url: "/admin/components/verzeichnis/ajaxControllerVerzeichnis.php?task=getZahlungen",
//            type: "POST",
//            dataType: 'json',
//            data: {userid: $('input[name="owner"]').val()}
//        })
//                .done(function (rtn) {
//                    $.each(rtn, function(i, z) {
//                        var html = "<tr><td>"
//                        
//                    });
//                    
//                
//                })
//
//                .fail(function (rtn) {
//                    console.log('fail');
//                });
</script>





