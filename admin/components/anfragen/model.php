<?php

class Model {

    public static function getItems($table) {
        $db = IabDB::getInstance();

        if ($_GET['filter'] == 'archiv') {
            $q = "SELECT a.id, a.recordtime, a.name, a.firma, a.titel, a.frist, a.budget, a.active, a.vk, a.verkauft, a.actions "
                    . " FROM " . $table . " as a "
                    . " WHERE (active = 'no' OR active = 'del') "
                    . " ORDER BY a.id DESC LIMIT 100";
        } else {
            $q = "SELECT a.id, a.recordtime, a.name, a.firma, a.titel, a.frist, a.budget, a.active, a.vk, a.verkauft, a.actions, "
                    . " (SELECT f.id FROM j25f_anfragenFragen AS f WHERE f.anfrage = a.id AND f.frage IS NOT NULL AND (f.antwort IS NULL OR f.antwort = '') ORDER BY id DESC LIMIT 1 ) as offeneFrage, " // check if open questions - puh yey checker
                    . " (SELECT actions.text FROM j25f_anfrageActions AS actions WHERE actions.anfrage = a.id ORDER BY actions.id DESC LIMIT 1 ) as act, " // load last action
                    . " (SELECT actions.date FROM j25f_anfrageActions AS actions WHERE actions.anfrage = a.id ORDER BY actions.id DESC LIMIT 1 ) as actDate " // load last actiondate
                   // . " GROUP_CONCAT(f.frage SEPARATOR ', ') "
                    . " FROM " . $table . " as a "                    
                    . " WHERE (a.active = 1 OR a.active = 'new') "
                    . " ORDER BY a.id DESC LIMIT 100";
        }

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

        $q = "SELECT a.*, p.id as pid FROM " . $table . " as a "
                . " LEFT JOIN j25f_pm as p ON p.anfrage = a.id "
                . " WHERE a.id = " . $id;

        $query = $db->query($q);
        $item = $query->fetch_object();

        return $item;
    }

    public function saveItem($table) {
        $db = IabDB::getInstance();

        $obj = (object) $_POST;
        //$obj->name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        //print_r($obj->id); die();    


        if ($obj->id > 0) {
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

}
