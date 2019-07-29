<?php

$level = 0; // global for building nav tree

class helper {
    
    

    public static function checkDate($date) {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            return true;
        } else {
            return false;
        }
    }

    public static function printDate($date) {
        $date = new DateTime(substr($date, 0, 10));
        $date = $date->format('d.m.Y');
        echo $date;
    }

// get parameter
    public static function getParameter($param) {


        // try to get variable from different sources
        if ($_GET[$param]) {
            $rtn = $_GET[$param];
          
        } elseif ($_POST[$param]) {
            $rtn = $_POST[$param];
          
        } elseif ($_SESSION[$param]) {
            $rtn = $_SESSION[$param];
          
        }

        return $rtn;
    }

// get parameter
    public static function sani($value, $filterType) {
        $filter['flo'] = FILTER_SANITIZE_NUMBER_FLOAT;
        $filter['int'] = FILTER_SANITIZE_NUMBER_INT;
        $filter['str'] = FILTER_SANITIZE_STRING;
        $filter['url'] = FILTER_SANITIZE_STRING; // additional http check below
        $filter['email'] = FILTER_SANITIZE_EMAIL;

        if ($filterType == "url") {
            if (strpos($url, "http://") === 0 || strpos($url, "https://") === 0) {
                $value = "http://" . $value;
            }
        }

        // bonus filtering for strings to avoid trickeries with ' etc
        if ($filterType == "str") {
            // $value = preg_replace('/[^a-z0-9\-\ü\ö\ä\Ü\Ö\Ä\ß\.\!\?\:\, ]/i', '', $value);
            // this prevents user and profile names to be with special characters which we dont want. 
            // the mysqlrealescape should to the trick as well
        }


        return filter_var($value, $filter[$filterType]);
    }

    public static function encodeUrl($seg) {

        $arrReplace = array(" ", "ß", "&");
        $arrWith = array("-", "ss", "-");
        $url = str_replace($arrReplace, $arrWith, $seg);

        $url = str_replace(" ", "-", $seg);
        $url = strtolower(trim($url));
        $url = preg_replace('/[^a-z0-9\-\ü\ö\ä\Ü\Ö\Ä ]/i', '', $url); // sonderzeichen bis auf "-" entfernen
        $url = str_replace("--", "-", $url);
        $url = urlencode($url);
        return $url;
    }

    public static function decodeUrl($seg) {
        // we want " " replaced by "-" and the rest standard encoded:
        $url = str_replace("-", " ", $seg);
        $url = urldecode($url);
        return $url;
    }

    public static function showPages($numPages, $activePage, $baselink) {

        while ($i < $numPages) {
            ?>
            <a class="pagination <?php if ($i == $activePage) echo " activepage " ?>" href="<?php echo $baselink . $i ?>"><?php echo $i ?></a>
            <?php
            $i++;
        }

        return $url;
    }

    public function getSubMenu($id = 0) {
        $db = IabDB::getInstance();
// load full menu first
        $q = "SELECT id, title, menuTitel, parent, lang, state FROM iab_content ";
        $query = $db->query($q);

        $items = array();
        // get menu items index on id
        while ($obj = $query->fetch_assoc()) {
            $items[$obj['id']] = $obj;
        }

        $arrMenu = helper::buildTree($items, $id);

        helper::printMenu($arrMenu);
    }

    
    public function buildTree($elements, $parentId = 0) {
        $branch = array();
        global $level; // important -> works only with a global to reflect level changes across function calls

        foreach ($elements as $element) {
            $element['level'] = $level;
            if ($element['parent'] == $parentId) {
                $children = helper::buildTree($elements, $element['id']);
                if ($children) {
                    $level++; // we want the children with a higher level
                    $element['children'] = helper::buildTree($elements, $element['id']); // and then scann again with higher level
                    $level--; // after adding children we fall back to last level
                }
                $branch[$element['id']] = $element;
                unset($elements[$element['id']]);
            }
        }
        return $branch;
    }

    public function printMenu($elements) {

        foreach ($elements as $element) {
            
            echo "<tr><td>" . layoutHelper::showStatus($element['state']) . "</td><td>";
            
            // title
            for ($i = 0; $i < $element['level']; $i++)
                echo ' - ';
            echo "<a href='index.php?comp=content&view=detail&id=" . $element['id'] . "'>" . $element['title'] . "</a>";

            
            echo "</td><td>" . $element['lang'] . "</td>"
                    ."<td class='alignRight'>" . $element['parent'] . "</td>"
                    ."<td class='alignRight'>" .  $element['ordering'] 
                    ."<td  class='alignRight'>" . $element['id'] . "</td>";
            if ($element['children']) {
               
                $level = helper::printMenu($element['children']);
            }
        }
     
      
       //$level--;

    }

}
