<?php 
require_once 'components/pm/helpers/pm.php';


$user = $_SESSION['user'];


if($item->id) { ?>
<h1><span class="icon-wrench"></span> <?php echo $anfrage->firma ?> / <?php echo $anfrage->name ?> (ID <?php echo $item->id ?>)</h1>
<?php } else { ?>
<h2><span class="icon-wrench"></span> Neues Projekt anlegen</h2>
<?php } ?>


<form id="formDetail" action="index.php?comp=pm&task=" method="POST" >
    <input type="hidden" name="id" id="id" value="<?php echo $item->id ?>" >

<?php echo layoutHelper::detailButtons(); ?>


        <table class="admintable" style="width: 510px; float: left">

            <tr><td colspan="2">  
                    <h3>Angebotsdaten</h3>
                </td></tr>

            <tr>
                <td align="right" class="key">
                    <label>Angebotsdatum</label>
                </td>
                <td>                   
                    <input value="<?php echo $item->datumAngebot; ?>" maxlength="10" size="10" name="datumAngebot" id="datumAngebot"  class="datepicker" />                           
                    <span class="small"></span>
                </td>
            </tr>     


            <tr>
                <td align="right" class="key">
                    <label>Preis Intern</label>
                </td>
                <td>                   
                    <input value="<?php echo $item->preisIntern; ?>" maxlength="10" size="10" name="preisIntern" />                           
                    <span class="small">Preis lt. interner Kostenkalkulation</span>
                </td>
            </tr>                  

            <tr>
                <td align="right" class="key">
                    <label>Preis Extern</label>
                </td>
                <td>             
                    <?php
                    if ($this->angebot) {
                        foreach ($this->angebot as $a) {
                            if (strlen($a->text) > 1) {
                                $sum += $a->stundensatz * $a->stunden;
                            }
                        }
                    }

                    if ($item->preisExtern == 0 && $sum > 0) {
                        $ab = $sum;
                        $priceFromAngebot = 1;
                    } else {
                        $ab = $item->preisExtern;
                    }
                    ?>


                    <input value="<?php echo $ab; ?>" maxlength="10" size="10" name="preisExtern" id="preisExtern" />                           

                    <?php if ($sum != 0) { ?>
                        <span class="small">(SUMME lt. ANGEBOT)</span>
                        <a href="index.php?comp=pm&view=angebot&id=<?php echo $item->anfrage ?>"  class="button" title="Angebot-Neu">Angebot öffnen</a>
                    <?php } else { ?>
                        <span class="small"></span>
<!--                        <button class="btnAbschlag" title="Angebot-Neu">Pauschalangebot</button>-->
                        <a class="btn" style="display: block; margin: 20px" href="index.php?comp=pm&view=angebot&id=<?php echo $item->anfrage ?>"  title="Angebot-Neu">Angebot generieren</a>
                    <?php } ?>





                </td>
            </tr>          
            <tr>
                <td align="right" class="key">
                    <label>Datum Annahme</label>
                </td>
                <td>                   
                    <input value="<?php echo $item->datumAngebotAngenommen; ?>" maxlength="10" size="10" name="datumAngebotAngenommen" id="datumAngebotAngenommen"  class="datepicker"  />                           
                    <span class="small"></span>
                </td>
            </tr>     
            <tr>
                <td align="right" class="key">
                    <label>Anschreiben</label>
                </td>
                <td>                   
                    <textarea name="anschreiben"><?php echo htmlspecialchars($item->anschreiben); ?></textarea>
                </td>
            </tr>    



            <!--Vertrag-->
            <tr><td colspan="2">  
                    <h3>Werkvertrag</h3>
                </td></tr>

            <tr>
                <td align="right" class="key">
                    <label>Datum Werkvertr.</label>
                </td>
                <td>                   
                    <input value="<?php echo $item->datumVertrag; ?>" maxlength="10" size="10" name="datumVertrag" id="datumVertrag"  class="datepicker"  />                           
                    <span class="small">Datum Erstellung/Zusendung</span>
                </td>
            </tr>     

            <tr>
                <td align="right" class="key">
                    <label>Version</label>
                </td>
                <td>                   
                    <input value="<?php echo $item->versionVertrag; ?>" maxlength="10" size="10" name="versionVertrag" />                           
                    <span class="small">Versionsstand des WV</span>
                </td>
            </tr>     

            <tr>
                <td align="right" class="key">
                    <label>Datum Unterzeichn.</label>
                </td>
                <td>                   
                    <input value="<?php echo $item->datumVertragUnterzeichnung; ?>" maxlength="10" size="10" name="datumVertragUnterzeichnung" id="datumVertragUnterzeichnung"  class="datepicker"  />                           
                    <span class="small">Datum Unterzeichn. Kunde</span>
                </td>
            </tr>    

            <tr>
                <td align="right" class="key">
                    <label>generieren</label>
                </td>
                <td>                   
                    <button id="btnWerkvertrag">Werkvertrag anzeigen</button>

                </td>
            </tr>    


            <tr><td colspan="2"><hr>   
                    <h3>Abschlagszahlung</h3>

                </td></tr>

            <tr>
                <td align="right" class="key">
                    <label>Datum Rechnung</label>
                </td>
                <td>                   
                    <input value="<?php echo $item->datumAbschlagRechnung; ?>" maxlength="10" size="10" name="datumAbschlagRechnung" id="datumAbschlagRechnung"  class="datepicker" placeholder="frei lassen für 40%" />                           
                    <span class="small"></span>
                </td>
            </tr>     


            <tr>
                <td align="right" class="key">
                    <label>Betrag</label>
                </td>
                <td>                   
                    <input value="<?php echo $item->preisAbschlag; ?>" maxlength="10" size="10" name="preisAbschlag" id="preisAbschlag"                          />                           
                    <span class="small"></span>
                </td>
            </tr>                            

            <tr>
                <td align="right" class="key">
                    <label>Datum Zahlungseingang</label>
                </td>
                <td>                   
                    <input value="<?php echo $item->datumAbschlagEingang; ?>" maxlength="10" size="10" name="datumAbschlagEingang" id="datumAbschlagEingang" class="datepicker"  />                                              
                </td>
            </tr>  


            <tr>
                <td align="right" class="key">
                    <label></label> 
                </td>
                <td>    
                    <button class="btnAbschlag" title="Abschlag">Abschlag-RE generieren</button>
                </td>
            </tr>


            <!-- Zusatzaufwendungen             -->
            <tr><td colspan="2"><hr>   
                    <h3>Zusätze</h3>
                </td></tr>

            <tr>
                <td align="right" class="key">
                    <label>Liste Zusatzaufwand</label>
                    <button class="btnAbschlag" title="Angebot">Angebot erstellen</button>
                </td>
                <td>                   
                    <textarea style="height: 75px" name="zusatzaufwand" id="zusatzaufwand" class=""  ><?php echo $item->zusatzaufwand; ?></textarea>
                    <br />
                    <p class="small">CSV: [status], datum, text, h, betrag (ohne Währung)<strong>;</strong><br /> 
                        [status]: [a] Angeboten &middot; [b] beauftragt  &middot; [+] abrechenbar &middot; [e] erledigt & abgerechnet &middot; [x] rejected</p>

                </td>
            </tr>     




            <!--RECHNUNG             -->
            <tr><td colspan="2"><hr>   
                    <h3>Rechnung</h3>
                </td></tr>

            <tr>
                <td align="right" class="key">
                    <label>Datum Rechnung</label>
                </td>
                <td>                   
                    <input value="<?php echo $item->datumRechnung; ?>" maxlength="10" size="10" name="datumRechnung" id="datumRechnung" class="datepicker"  />                           
                    <span class="small">Rechnungsstellung</span>
                </td>
            </tr>     

            <tr>
                <td align="right" class="key">
                    <label>Datum Zahlungseingang</label>
                </td>
                <td>                   
                    <input value="<?php echo $item->datumRechnungEingang; ?>" maxlength="10" size="10" name="datumRechnungEingang" id="datumRechnungEingang" class="datepicker"  />                                              


                    <div style="float: right; text-align: right">
                        <input id="notDE" type="checkbox" name="notDE" value="1"  > NETTO
                    </div>                   

                </td>
            </tr>  
            <tr>
                <td align="right" class="key">
                    <label></label> 
                </td>
                <td>    


                    <button class="btnAbschlag" title="Final">Pauschal-Rechnung </button>
                    <a href="index.php?comp=anfragen&view=detail&id=<?php echo $item->anfrage ?>"  class="button" title="Angebot-Neu">RE mit Einzelpositionen</a>
                </td>
            </tr>             





            <tr><td colspan="2"><hr>   
                    <h3>Administrativ</h3>
                </td></tr>

            <tr>
                <td align="right" class="key">
                    <label>Status</label>
                </td>
                <td>                   
                    <?php
                    PmHelper::ddStatus();
                    PmHelper::ddStatusSelect($item->status);
                    ?>



                </td>
            <tr>
                <td align="right" class="key">
                    <label>Last Change</label>
                </td>
                <td class="small"><?php echo $item->lastChanged ?></td>
            </tr>                  



        </table>


        <!--   RIGHT COL     -->


        <div class="box" id="rightcol" style="width: 400px; float: left; margin-left: 20px">
            <table class="admintable">
                <tr><td colspan="2">  
                        <h3>Anfragedaten</h3>
                    </td></tr>
                <tr>
                    <td width="100" align="right" class="key">
                        <label >ID</label>
                    </td>
                    <td><?php echo $item->id ?></td>
                </tr>


                <tr>
                    <td align="right" class="key">
                        <label>OwnerId</label>
                    </td>
                    <td>
                        <?php
                        if ($item->owner > 0) {
                            echo $item->owner;
                        } else {
                            ?>
                            <?php echo $user->id ?>
                            <input type="hidden" name="owner"  value="<?php echo $user->id ?>" >
                        <?php } ?>
                    </td>
                </tr>            

                <tr>
                    <td align="right" class="key">
                        <label>AnfrageId</label>
                    </td>
                    <td>
                        <?php
                        if ($item->anfrage) {
                            echo '<a class="button lens" href="index.php?comp=anfragen&view=detail&id=' . $item->anfrage . '&listlayout=actual" target="_blank" >';
                            echo $item->anfrage;
                            echo '</a>';
                        } else {
                            ?>
                            <?php echo $_GET['aid'] ?>
                            <input type="hidden" name="anfrage"  value="<?php echo $_GET['aid'] ?>"  >
                        <?php } ?>
                    </td>
                </tr>   
  </table>   <br>
                
                
                 <table> 
                <tr>
                   <td colspan="2">
                       <h3>Externer Entwickler</h3>
                    </td>
                </tr>
                <tr>
                    <td  colspan="2">                   
                        <input name="entwickler"  value="<?php echo $item->entwickler ?>" size="25" placeholder="Name externer Entwickler" >   
                    </td>
                </tr> 
            </table><br>
            
            

            <div>
                <h3>Kommentare</h3>
                <textarea name="kommentare" style="width: 297px; height: 188px; background: #ffffcc"><?php echo $item->kommentare ?></textarea>
            </div>

            <br>

            <div>
                <h3>Stundenübersicht</h3>
                <table class="adminlist">
                    <tr>
                        <th>Datum</th>
                        <th>Pers.</th>
                        <th>Tätigkeit</th>
                        <th>h</th>
                    </tr>

                    <?php
                    /*
                    foreach ($this->hours as $h) {
                        $sumH = $sumH + floatval($h->h);
                        $k = 1 - $k
                        ?>
                        <tr class="row<?php echo $k ?>">
                            <td><?php echo $h->date ?></td>
                            <td><?php echo $h->person ?></td>
                            <td><?php echo $h->text ?></td>
                            <td><?php echo $h->h ?></td>
                        </tr>
                    <?php }  */ ?>                

                    <tr class="sum right" style="font-weight: bold">
                        <td colspan="3"></td>
                        <td><?php echo $sumH ?></td>

                    </tr>
                </table>
            </div>


        </div>       


        <hr class="clear clearall" />
   
   
   

