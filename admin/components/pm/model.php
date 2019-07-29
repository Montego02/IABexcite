<?php

class Model {

    public static function getItems($table) {
        $db = IabDB::getInstance();

        $q = "SELECT pm.id, pm.status, pm.owner, pm.anfrage, pm.datumAngebot, pm.datumAngebotAngenommen, pm.kommentare, a.firma, a.name FROM " . $table . " as pm "
                . " LEFT JOIN j25f_anfragen as a on pm.anfrage = a.id"
                . "  WHERE pm.status < 2 "
                . '  ORDER BY pm.status DESC, pm.id DESC';


        $query = $db->query($q);
        $items = array();
        while ($obj = $query->fetch_object()) {
            array_push($items, $obj);
        }
       

        return $items;
    }

    public static function getItem($table) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $db = IabDB::getInstance();
        $q = "SELECT * FROM " . $table . " WHERE id = " . $id;
        $query = $db->query($q);
        $item = $query->fetch_object();
        return $item;
    }

    
      public static function getAnfrage($id) {
        $db = IabDB::getInstance();
        $query = $db->query("SELECT * FROM j25f_anfragen WHERE id = " . $id);
        $item = $query->fetch_object();
        return $item;
    }
    
    
    
    public function saveItem($table) {
        $db = IabDB::getInstance();
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

        $obj = (object) $_POST;
        // die(print_r($obj));

        if ($id > 0) {
            $result = $db->updateObject($table, $obj, 'id');
        } else {
            $result = $db->insertObject($table, $obj);
        }

        if ($result) {
            return $obj;
        } else {
            return false;
        }
    }

    public function loadAngebot() {
        $db = IabDB::getInstance();
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $q = "SELECT * FROM j25f_angebote WHERE anfrage = " . $id;
        //die($q);
        if ($id) {
            $query = $db->query($q);
            $items = $db->loadObjectList($query);
        }

        return $items;
    }

}
