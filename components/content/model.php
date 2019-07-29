<?php

class ModelContent {

    public static function getItems($table) {
        $db = IabDB::getInstance();
        $catid = helper::getParameter('id', 'int');
        $frontpage = helper::getParameter('frontpage', 'int');

        //$lang = $_SESSION['lang'];

        $q = "SELECT id, title, alias, introtext, created, images FROM content ";

        // . " AND publish_up < NOW()   ";

        if ($catid > 0) {
            $q .= " WHERE catid = " . $catid . " AND state > 0";
        }

//        if ($lang == "de") {
//            // deutsch
//            $q .= " AND (lang = '*' OR lang = 'DE')";
//        } else {
//            $q .= " AND lang = 'EN'";
//        }


        if ($frontpage) {
            $q .= " WHERE catid = 1 AND state > 0";
            $ordering = " ORDER BY id DESC LIMIT 25 ";
        } else {
            $ordering = " ORDER BY id DESC LIMIT 5 ";
        }


        // die($q. $ordering);

        $query = $db->query($q . $ordering);
        $items = array();
        while ($obj = $query->fetch_object()) {
            array_push($items, $obj);
        }
        return $items;
    }

    public static function getItem($table) {
        $id = helper::getParameter('id', 'int');
        if (is_numeric($id)) {
            $db = IabDB::getInstance();
            $query = $db->query("SELECT * FROM " . $table . " WHERE id = " . $id);
            $item = $query->fetch_object();
 $_SESSION['dbg'] = "SELECT * FROM " . $table . " WHERE id = " . $id;
//            $item->fulltext = helper::detectEmail($item->fulltext);
//            
//            $metaDesc = strip_tags($item->introtext);
//            $metaDesc = substr($metaDesc, 0, 160);
            $_SESSION['metaDesc'] = $metaDesc;
            $_SESSION['title'] = $item->title;
        }
        return $item;
    }

    public static function getCat() {
        $id = helper::getParameter('id', 'int');
        $db = IabDB::getInstance();
        $query = $db->query("SELECT * FROM categories WHERE id = " . $id);
        $item = $query->fetch_object();
        return $item;
    }

    public static function getCats() {
        $db = IabDB::getInstance();
        $parent = helper::getParameter('parent', 'int');
        if ($parent <= 0)
            $parent = 1;
        $q = "SELECT id, title, alias, level, parent_id FROM categories WHERE published = 1 AND parent_id = " . $parent;

        $query = $db->query($q);
        $items = array();
        while ($obj = $query->fetch_object()) {
            array_push($items, $obj);
        }
        return $items;
    }

  

}
