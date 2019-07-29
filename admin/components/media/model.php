<?php

class Model {


    public static function getItems($table) {
        $items = scandir('../extranet_downloads');
        
        return $items;
    }

    public static function getItem($table) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $db = IabDB::getInstance();
        $query = $db->query("SELECT * FROM " . $table . " WHERE id = " . $id);
        $item = $query->fetch_object();
        return $item;
    }

    public function saveItem($table) {
        $db = IabDB::getInstance();
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $obj = new stdClass();
        $obj->status = $_POST['status'];
        
 
        if ($id > 0) {
            $result = $db->updateObject($table, $obj, $id);
        } else {
            $result = $db->insertObject($table, $obj);
        }

        if ($result) {
            return $obj;
        } else {
            return false;
        }
    }

  
}
