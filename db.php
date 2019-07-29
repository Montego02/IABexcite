<?php

class IabDB extends mysqli {

    // single instance of self shared among all instances
    private static $instance = null;
    // db connection config vars 
    private $user = "db10631781-wis";
    private $pass = "luigispfoten02";
    private $dbName = "db10631781-wisco";
    private $dbHost = "wp10631781.server-he.de";

    
    
    // private constructor
    private function __construct() {

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if ($this->connect_error) {
            die('Connect Error: ' . $this->connect_error);
        }
        mysqli_set_charset($this, "utf8");
    }

    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // thus eliminating the possibility of duplicate objects.
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

// core database functions    

    public function insertObject($table, $obj) {

        $query = "INSERT INTO " . $table . " ";

        foreach ($obj as $key => $value) {
            $cols[] = "`" . $key . "`";
            $vals[] = "'" . mysqli_real_escape_string($this, $value) . "'";
        }

        $query .= "(" . implode(",", $cols) . ")"
                . " VALUES (" . implode(",", $vals) . ")";


        if (!$this->query($query)) {
            die("Error " . mysqli_error($this));
        } else {
            return true;
        }
    }

    public function updateObject($table, $obj, $identifier) {


        $query = "UPDATE " . $table . " SET ";
        
        $arrSet = [];

        foreach ($obj as $key => $value) {
            //if (!empty($value)) { // do we need this??
                $arrSet[] = "`" .$key . "` = '" . mysqli_real_escape_string($this, $value) . "' ";
            //}
        }
        
        $query .= implode(',', $arrSet);

        $query .= " WHERE `" . $identifier . "` = '" . $obj->$identifier . "'";
        
      // die($query);

        if (!$this->query($query)) {
            die("Error " . mysqli_error($this));
        } else {
            return true;
        }
    }

    public function deleteItem($table, $id) {
        $q = "DELETE FROM " . $table . " WHERE id =" . $id;
        if (!$this->query($q)) {
            die("Error " . mysqli_error($this));
        } else {
            return true;
        }
    }

    public function deleteList($table) {
        $ids = implode(",", $_POST['cid']);
        $q = "DELETE FROM " . $table . " WHERE id IN (" . $ids . ")";
        if (!$this->query($q)) {
            die("Error " . mysqli_error($this));
        } else {
            return true;
        }
    }

    public function copySelection($table) {
        $id = $_POST['cid'][0]; // take first selection

        $query = $this->query("SELECT * FROM " . $table . " WHERE id =" . $id);
        $item = $query->fetch_object();
        if ($item) {
            unset($item->id);
            $this->insertObject($table, $item);
            $newItemId = $this->insert_id;
            // copy image entry 
            $query = $this->query("SELECT * FROM images WHERE itemid =" . $id);
            $image = $query->fetch_object();
            if ($image) {
                unset($image->id);
                $image->itemid = $newItemId; // set new items id of last entry 
                // copy file
                mkdir("../images/produkte/" . $newItemId, 0700);
                copy("../images/produkte/" . $id . "/" . $image->filename, "../images/produkte/" . $newItemId . "/" . $image->filename);

                // insert database entry
                $this->insertObject("images", $image);
            }
        }
    }
    

    public function loadObjectList($query) {
        $items = array();
        while ($obj = $query->fetch_object()) {
            array_push($items, $obj);
        }
        return $items;
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// MODEL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
