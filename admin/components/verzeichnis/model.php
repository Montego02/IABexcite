<?php

class Model {

    public static function getItems($table) {
        $db = IabDB::getInstance();

        if ($_POST['eid'] || $_POST['id'] || $_POST['title'] || $_POST['prem']) {
            $search = true;
            $p = $_POST;
            $_SESSION['searchParameter'] = $_POST;
        } else {
            $p = $_SESSION['searchParameter'];
        }

        if ($search) {
            $q = "SELECT id, title, owner, person, email, score, approved, confirm, published  FROM " . $table . " WHERE 1=1 ";

            if ($p['eid']) {
                $q .= " AND owner = " . $p['eid'];
            }

            if ($p['id']) {
                $q .= " AND id = " . $p['id'];
            }

            if ($p['title']) {
                $q .= " AND (title LIKE '%" . $p['title'] . "%' OR person LIKE '%" . $p['title'] . "%'  OR email LIKE '%" . $p['title'] . "%')";
            }

            if ($p['prem']) {
                $q .= " AND confirm > 0";
                $q .= " ORDER BY confirm DESC ";
            } else {
                $q .= " ORDER BY title ";
            }
        } else {
            $_SESSION['searchParameter'] = '';
            $q = "SELECT id, title, owner, person, email, score, approved, confirm, published  FROM " . $table . " ORDER BY last_update DESC  ";
        }
        $q .= " LIMIT 50 ";

        //die($q);

        $query = $db->query($q);

        $items = $db->loadObjectList($query);

        return $items;
    }

    public static function loadPremiums() {
        $db = IabDB::getInstance();

        $q = "SELECT id, title, owner, person, score, confirm "
                . " FROM j25f_verzeichnis"
                . " WHERE confirm > 0 "
                //." LEFT JOIN j25f_zahlungen AS z ON z.userid = owner "
                . " ORDER BY confirm DESC LIMIT 30";
       //  die($q);

        $query = $db->query($q);
        $items = $db->loadObjectList($query);
        return $items;
    }

    public static function loadOpenRe() {
        $db = IabDB::getInstance();
        $q = "SELECT z.*, v.title FROM j25f_zahlungen as z"
                . " LEFT JOIN j25f_verzeichnis as v ON z.userid = v.owner"
                // . " WHERE (anfrage = 3 OR anfrage = 6 OR anfrage = 12)"
                . " WHERE status LIKE 'Rechnung gestellt' "
                . " ORDER BY id DESC ";

        $query = $db->query($q);
        $items = $db->loadObjectList($query);
         return $items;
    }

    
    public static function getItem($table) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $owner = filter_var($_GET['ownerid'], FILTER_SANITIZE_NUMBER_INT);
        $db = IabDB::getInstance();


        if ($id) {
            $q = "SELECT * FROM " . $table . " WHERE id = " . $id;
        } else {
            $q = "SELECT * FROM " . $table . " WHERE owner = " . $owner;
        }

      //  die($q);
        $query = $db->query($q);
        $item = $query->fetch_object();
        return $item;
    }

    public function saveItem($table) {
        $db = IabDB::getInstance();
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $obj = (object) $_POST;


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

}
