
<style>
   form {font-size: 13px}

   .heading {background: #ddd; font-size: 15px; width: 500px}
   .itemtext {width: 600px; margin-right: 20px; font-family: arial}
   .itemstundensatz, .itemstunden {width: 25px}
   .new {color: #888; font-style: italic}
   input, textarea {font-size: 14px}
   textarea {display: inline-block}
   input.heading {margin: 4px 0px; padding: 3px 5px}
   .dragger {cursor: pointer; font-size: 11px; font-weight: bold; margin: 4px 0; padding: 3px 6px; border: 1px solid silver; background: #ddd; display: inline-block ; width: 20px; line-height: 16px}
   #blatt {width: 1000px; }

   #print {font-size: 14px; position: absolute; padding: 40px; top: 0; left: 0; width: 100%; height: 2000px; background: white; z-index: 1; display: none}
   #print p, #print a, #print table td {font-size: 14px;}
   .eur {font-weight: bold; font-size: 16px; text-align: right; width: 100px}
   #print input {border: none; }
   #print .noprint {display: none}
   #print h1, #print h2 {color: black}
   .del {border-radius: 4px; background: #222;  font-weight: bold; color: white}

   #angebotprint {padding: 20px; border: 1px solid #555; width: 850px}

   #angebotprint .boxHeading {display: block; width: 100%; margin: 15px 0 6px 0; padding-bottom: 4px; border-bottom: 1px dotted #000;}
   #angebotprint .heading { background: none; font-weight: bold}

   #print .boxHeading .dragger, #print .divider .dragger {display: none}
   #print .dragger {padding:1px 3px; background: none; border: none}
   .sum {font-size: 16px; font-weight: bold; padding: 10px 0; border-top: 2px solid #000; border-bottom: 2px solid #000; margin-top: 12px}

   .nobreak {page-break-inside: avoid}
   .divider {margin: 20px 0 -10px 0; }
   .divider input {background: none; font-size: 18px}

</style>

<div id="print">
   <div id="blatt">
      <div id="headpic" style="display: block; width: 100%; text-align: right">
         <img height="90" width="227" src="http://www.app-entwickler-verzeichnis.de/images/corporate/iab.png">
         <!--	<img src="images/corporate/head.png" />
         -->
      </div>


      <div id="iab" class="small" style="text-decoration: underline">
         <br /><br /><br /><br /><br />
         INTERNETAGENTUR BODENSEE &middot; GRÜNER-TURM STR. 16 &middot; 88212 RAVENSBURG

      </div>


      <p style="font-size:15px; padding: 5px 0">
          <?php
          echo $anfrage->firma . "<br />";
          echo $anfrage->anrede . " " . $anfrage->name . "<br />";
          echo $anfrage->strasse . " " . $anfrage->hausnummer . "<br />";
          echo $anfrage->plz . " " . $anfrage->ort . "<br />";
          echo $anfrage->land . "<br />";
          ?>
      </p>


      <p style="text-align: right; padding-right: 25px"><?php echo $anfrage->datumAngebot; ?></p>

      <h1>Angebot <?php echo $anfrage->id ?></h1>
      <br > <br >
      <p>Sehr

         <?php if ($anfrage->anrede == 'Herr') { ?>
             geehrter Herr <?php
             echo $anfrage->name;
         } else {
             ?>
             geehrte Frau <?php
             echo $anfrage->name;
         }
         ?>,</p>
      <br >
      <p>Vielen Dank für Ihre Anfrage <b>"<?php echo $anfrage->titel; ?>"</b>.
      <p>Bitte finden Sie nachfolgend unser detailiertes Angebot dazu.</p>
      <br >




   </div>

</div>


<div id="angebot">



   <div class="noprint">
      <a class="lens" style="font-size: 14px; padding: 4px 20px" href="index.php?comp=anfragen&view=detail&id=<?php echo $anfrage->id ?>"> < <?php echo $anfrage->id ?> </a>

      <h1 style="margin-left: 0"><?php echo $anfrage->titel ?></h1> 
      Firma: <?php echo $anfrage->firma ?> | Name: <?php echo $anfrage->name ?>
      <hr>
   </div>
   <form action="index.php" method="post" name="adminForm" id="angebote" >

      <div id="items">

         <?php
         $counter = 1;
         foreach ($items as $item) {
             if (strlen($item->text) > 1) {
                 switch ($item->typ) {
                     case 1:// Überschrift  
                         ?>

                         <div class='boxHeading'>
                            <div class='dragger center'><></div>
                            <input class='heading' name='text[]' value='<?php echo $item->text ?>'>
                            <input type='hidden' name='type[]' value='<?php echo $item->typ ?>'> 
                            <input type='hidden' name='stundensatz[]' value='0'>
                            <input type='hidden' name='stunden[]' value='0'>
                            <input type='hidden' name='itemid[]' value='<?php echo $item->id ?>'>

                         </div>

                         <?php
                         break;
                     case 2: // position
                         $sum += $item->stunden * $item->stundensatz;
                         ?>
                         <div class='boxItem'>
                            <div class='dragger'><?php echo $item->id ?></div>
                            <textarea class='itemtext ' name='text[]' rows="1" ><?php echo $item->text ?></textarea>
                            <input class='itemstundensatz noprint' name='stundensatz[]' value='<?php echo $item->stundensatz ?>'>           
                            <input class='itemstunden noprint' name='stunden[]' value='<?php echo $item->stunden ?>'>           
                            <input type='hidden' name='type[]' value='2'> 
                            <input type='hidden' name='itemid[]' value='<?php echo $item->id ?>'>
                            EUR <input class="eur" value="<?php echo ($item->stunden * $item->stundensatz); ?>">

                         </div>

                         <?php
                         break;

                     case 3: // divider to optional
                         ?>
                         <div class = 'divider '>
                            <div class = 'dragger'>  <>                      </div>
                            <input class='itemtext ' name='text[]' value='<?php echo $item->text ?>'>
                            <input  type='hidden'  class='itemstundensatz noprint' name='stundensatz[]' value='<?php echo $item->stundensatz ?>'>           
                            <input  type='hidden'  class='itemstunden noprint' name='stunden[]' value='<?php echo $item->stunden ?>'>           
                            <input type='hidden' name='type[]' value='3'> 
                            <input type='hidden' name='itemid[]' value='<?php echo $item->id ?>'>

                         </div>
                         <?php
                         break;
                 }
             }
             $counter++;
         }
         ?>

         <div id="sumline" style=" width: 910px; text-align: right; font-weight: bold; font-size: 18px">
            EUR &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $sum ?>
         </div>

      </div>         

      <div class="noprint">
         <button class="addheading">add heading</button>
         <button class="additem">add item</button> 
         &nbsp;

         <select class="presetItems">
            <option value="0">- Baustein wählen -</option>
            <optgroup label="Projektmanagement">
               <option value="1702">Kunden-Beratung, Reporting, Team-Management</option>
            </optgroup>
            <optgroup label="Design">
               <option value="1704">Redesign incl. Bild</option>
               <option value="223">App Icon und Menu</option>
               <option value="224">App Screens Smartphone/Tablet</option>
            </optgroup>


            <optgroup label="WEB">
               <option value="1709">Umsetzung Design in HTML</option>
               <option value="155">Joomla 3.x</option>
               <option value="1706">IAB Excite</option>
               <option value="200">WebApp Core</option>
               <option value="159">Individueller Shop</option>
               <option value="199">Testing Browser</option>

            </optgroup>
         </select>

         <button class="addDivider">add Divider to optional</button>


         <input type="hidden" name="user" value="<?php echo $user->id ?>" />  
         <input type="hidden" name="anfrage" value="<?php echo $anfrage->anfrage ?>" />    
         <input type="hidden" name="option" value="com_pm" />    
         <input type="hidden" name="task" value="saveAngebot" />
         <input type="hidden" name="controller" value="pm" />     



         <hr >
         <button type="submit" style="font-weight: bold">SPEICHERN</button> <i>- dann -</i>
         <button class="print">Angebot drucken</button>

         <div style="float:right">
            Copy to Anfrage #
            <select name="copyanfrage">
               <option value="0"> - AID -</option>
               <?php
//               require_once (JPATH_COMPONENT . '/helpers/pm.php');
//               $offeneAnfragen = PmHelper::getProjectIdsWithoutAngebot();
//               foreach ($offeneAnfragen as $aid) {
//                   ?>
                   <option>//<?php echo $aid ?></option>
                   //<?php
//               }
               ?>
            </select>

            <button type="Submit">Copy</button>
         </div>

      </div>
   </form>

</div>




<script type="text/javascript">
    console.log('before dom');
    $(document).ready(function () {

        console.log('ready');

        //noi = <?php echo $counter ?>; //number of items

        $('button.addheading').click(function (e) {
            e.preventDefault();
            var html = "<div class='pos '><div class='dragger'>neu</div> <input class='heading new' name='text[]' value='Überschrift'><input type='hidden' class='itemstundensatz' name='stundensatz[]' value='0'>     <input type='hidden' class='itemstunden' name='stunden[]' value='0'>    <input type='hidden' name='type[]' value='1'> <input type='hidden' name='itemid[]' value='0'> </div>";
            $('#items').append(html);

        });

        $('button.additem').click(function (e) {
            e.preventDefault();
            var html = "<div class='pos '><div class='dragger'>neu</div> \n\
                <textarea class='itemtext new' name='text[]' rows='1' >Positionsbeschreibung</textarea><input class='itemstundensatz new noprint' name='stundensatz[]' value='90'>     <input class='itemstunden new noprint' name='stunden[]' value='1'>   <input type='hidden' name='type[]' value='2'> <input type='hidden' name='itemid[]' value='0'> <input class='eur' name='sum[]' value='0'>    </div>";
            //alert(html);
            $('#items').append(html);

        });


        $('button.addDivider').click(function (e) {
            e.preventDefault();
            var html = "<div class='divider'><div class='dragger'><></div> <input class='' name='text[]' value='Optionale Positionen'><input type='hidden' class='' name='stundensatz[]' value='0'>     <input type='hidden' class='' name='stunden[]' value='0'>    <input type='hidden' name='type[]' value='3'> <input type='hidden' name='itemid[]' value='0'> </div>";
            $('#items').append(html);

        });

        $('button.print').click(function (e) {
            e.preventDefault();
            window.location.href = "index.php?comp=pm&view=angebot&layout=print&id=<?php echo $anfrage->anfrage; ?>";
            //            var htmlcode = $('#angebot').html();
            //            
            //                            
            //            // summe ausrechnen und anhängen
            //            var sum = 0; // gesamtsumme
            //            html += "<div class='sum'><span style='width: 660px; display: inline-block'>Gesamt netto</span> EUR ";
            //            $('.eur').each(function() {
            //                sum += parseInt($(this).val());
            //            });
            //            html += "<span style='width: 100px; text-align: right; display: inline-block'>" +sum + "</span></div>";            
            //            $('#angebotprint').append(html)
            //            $('#print').css('display', 'block');
            //            $('#header-box').css('display', 'none');
            //            document.title = "Angebot_<?php echo date('Y', time()) . '-' . $anfrage->id ?>";   
        });

        // neues inputfeld bei klick leeren
        $('body').on('click', 'input.new', function (event) {
            $(this).removeClass('new');
            $(this).val('');
        });

        // neues textarea bei klick leeren
        $('body').on('click', 'textarea.new', function (event) {
            $(this).removeClass('new');
            $(this).html('');
        });


        $('#print').click(function (e) {
            $('#angebotprint').html('');
            $(this).css('display', 'none');
        });

        if ($('.itemtext').length == 0) {
            $('button.addheading').trigger('click');
            $('button.additem').trigger('click');
        }


        // set rows in textarea dynamically
        $('.itemtext').keydown(function () {
            var actualLength = $(this).val().length;
            var cols = 80;
            var lineheight = 24;

            if (actualLength == cols || actualLength == cols * 2 || actualLength == cols * 3) {
                var heightToBe = parseInt((actualLength / cols + 1) * lineheight);
                $(this).css('height', heightToBe + 'px');
            }


        });


        // load and add predefined items
        $('.presetItems').change(function (e) {
            e.preventDefault();

            var itemid = $(this).val();

            if (itemid > 0) {
                var request = $.ajax({
                    url: "index.php?option=com_pm&task=loadItem",
                    type: "POST",
                    data: {itemid: itemid}
                });
            }

            request.done(function (daten) {
                console.log(daten);
                $('#items').append(daten);
            });

            request.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        })






        $(function () {
            $("#items").sortable();
            $("#items").disableSelection();
        });

        //        
        //        $('button.del').click(function(e){   
        //            e.preventDefault();
        //            $(this).parent().remove();
        //        });
        //        

    });




</script>