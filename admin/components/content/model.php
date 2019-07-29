<?php

class Model {

    public function getItems($table) {
        $db = IabDB::getInstance();
        $catid = filter_var($_POST['filterCats'], FILTER_SANITIZE_NUMBER_INT);
        $filterText = $_POST['filterText'];
        $filterStatus = $_POST['filterStatus'];
        $filterLang = $_POST['filterLang'];
        if ($filterLang) {
            $_SESSION['filterLang'] = $filerLang;
        } else {
            $_SESSION['filterLang'] = '';
        }

        $q = "SELECT id, title, state, parent, lang, ordering FROM " . $table . " WHERE id > 0 ";

        if ($catid > 0) {
            $q .= " AND catid = " . $catid;
        }

        if ($filterText) {
            $q .= " AND title LIKE '%" . $filterText . "%' ";
        }

        if ($filterStatus) {
            if ($filterStatus == -1)
                $filterStatus = 0; // as "0" val is not send we send -1 and correct it back here
            $q .= " AND state = " . $filterStatus . " ";
        }
        
         if ($filterLang) {
            
            $q .= " AND lang = '" . $filterLang . "' ";
        }
        

        $q .= " ORDER BY lang, ordering";
//die($q);
        $query = $db->query($q);
        $items = array();
        while ($obj = $query->fetch_assoc()) {
            $items[$obj['id']] = $obj;
        }
        
     
        
        
       // print_r($items);
       // die();
        
        return $items;
    }

    public static function getItem($table) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $db = IabDB::getInstance();
        $query = $db->query("SELECT * FROM " . $table . " WHERE id = " . $id);
        $item = $query->fetch_object();

        $_SESSION['header'] .= "<title>" . $item->title . "</title>";

//        // load categories
//        $q = "SELECT id, title, level FROM j25f_categories WHERE published = '1' ORDER BY parent_id ";
//        $query = $db->query($q);
//        $item->cats = $db->loadObjectList($query);

        return $item;
    }

    public static function getCats() {
        $db = IabDB::getInstance();
        $parent = filter_var($_GET['parent'], FILTER_SANITIZE_NUMBER_INT);
        if ($parent <= 0)
            $parent = 1;
        $q = "SELECT id, title, alias, level, parent_id FROM j25f_categories "
                ." WHERE published = 1 AND parent_id = " . $parent
                ." ORDER BY ordering";
                


        $query = $db->query($q);
        $items = array();
        while ($obj = $query->fetch_object()) {
            array_push($items, $obj);
        }
        return $items;
    }

    public function saveItem($table) {
        $user = $_SESSION['user'];
        $db = IabDB::getInstance();
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $data = $_POST; // no filtering in save backend

        $obj = (object) $data;
        unset($obj->comp);
        unset($obj->path);
        unset($obj->imgSize);
        
        
//          print_r($obj);
//        die();
//        
                 
        if ($id > 0) {
            $obj->modified = date('Y-m-d');

           // die(print_r($obj));       
            $result = $db->updateObject($table, $obj, 'id');
            
        } else {
            unset($obj->id);
            $obj->created = date('Y-m-d');
            $obj->created_by = $user->id;
            /* $obj->created = date('Y-m-d', time());
              $obj->created_by = $user->id;
             * */


// die(print_r($obj));
            $result = $db->insertObject($table, $obj);
        }

        if ($result) {
            return $obj;
        } else {
            return false;
        }
    }

    
    
    
    
}
