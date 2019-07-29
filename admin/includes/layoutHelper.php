<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of layoutHelper
 *
 * @author iab
 */
class layoutHelper {

    public static function listButtons() {

        $href = "index.php?comp=" . $_GET['comp'] . "&view=detail";

        $html = "<div id='tasks'>"
                . "<a href='" . $href . "' id='add' class='icon-plus btn'></a>"
            //    . "<a href='" . $href . "' id='delete' class='icon-trash-2 btn'></a>"
                . "</div>";
        return $html;
    }

    public static function listMultiselectTasks() {
        $html = "<div id='multiselectTasks'>"
                . "<span class='icon-arrow-down' style='padding: 5px 0 0 9px; color: #555'></span><br>"
                . "<a id='copySelection' title='Kopieren' ><span class='icon-copy'></span></a>"
                . "<a id='deleteSelection' title='Löschen' ><span class='icon-bin'></span></a>"
                . "</div>";
        return $html;
    }

    public static function detailButtons() {
        $href = "index.php?comp=" . $_GET['comp'];

        $html = "<div id='tasks'>"
                . "<a id='save' title='Speichern' class='icon-floppy-disk btn'></a>"
                . "<a href='" . $href . "' id='cancel'  title='Abbrechen ohne Speichern' class='icon-cross btn'></a>";
        
        if ($_GET['comp'] == "produkte") {
            $html .= "<a target='_blank' href='../index.php?com=produkte&view=detail&id=".$_GET['id']."' title='Vorschau' class='icon-display btnSmall'></a>";
        }
            $html .= "<a id='delete' title='Löschen' class='icon-bin'></a>"
                . "</div>";

        return $html;
    }

    public static function showStatus($status) {
        switch (true) {
            case $status < 0:
                return "<i class='status icon-blocked' value='-2'> </i>";

            case $status == 0:
                return "<i class='status icon-checkbox-unchecked' value='0'> </i>";
                
            case $status == 1:
                return "<i class='status icon-checkmark' value='1'> </i>";
        }
    }

    
     public static function showSchadenStatus($status) {
        switch ($status) {
            case 1:
                return "<i class='status icon-paint-format' value='1'> </i>";

            case 2:
                return "<i class='status icon-checkmark2' value='2'> </i>";
            case 3:
                return "<i class='status icon-checkmark' value='3'> </i>";
        }
    }
    
    
    // bulild a dropdown with value = key 
    public static function ddWithKey($arr, $activeid, $default = "") {
      
        if (!$activeid) $activeid = $default;
  
        foreach ($arr as $key=>$value) {
            ?>
            <option value="<?php echo $key ?>" <?php if ($activeid == $key) echo "selected='selected'" ?>><?php echo $value ?></option>
            <?php
        }
    }
    
    // bulild a dropdown with value = value 
      public static function ddWithValue($arr, $activeid, $default = "") {
      
        if (!$activeid) $activeid = $default;
  
        foreach ($arr as $a) {
            ?>
            <option <?php if ($activeid == $a) echo "selected='selected'" ?>><?php echo $a ?></option>
            <?php
        }
    }

}