</form>








<?php
// FORM Abschlag
$jahr = substr($za[$i]->datum, 0, 4);
$mon = substr($za[$i]->datum, 5, 2);
$tag = substr($za[$i]->datum, 8, 2);
?>
<form id="formRechnung"   target="_blank" action="toBeSetByJS" method="post" name="rechnung<?php echo $za[$i]->id; ?>">                     
    <input id="datumAb" type="hidden" value="" name="datumRechnung"  />                           
    <input id="preisAb" type="hidden" value=""  name="preisAb" />                                  
    <input id="preisEx" type="hidden" value=""  name="preisEx" />  
    <input id="zusatz" type="hidden" value=""  name="zusatzaufwand" />                                                     
    <input type="hidden" name="firma" value="<?php echo $anfrage->firma; ?>" />
    <input type="hidden" name="ansprech" value="<?php echo $anfrage->name; ?>" />
    <input type="hidden" name="anrede" value="<?php echo $anfrage->anrede; ?>" />
    <input type="hidden" name="strasse" value="<?php echo $anfrage->strasse . " " . $anfrage->hausnummer; ?>" />
    <input type="hidden" name="plz" value="<?php echo $anfrage->plz; ?>" />
    <input type="hidden" name="ort" value="<?php echo $anfrage->ort; ?>" />
    <input type="hidden" name="land" value="<?php echo $anfrage->land; ?>" />                            
    <input type="hidden" name="rechnungsnummer" value="AEV<?php echo $anfrage->anfrage; ?>" />      
    <input type="hidden" name="anfrage" value="<?php echo $anfrage->titel; ?>"  />   
    <input type="hidden" name="FnotDE" id="FnotDE" value=""  />   
