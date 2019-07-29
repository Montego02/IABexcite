
<?php
$cats = $_SESSION['cats'];
$user = $_SESSION['user'];



if (helper::getParameter('id', 'int')) {
    $item = ModelContent::getItem($this->table);
}
?>


<section class="   <?php echo $class ?>   ">

   <?php if ($item->access > 0 && $user->id <= 0) { ?>

       <h4>Loggen Sie sich ein, um Zugriff auf diese Seite zu erhalten.</h4>

   <?php } else { ?>

       <article>

          <?php
          if ($_SESSION['baseId'] == "102") { // if produkte show download-Button
              ?>
          <a href="/downloads" class="btn" style="float: right"><i class="icon icon-download"></i> Downloads</a>
              <?php
          }
          ?>

          <h1><?php echo $item->title ?></h1>

          <?php
          // user access control
          if ($item->access >= 2 && $user->level < 1) {
              ?>
              <h2>Geschützer Bereich</h2>
              <p>Sie sind nicht (mehr) angemeldet. Bitte loggen Sie sich ein, um Zugriff auf diesen Bereich zu erhalten</p>
              <a href="/index.php?com=users&view=login" class="button">Zum Login</a>
              <?php
          } else {
              ?>

              <!--      <div class="bread">
                       <a href="index.php">start</a> / <?php echo $cats[$item->cat]->title; ?>
                    </div>-->



              <?php
              if (substr($item->images, 0, 7) == "/images") { // only show images set by iab excite starting with /images
                  ?>
                  <img class="articleImage" src="<?php echo $item->images ?>">
                  <?php
              }
              ?>

              <?php echo $item->introtext ?>

              <?php echo $item->fulltext ?>
          <?php } ?>
       </article>

   <?php } ?>

</section>

<br>
<?php
//include 'includes/sections/citylinks.php';
?>