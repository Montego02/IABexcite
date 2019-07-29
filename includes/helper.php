<?php


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
    public static function getParameter($param, $filter) {

        $filtered = "";


// try to get variable from different sources
        if ($_GET[$param]) {
//$filtered = filter_var($_GET[$param], $filter[$filterValue]);
            $filtered = $_GET[$param];
        } elseif ($_POST[$param]) {
//  $filtered = filter_var($_GET[$param], $filter[$filterValue]);
            $filtered = $_POST[$param];
        } elseif ($_SESSION[$param]) {
            $filtered = $_SESSION[$param];
//  $filtered = filter_var($_SESSION[$param], $filter[$filterValue]);; 
//   echo " SESSION ".$param.": ".$filtered;
        }


// special checks for id
        if ($param == "id") {
            if (!is_numeric($filtered)) {
// die($filtered);
                $filtered = explode(':', $filtered);  // some joomla seo links are in the style of id:alias -> extract id
                $filtered = $filtered[0];
                if (!is_numeric($filtered)) {
                    $_SESSION['debug'] .= "<br>non numeric id found";
                }
            }
        }




//  $filtered = helper::sani($filtered, $filter);
//   die($filtered);
        return $filtered;


// die('missing parameter');
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

        $arrReplace = array(" ","ü", "ß", "&");
        $arrWith = array("-", "ue", "ss", "-");
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

    public function getSubMenu($id) {
        $db = IabDB::getInstance();
// load full menu first
        $q = "SELECT id, title, menuTitel, parent FROM iab_content "
                . "WHERE state = 1"
                ." ORDER BY ordering";
        $query = $db->query($q);

        $items = array();
        // get menu items index on id
        while ($obj = $query->fetch_assoc()) {
            $items[$obj['id']] = $obj;
        }

        $arrMenu = helper::buildTree($items, $id);
       // print_r($arrMenu);
        helper::printMenu($arrMenu);
    }

    
    public function buildTree(&$elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent'] == $parentId) {
                $children = helper::buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element['id']] = $element;
                unset($elements[$element['id']]);
            }
        }
        return $branch;
    }

    
    public function printMenu($elements, $arrPath = []) {
        global $mainPath; // see routing -> we need the main menu slug because we dont have it in sidemenu
        echo "<ul>";
        foreach ($elements as $element) {
            $urlTitle = helper::encodeUrl($element['title']);
            $slug = $element['id'] . "-" . $urlTitle;
            $path = implode("/", $arrPath) ."/". $slug;
            $path = ltrim($path, '/');
          
            if ($_SESSION['id'] == $element['id']) { // highlighting
                $cl = "active";
            } else {
                $cl = '';
            }
            
            echo "<li><a href='".URL.$mainPath."/".$path."' class='".$cl."'>" . $element['title'] . "</a></li>";
            if ($element['children']) {
                $arrPath[] = stripslashes($slug); // add element
                helper::printMenu($element['children'], $arrPath);
                array_pop($arrPath);
            }
        }
         echo "</ul>";
        
    }

}
