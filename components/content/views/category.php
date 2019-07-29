<?php
$id = helper::getParameter('id', 'int');

if ($id) {
    //   $cat = ModelContent::getCat();
    $items = ModelContent::getItems($this->table);
    $cat = ModelContent::getCat($item->catid);
}
?>

<div id="category" class="category category<?php echo $cat->id ?>">

   <h1><?php echo $cat->title ?></h1>


<?php
$parent = helper::getParameter('parent', 'int');
if ($parent > 0) {
    ?>
       <a class="btn" href="index.php?com=content&view=category&parent=1">Zurück</a>
       <?php
   }

//print_r($cats);
   foreach ($items as $item) {
       ?>    
       <article>
          <h2>    
             <a href="index.php?com=content&view=article&id=<?php echo $item->id ?>">
    <?php echo $item->title ?>
             </a>
          </h2>


    <?php echo $item->introtext ?>
       </article>
          <?php
      }
      ?>
       
       <a class='readmore' href="index.php?com=content&view=article&id=<?php echo $item->id ?>">weiterlesen</a>
       
   <hr class="clear">
</div>