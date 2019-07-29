<?php 
$user = $_SESSION['user'];


if($item->id) { ?>
<h2><span class="icon-user"></span> Benutzer ID <?php echo $item->id ?></h2>
<?php } else { ?>
<h2><span class="icon-user"></span> Neuen Benutzer anlegen</h2>
<?php } ?>

<?php if($_SESSION['user']->id == $item->id) {?>
<div class="msg">Dies ist Ihr Benutzer. Sie können diesen nicht löschen.</div>
<?php
}
?>

<form id="formDetail" action="index.php?comp=users&task=" method="POST" >
    <input type="hidden" name="id" id="id" value="<?php echo $item->id ?>" >

<?php echo layoutHelper::detailButtons(); ?>

<table class="detail">
                <tr><th>Status</th>  <td><select name="status">
                            <option value="0">neu</option>
                            <option value="1" <?php if($item->status == 1) echo "selected"  ?> >aktiviert</option>
                            <option value="-1"  <?php if($item->status == -1) echo "selected"  ?> >gesperrt</option>
            </select></td></tr>
    <tr><th>Benutzername</th> <td><input name="name" value="<?php echo $item->name ?>" ></td></tr>
    <tr><th>Passwort</th> <td><input name="password" value="" placeholder="mind. 6 Zeichen" ></a></td></tr>
    <tr><th>Email</th><td><input name="email" value="<?php echo $item->email ?>" > </td></tr>
    <?php if(($user->level > 1 && $user->level > $item->level) || $user->id == $item->id) { ?>
    <tr><th>Level</th><td><select name="level">
                <option value="0" <?php if ($item->level == 0) echo "selected='selected'" ?> >User</option>
                <option value="1" <?php if ($item->level == 1) echo "selected='selected'" ?>>Editor</option>
                <?php if($user->level > 1) { ?>
                <option value="2" <?php if ($item->level == 2) echo "selected='selected'" ?>>Manager</option>
                <?php } ?>
                <?php if($user->level > 2) { ?>
                <option value="3" <?php if ($item->level == 3) echo "selected='selected'" ?>>Administrator</option>
                <?php } ?>
            </select> </td></tr>
    <?php } ?>
    <tr><th>Datum registriert</th><td><?php echo $item->registerDate ?></td></tr>
    <tr><th>Zuletzt angemeldet</th><td><?php echo $item->lastvisitDate ?></td></tr>
</table>   

</form>


<?php if($user->id == $item->id || $user->level < 3) { ?>
<script>$('#delete').addClass('hidden');</script>
<?php } ?>



