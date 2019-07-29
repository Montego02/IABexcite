<?php 
$user = $_SESSION['user'];
?>

<h2><span class="icon-wrench"></span>Projekte</h2>

<?php echo layoutHelper::listButtons(); ?>
<style>
    .hours {background: black; color: white; border-radius: 3px; padding: 3px 6px; font-weight: bold; text-align: center}
    .hwindow{width: 250px; padding: 10; background: white; border: 2px solid black; position: absolute; display: none}
    .new {font-style: italic; color: #bbb}
    div.statusbox {width: 16px; height: 16px; border: 1px solid silver; display: inline-block;}    
div.statusboxSmall {width: 10px; height: 10px; border: 1px solid silver; display: inline-block;}    

   .status0 { background: #5cab3f }
   .status1 {background: #025A8D; }
   .status2 {background: white;color: #333!important }
   .status3 {background: #f81a3f }
   .status4 {background: black;}
</style>

        <table class="list striped">
            <thead>
                <tr>
                          
                    <th width="5">ID</th> <!-- id -->
                    <th width="200">Kunde</th>
                    <th width="200">Anfrage</th>
                    <th width="62">Angebot</th>
<!--                    <th>Auftrag</th>
                    <th>Vertrag</th>
                    <th>Abschlag</th>            -->
                    <th width="62">Rechnung</th>
<!--                    <th>h</th>-->
<!--                    <th>Zeiterfassung (Person, Tätigkeit, h)</th>-->
                     <th >info            </th>
                </tr>            
            </thead>
            <?php
            foreach ($items as $project) {    
                $link = 'index.php?comp=pm&view=detail&id=' . $project->id;
                ?>
                <tr class="<?php echo $class; ?>" >
                   
                    <td ><a href="<?php echo $link ?>" class="lens status<?php echo $project->status ?>"><?php echo $project->id ?></a></td>

                    
                    
                    <td><?php echo $project->firma . " (<span style='font-style: italic'>" . $project->name . "</span>)"; ?><br>
                        <span class="small"><a href="mailto: <?php echo $project->email ?>"> <?php echo $project->email ?></a></span>
                    </td>  


                    <td>
                        <?php echo substr($project->titel, 0, 50) ?>
                        (<a href="index.php?comp=anfragen&view=detail&id=<?php echo $project->anfrage; ?>" target="_blank">
                            <?php echo $project->anfrage ?>
                        </a>)
                    </td>
                    <td class="small"><?php if (substr($project->datumAngebot, 0, 1) > 0) { ?>
                            <i class="icon-check" title="<?php echo $project->datumAngebot ?>" /> 
                        <?php } ?>
                        <?php echo $project->preisExtern; ?>                               
                    </td>

<!--                    <td align="center">
                        <?php if (substr($project->datumAngebotAngenommen, 0, 1) > 0) { ?>
                            <img src="/images/stories/haken.png" width="20" title="<?php echo $project->datumAngebotAngenommen ?>" > 
                        <?php } ?>
                    </td> -->

<!--                    <td align="center">
                                                Vertäge
                        <?php
                        if (substr($project->datumVertrag, 0, 1) > 0) {
                            if (substr($project->datumVertragUnterzeichnung, 0, 1) > 0) {
                                ?>
                                <img src="/images/stories/haken.png" width="20" title="Unterzeichnet: <?php echo $project->datumVertragUnterzeichnung ?>" >       
                            <?php } else { ?>
                                <img src="/images/stories/haken_off.png" width="20" title="gesendet <?php echo $project->datumVertrag; ?>" > 
                                <?php
                            }
                        }
                        ?>
                    </td>

                    <td>
                        <?php
                        if (substr($project->datumAbschlagRechnung, 0, 1) > 0) {
                            if (substr($project->datumAbschlagEingang, 0, 1) > 0) {
                                ?>
                                <img src="/images/stories/haken.png" width="20" title="Erhalten: <?php echo $project->datumAbschlagEingang ?>" >       
                            <?php } else { ?>
                                <img src="/images/stories/haken_off.png" width="20" title="RE gestellt: <?php echo $project->datumAbschlagRechnung ?>" > 
                                <?php
                            }
                        }
                        ?>                           

                    </td>     
 -->
                    <td>
                        <?php
                        if (substr($project->datumRechnung, 0, 1) > 0) {
                            if (substr($project->datumRechnungEingang, 0, 1) > 0) {
                                ?>
                                <img src="/images/stories/haken.png" width="20" title="Erhalten: <?php echo $project->datumRechnungEingang ?>" >       
                            <?php } else { ?>
                                <img src="/images/stories/haken_off.png" width="20" title="RE gestellt: <?php echo $project->datumRechnung ?>" > 
                                <?php
                            }
                        }
                        ?>                            


                    </td>

  <!--                  <td>

                        <div class="hours">
                            <?php
                            
//                            $db = JFactory::getDbo();
//                            $query = $db->getQuery(true);
//
//                            $query
//                                    ->select('sum(h)')
//                                    ->from('#__pm_stunden ')
//                                    ->where('projekt = ' . $project->id);
//                            $db->setQuery($query);
//                            $hours = $db->loadResult();
//
//                            echo $hours;
                            
                            ?>

                        </div>
                    </td>-->


<!--
                    <td class="small">

                        <form action="index.php" method="post">
                            <input name="person" class="new" size="2" value="<?php echo $personenkuerzel ?>" >
                            <input name="text" class="new" size="15" value="Tätigkeit" >
                            <input name="h" class="new" size="3" value="" >
                            <input type="hidden" name="projekt" value="<?php echo $project->id ?>" >
                            <input type="hidden" name="anfrage" value="<?php echo $project->anfrage ?>" >
                            <input type="hidden" name="controller" value="pm" />   
                            <input type="hidden" name="option" value="com_pm" />    
                            <input type="hidden" name="task" value="saveHours" />
                            <button type="submit" >OK</button>
                        </form>
-->
                       
                    
                    <td style="max-width: 200px; font-size: 10px">  <?php echo $project->kommentare; ?> </td>
                    
                </tr>

                <?php
               
            } // end foreach
            ?>
        </table>



    </div>

    

</form>

<br />

<div class="statusboxSmall status0"></div> Angebotsphase &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="statusboxSmall status1"></div> Durchführung &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="statusboxSmall status2"></div> abgeschlossen &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="statusboxSmall status3"></div> abgelehnt &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <div class="statusboxSmall status4"></div> gelöscht &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<br />
