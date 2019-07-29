<?php
$user = $_SESSION['user'];
?>

<h2><span class="icon-user"></span>Benutzer</h2>

<?php echo layoutHelper::listButtons(); ?>



<div class="box" style="padding: 10px 20px">
   <h2>Usersuche</h2>
   <form action="index.php?comp=users&view=listView" method="post" style="margin: 0">
      <input placeholder="ID" name="id" value="<?php echo $id ?>" style="width: 80px" />
      <input placeholder="Name/Mail" name="name"  value="<?php echo $name ?>"  />
      <input type="hidden" name="search" value="1" />
      <button type="submit">User suchen</button>
   </form>
</div>


<table class="list striped tablesorter">
   <thead>
      <tr>
         <th>Status</th>
         <th>Benutzername (Name)</th>
         <th>Email</th>
         <th>Lv</th>
         <th class="id">ID</th>
      </tr>
   </thead>
   <tbody>

      <?php
      foreach ($items as $item) {
          ?>

          <tr itemid="row<?php echo $item->id ?>">
             <td  class="status"><?php echo layoutHelper::showStatus($item->status) ?></td>
             <td>
    <?php if ($user->id == 172 || ($user->level > 1 && $user->level > $item->level)) {
        ?>
                    <a href="index.php?comp=users&view=detail&id=<?php echo $item->id ?>"><?php echo $item->username . " (" . $item->name . ")" ?></a></td>
                 <?php
                 } else {
                     echo $item->name;
                 }
                 ?>

             <td><?php echo $item->email ?></td>
             <td><?php echo $item->level ?></td>
             <td  class="id"><?php echo $item->id ?></td>
          </tr>

    <?php
}
?>
   </tbody>

</table>

