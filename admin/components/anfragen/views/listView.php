<?php 
$user = $_SESSION['user'];

//print_r($items)
?>


<a class="btn lens" href="index.php?comp=anfragen&filter=archiv" style="float: right">Archiv</a>

<h2><span class="icon-inbox"></span>Anfragen</h2>

<?php echo layoutHelper::listButtons(); ?>




   <table class="list striped" style=""> 
      <thead>
         <tr>
           
            <th width="5">ID</th> <!-- id -->
            <th>Titel</th>
<!--                <th>eMail</th>-->
            <th>Firma/Name</th>
            
            <th>Budget</th>
            <th>Frist Angebot</th>            
            <th>Datum REC</th> 

            <th>vk</th>                     
            <th>#vk</th>
            <th>actions</th>
            <th>?</th>
            <th>active</th>
         </tr>            
      </thead>
      <tfoot>
      
      </tfoot>
      <tbody>
          <?php
          foreach ($items as $row) {
             
              $link = 'index.php?comp=anfragen&view=detail&id=' . $row->id;

              // abgelaufene Einträge markieren
              if ($row->active == "no" OR $row->active == "del") {
                  $class = 'inactive';
              } else {
                  $activeAndNew++;
                  $class = "";
              }

              if ($row->frist < date('Y-m-d') && $row->frist != 0) {
                  $class .= " red ";
              }

              ?>   



             <tr class="<?php echo $class; ?>">
             
                <td><?php echo $row->id; ?></td>
                
                <td><a href="<?php echo $link; ?>"><?php echo $row->titel; ?></a></td>                        

             
                <td><?php echo $row->firma . " / " . $row->name; ?></td>            
                
                <td align="right"><?php
                    echo substr($row->budget, 0, -3) . "." . substr($row->budget, -3);
                    $budgetGesamt += $row->budget;
                    if (!$row->active == "no") {
                        $budget += $row->budget;
                    }
                    ?></td>     

                <td><?php
                    if ($row->frist > 0) {
                        echo $row->frist;
                    } else {
                        echo "n.a.";
                    }
                    ?>
                </td> 
                <td style="font-size: 80%"><?php echo substr($row->recordtime, 0, 10); ?></td>                      
                <td align="center"><?php echo $row->vk; ?></td>            
                <td align="center" <?php if ($row->active == "" && $row->privat == 1 && $row->verkauft > 5) echo " style='font-weight: bold; color: #D00'" ?> > <?php echo $row->verkauft; ?></td>            
                <td>    
                   <span style="font-size: 75%">
                       <?php
                       echo "[" . $row->actDate . "] ";
                       echo substr($row->actions, 0, 45);
                       echo substr($row->act, 0, 45); // new from tbl actions
                       ?>
                   </span>
                </td>

                <td class="big red bold">
                    <?php
                    if ($row->offeneFrage)
                        echo "!!!";
                    ?>
                </td>


                <td align="center"><?php
                    switch ($row->active) {
                        case "no": echo "Archiv";
                            break;
                        case "new": echo "NEW";
                            break;
                        case "del": echo "deleted";
                            break;
                        case "1":
                            echo "<span style='font-weight: bold; color: #0C0'>active</style>";
                            $active++;
                    }
                    ?>
                </td>

             </tr>

             <?php
         }
         ?>
      </tbody>
   </table>

   <br />

