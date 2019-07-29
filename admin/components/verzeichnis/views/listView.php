<?php
$user = $_SESSION['user'];

$eid = $_SESSION['searchParameter']['eid'];
$id = $_SESSION['searchParameter']['id'];
$title = $_SESSION['searchParameter']['title'];
$prem = $_SESSION['searchParameter']['prem'];

?>

<a class="lens" style="float: right" target="_blank" href="http://www.katzenbergdesign.net/backlinks/backlinks-aev.php?posted=1">Backlink-Checker</a>

<h2><i class="icon-globe"></i>Verzeichnis</h2>

<?php echo layoutHelper::listButtons(); ?>



<div class="box" style="padding-bottom: 5px">
   <a class="lens golden" style="float: right"  href="index.php?comp=verzeichnis&view=premium">Premium</a>
   <h2 style="margin: 0 ">Entwicklersuche</h2>
   <form action="index.php?comp=verzeichnis&view=listView" method="post">
      <input placeholder="User ID" name="eid" value="<?php echo $eid ?>" style="width: 80px" />
      <input placeholder="Firma ID" name="id" value="<?php echo $id ?>"   style="width: 80px" />
      <input placeholder="Firmenname/Ansprechpartner" name="title"  value="<?php echo $title ?>"  />
      <div style="margin: 10px; display: inline-block">
         <input type="checkbox" name="prem" value="1" <?php if($prem) echo 'checked' ?> /> Premiums
      </div>
      <br>
      <input type="hidden" name="search" value="1" />
      <button type="submit">Entwickler suchen</button>
   </form>
</div>






<table class="list striped" >
   <thead>
      <tr>
         <th class="center">Firma</th>
         <th>Firmenname</th>
         <th>Ansprechpartner</th>
           <th class="numeric">User ID</th>
         <th>email</th>
         <th>Score</th>  
         <th>APR*</th>
         <th>PREMIUM</th> 
         <th></th>
      </tr>            
   </thead>
   <tbody>
       <?php
       foreach ($items as $row) {
           $link = 'index.php?comp=verzeichnis&view=detail&id=' . $row->id;

           if ($row->published == 0) {
               $style = "inactive";
           } else {
               $style = "";
           }
           ?>   


          <tr class="      <?php echo $style ?>  " >     				

             <td><a href="<?php echo $link ?>" class="lens small">
              <?php echo $row->id; ?>
                </a>
          </td> 
             
             <td><a href="<?php echo $link ?>"><?php echo substr($row->title, 0, 30); ?></a></td>  
             <td><?php echo $row->person; ?></td>       
             <td  class="numeric"><?php echo $row->owner; ?></td>
             <td><?php echo $row->email; ?></td>  
             <td  class="numeric">
                <a href="http://www.katzenbergdesign.net/backlinks/backlinks-aev.php?id=<?php echo $row->owner ?>&posted=1" target="_blank">
                    <?php echo $row->score; ?>
                </a>
             </td>            

             <td align="center"><a href="http://www.katzenbergdesign.net/backlinks/backlinks-aev.php?id=<?php echo $row->owner ?>&posted=1" target="_blank"><?php echo $row->approved; ?></a></td>            
             <td><?php echo $row->confirm; ?></td>            
             <td>
                     <?php if (time() < strtotime($row->confirm)) {
                         ?>
                <i class="icon-star-full" style="color: goldenrod"></i>
                <?php
                     } ?> 
                
             </td>


          </tr>

          <?php
      }
      ?>
   </tbody>
</table>



<br />
<hr />


<?php 
//unset ($_SESSION['searchParameter']);

?>

<script>

    
    
    </script>