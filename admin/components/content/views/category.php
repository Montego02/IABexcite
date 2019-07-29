<h1>Kategorien</h1>

<table>
    <?php
    $parent = filter_var($_GET['parent'], FILTER_SANITIZE_NUMBER_INT);
    if ($parent > 0) {
        ?>
    <a class="btn" href="index.php?com=content&view=category&parent=1">Zurück</a>
    <?php
    }
    
//print_r($cats);
    foreach ($cats as $cat) {
        ?>    
        <tr>
<!--            <td><?php echo $cat->id ?></td>-->
            <td>
                <a href="index.php?com=content&view=category&parent=<?php echo $cat->id ?>">
                    <?php echo $cat->title ?>
                </a>
            </td>
             <td><?php echo $cat->alias ?>
<!--            <td><?php echo $cat->parent_id ?></td>-->
        </tr>

        <?php
    }
    ?>

</table>