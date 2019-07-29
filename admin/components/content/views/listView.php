
<?php
$filterText = helper::getParameter('filterText');
$filterStatus = helper::getParameter('filterStatus');
if (!isset($filterStatus))
    $filterStatus = 0;

$filterLang = helper::getParameter('filterLang');


//print_r($items);

?>

<h2><span class="icon-book"></span>Content 
   <span id="catname"></span>
</h2>

<form id="formList" action="index.php?comp=content" method="POST" >
   <style>
      #filter input, #filter select, #filter button {float: right; margin: 0 5px; height: 26px}
   </style>

   <div id="filter">

      <button id="btnFilter" class="small" style=" margin-left: 10px">filtern</button>

    <select name='filterLang' class="catid" style='float: right'>
    <option value='0' >- language -</option>
    <option <?php if ($filterLang == "DE") echo " selected " ?>>DE</option>
    <option  <?php if ($filterLang == "EN") echo " selected " ?>>EN</option>
</select>

      <select name="filterStatus">
         <option value="0"   <?php if ($filterStatus == "0") echo " selected " ?>>- state -</option>
         <option value="1" <?php if ($filterStatus == "1") echo " selected " ?> >public</option>
         <option value="-1" <?php if ($filterStatus == "-1") echo " selected " ?> >draft</option>
      </select>
    

      <input name="filterText" placeholder="suche" value="<?php echo $filterText ?>">
      <!--    
          <select id="filterCats" class="cats" name='filterCats' >
      <?php //include 'components/content/views/inc_categories.php'; ?>
          </select>-->
   </div>



   <?php echo layoutHelper::listButtons(); ?>

   <table class="list striped tablesorter">
      <thead>
         <tr>

            <th style="width: 40px">Status</th>
            <th>Title</th>
<!--            <th>Kategorie</th>-->
            <th>Lang</th>
            
            <th>Parent</th>
            <th>Ordering</th>
            <th class="id">ID</th>
         </tr>
      </thead>
      <tbody>
          <?php
         
//$arrKategorien = mh::getProduktkategorienAsArr();

          //outputTree($items);
          
         // helper::getSubmenu();
          
          
        $arrMenu = helper::buildTree($items);
        helper::printMenu($arrMenu);
          
          
          
         ?>
      </tbody>
   </table>



</form>

<script>
    var cat = "<?php echo $_POST['filterCats'] ?>";
</script>
<script src="components/content/assets/handler.js"></script>


<?php


//
//
//
//echo "<pre>";
//print_r($items);
//echo "</pre>";
?>