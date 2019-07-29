<?php
$user = $_SESSION['user'];


if ($item->id) {
    ?>
    <h2><span class="icon-user"></span> Bild ID <?php echo $item->id ?></h2>
<?php } else { ?>
    <h2><span class="icon-user"></span> Neuen Bild anlegen</h2>
<?php } ?>


<form id="formDetail" action="index.php?comp=bilder&task=" method="POST" >
    <input type="hidden" name="id" id="id" value="<?php echo $item->id ?>" >

<?php echo layoutHelper::detailButtons(); ?>

    <table class="detail">
        <tr><th>Status</th>  <td><select name="status">
                    <option value="1" <?php if ($item->status == 1) echo "selected" ?> >aktiviert</option>
                    <option value="-1"  <?php if ($item->status == -1) echo "selected" ?> >gesperrt</option>
                </select></td></tr>
        
        <tr><td colspan="2"><img src="../images/produkte/<?php echo $item->itemid ?>/<?php echo $item->filename ?>" width="800px" ></td></tr>


    </table>   

</form>


<?php if ($user->id == $item->userid || $user->level < 2) { ?>
    <script>$('#delete').addClass('hidden');</script>
<?php } ?>



