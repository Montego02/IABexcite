<?php
$user = $_SESSION['user'];

print_r($rtn);

$eid = $_SESSION['searchParameter']['eid'];
$id = $_SESSION['searchParameter']['id'];
$title = $_SESSION['searchParameter']['title'];
$prem = $_SESSION['searchParameter']['prem'];
?>

<a class="lens" style="float: right" target="_blank" href="http://www.katzenbergdesign.net/backlinks/backlinks-aev.php?posted=1">Backlink-Checker</a>

<h2><i class="icon-globe"></i>Verzeichnis - PREMIUM</h2>

<?php echo layoutHelper::listButtons(); ?>


<h3>Offene Rechnungen</h3>
<table class="list striped" >
   <thead>
      <tr>
         <th class="numeric" style="width: 50px">RE-ID</th>
          <th style="width: 100px">DATE</th>  
         <th style="width: 100px">USERID</th>
         <th style="text-align: left">TITLE</th>
        


      </tr>            
   </thead>
   <tbody>
       <?php
       foreach ($re as $row) {
           $link = 'index.php?comp=verzeichnis&view=detail&ownerid=' . $row->userid . "#rechnungen";

           if ($row->published == 0) {
               $style = "inactive";
           } else {
               $style = "";
           }
           ?>   


          <tr class="      <?php echo $style ?>  " > 
             <td class="numeric"><?php echo $row->id; ?>             </td>      
             
              <td><?php echo $row->datum; ?></td> 

             <td>
                <a href="<?php echo $link ?>" class="lens small">
                    <?php echo $row->userid ?>
                </a>
             </td> 

             <td  style="text-align: left"><?php echo $row->title; ?></td> 



             <?php
         }
         ?>

   </tbody>
</table>



<br />
<hr />


<table class="list striped" >
   <thead>
      <tr>
         <th class="center">Firma</th>
         <th>Firmenname</th>
         <th>Ansprechpartner</th>
         <th class="numeric">User ID</th>

         <th>Score</th>  
         <th>RECHNUNG</th>
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

             <td  class="numeric">
                <a href="http://www.katzenbergdesign.net/backlinks/backlinks-aev.php?id=<?php echo $row->owner ?>&posted=1" target="_blank">
                    <?php echo $row->score; ?>
                </a>
             </td>            

             <td align="center">
                <a class="lens small" href="index.php?comp=">
                    <?php echo $row->rid ?>

             </td>            
             <td><?php echo $row->confirm; ?></td>            
             <td>
                 <?php if (time() < strtotime($row->confirm)) {
                     ?>
                    <i class="icon-star-full" style="color: goldenrod"></i>
                <?php }
                ?> 

             </td>


          </tr>

          <?php
      }
      ?>
   </tbody>
</table>





<script>

</script>