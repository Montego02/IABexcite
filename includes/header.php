<?php
if ($_SESSION['title']) {
?>
  <title><?php echo $_SESSION['title'] ?></title>
  <?php
} else {
    ?>
   <title><?php echo TITLE ?></title>
<?php } ?>

   
<?php if ($_SESSION['desc'] == null) {
    $_SESSION['desc'] = DESC;
}
?>
    <?php if ($_SESSION['keywords'] == null) {
    $_SESSION['keywords'] = KEYWORDS;
}
?>

   
   
<meta name="description" content="<?php echo str_replace('"', '', $_SESSION['desc']) ?>">
<meta name="keywords" content="<?php echo $_SESSION['keywords'] ?>">




