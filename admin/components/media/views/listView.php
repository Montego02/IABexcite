<?php
$user = $_SESSION['user'];
?>

<h2><span class="icon-images"></span>Medien</h2>




<ul class="mediaFolders">
    <?php
    $path = "../extranet_downloads/";
    $blacklist = array('.', '..', '.htaccess');
    foreach ($items as $item) {
        if (!in_array($item, $blacklist)) {
            if (is_dir($path . $item)) {
                ?>
                <li>
                    <a href="index.php?comp=media&view=folder&folder=<?php echo $item ?>">
                        <?php echo $item ?>
                    </a>
                </li>
                <?php
            }
        }
    }
    ?>
 
</ul>

<hr class="clear" />


<script>
    $('li').click(function () {


    });


</script>