</form>        




<script type="text/javascript">
    $('button.btnAbschlag').click(function (e) {
        e.preventDefault();
        var art = $(this).attr('title');

        // aktuell eingetragene Werte ins Form übernehmen
        $('#preisAb').val($('#preisAbschlag').val());
        $('#preisEx').val($('#preisExtern').val());

        if ($('#notDE').attr('checked')) {
            $('#FnotDE').val('1');
        }

        // Datum je nach RE-Typ Abschlag/Final setzen
        if (art == 'Abschlag') {
            $('#datumAb').val($('#datumAbschlagRechnung').val());
        } else {
            // Final
            $('#datumAb').val($('#datumRechnung').val());
            $('#zusatz').val($('#zusatzaufwand').val());
        }


       // $('#formRechnung').attr('action', 'http://app-entwickler-verzeichnis.de/RE-AEV-' + art + '.php')
        $('#formRechnung').attr('action', 'http://aeve.orderpal.de/RE-AEV-' + art + '.php')
        $('#formRechnung').submit();
    })



</script>



<form id="formWerkvertrag" action="http://bknd.app-entwickler-verzeichnis.de/werkvertrag7.php" method="post">
    <input type="hidden" name="firma" value="<?php echo $anfrage->firma ?>">
    <input type="hidden" name="anrede" value="<?php echo $anfrage->anrede ?>" >
    <input type="hidden" name="name" value="<?php echo $anfrage->name ?>" >
    <input type="hidden" name="plz" value="<?php echo $anfrage->plz ?>" >
    <input type="hidden" name="strasse" value="<?php echo $anfrage->strasse. " " . $anfrage->hausnummer; ?>">
    <input type="hidden" name="ort" value="<?php echo $anfrage->ort ?>">
    <input type="hidden" name="angebot" value="<?php echo $anfrage->id ?>">
    <input type="hidden" name="angebotsdatum" value="<?php echo $item->datumAngebot; ?>">
    <input type="hidden" name="preis" value="<?php echo $ab; ?>">
    <input type="hidden" name="datumVertrag" value="<?php echo $item->datumVertrag; ?>">
</form>


<script>
    $('#btnWerkvertrag').click(function (e) {
        e.preventDefault();
        $('#formWerkvertrag').submit();
    });
</script>








<script src="components/pm/helpers/helper.js"></script>
