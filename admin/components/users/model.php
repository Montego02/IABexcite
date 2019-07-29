<?php

class Model {

    public static function getItems($table) {
        $db = IabDB::getInstance();

        if ($_POST['id'] || $_POST['name']) {
            $search = true;
            $p = $_POST;
            $_SESSION['searchParameter'] = $_POST;
        } else {
            $p = $_SESSION['searchParameter'];
        }
        
        $q = "SELECT username, name, email,  id FROM " . $table . " WHERE 1=1 ";
        

        if ($search) {
            if ($p['id']) {
                $q .= " AND id = " . $p['id'];
            }
            if ($p['name']) {
                $q .= " AND name LIKE '%" . $p['name']. "%'  OR username LIKE '%" . $p['name']. "%' OR email LIKE '%" . $p['name']. "%'";
            }
            $q.= " ORDER BY username LIMIT 50";
        } else {
            $q.= " LIMIT 0";
        }

      

        $query = $db->query($q);
        $items = array();
        while ($obj = $query->fetch_object()) {
            array_push($items, $obj);
        }
        $db->close();

        return $items;
    }

    public static function getItem($table) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $db = IabDB::getInstance();
        $query = $db->query("SELECT * FROM " . $table . " WHERE id = " . $id);
        $item = $query->fetch_object();
        $db->close();
        return $item;
    }

    public function saveItem($table) {
        $db = IabDB::getInstance();
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $obj = new stdClass();
        $obj->id = $id;
        $obj->name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $obj->email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $obj->status = filter_var($_POST['status']);
        $obj->level = filter_var($_POST['level']);
        $obj->registerDate = date('Y-m-d', time());

        if (strlen($_POST['password']) >= 6) {
            $obj->password = password_hash($_POST['password'], PASSWORD_DEFAULT); // brave new PHP 5.4!
        }

     
        
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

    public function login() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // also for ajax calls important so leave it before verification!
        }

        $db = IabDB::getInstance();
        $username = mh::clean($_POST['username']);
//         $password = mh::clean($_POST['password']);
// XXX identical usernames WONT WORK - check during registration

        $query = $db->query("SELECT * FROM iab_users WHERE username = '" . $username . "'");
        $user = $query->fetch_object();


//  print_r(password_hash($_POST['password'], PASSWORD_DEFAULT));



        //if ($user->id == 509) {

            if (password_verify($_POST['password'], $user->password)) {
                unset($user->password);
                session_unset();
                $_SESSION['logged'] = true;
                $_SESSION['user'] = $user;
                $_SESSION['time'] = time();

                return $user;
            } else {
                $_SESSION['msg'] = "Die eingegebenen Zugangsdaten waren nicht korrekt";
            }
//        } else {
//            $_SESSION['msg'] = "Der angegebene User ist noch nicht freigeschaltet";
//        }
    }

//    
//    
//    
//    
//    
//    
//    
//    
//    
//    
//// FRONT END MODELS    
//    // custom functions
//    public function saveEntry() {
//
//        $date = explode(".", $_POST['date']);
//        $now = date('Y-m-d', time());
//        $date = $date[2] . "-" . $date[1] . "-" . $date[0];
//        $token = bin2hex(openssl_random_pseudo_bytes(16));
//
//        //todo: change to obj form with insertObject
//        $query = "INSERT INTO lit_veranstaltungen (date_recorded, token, title, category, city, cid, area, date, link, text, state) "
//                . "VALUES ('" . $now . "','" . $token . "','" . $_POST['title'] . "','" . $_POST['category'] . "','" . $_POST['city'] . "','" . $_POST['cid'] . "','" . $_POST['area'] . "','" . $date . "','" . $_POST['link'] . "','" . $_POST['text'] . "', '0')";
//
//
//        if (!$this->query($query)) {
//            return("Error " . mysqli_error($this));
//        } else {
//            return $token;
//        }
//    }
//
//    public function saveBanner() {
//        $obj = new stdClass();
//        $obj->dateEntered = date('Y-m-d', time());
//        $obj->token = bin2hex(openssl_random_pseudo_bytes(16));
//        $obj->email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
//        $obj->typ = filter_var($_POST['typ'], FILTER_SANITIZE_NUMBER_INT);
//        $obj->kategorie = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
//
//        if($this->insertObject('lit_banners', $obj)) {
//            return $obj;
//        } else {
//            return false;
//        }
//        
//    }
//
//    public function getVeranstaltungen() {
//
//        $cat = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
//        $cid = filter_var($_POST['cid'], FILTER_SANITIZE_STRING);
//        $area = filter_var($_POST['area'], FILTER_SANITIZE_STRING);
//        $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
//        $date = explode('.', $date);
//        $date = $date[2] . "-" . $date[1] . "-" . $date[0];
//
//        $q = "SELECT * FROM lit_veranstaltungen";
//
//        // filtering
//
//        if ($cat > 10) { // 10 = alle
//            $arrWhere[] = " category = " . $cat;
//        }
//
//        if ($cid > 0) {
//            $arrWhere[] = " cid = '" . $cid . "'";
//        }
//
//        if ($area > 0) {
//            $arrWhere[] = " area = '" . $area . "'";
//        }
//
//
//        if (sizeof($arrWhere) > 0) {
//            $strWhere = " WHERE " . implode(" AND ", $arrWhere); // implode filters
//            $q .= $strWhere; // add where clause to query
//        }
//
//        $q .= " ORDER BY date ";
//
//        $query = $this->query($q);
//        $result = array();
//
//        while ($obj = $query->fetch_assoc()) {
//            array_push($result, $obj);
//        }
//
//        $this->close();
//
//        return $result;
//        //return $q;
//    }
//
//    public function getCategories() {
//
//
//        $query = $this->query("SELECT * FROM lit_categories  ");
//        $result = array();
//        while ($obj = $query->fetch_assoc()) {
//            array_push($result, $obj);
//        }
//        $this->close();
//
//
//        return $result;
//    }
//
//    public function getCities() {
//        $query = $this->query("SELECT id, name, area FROM lit_cities ORDER BY name");
//        $result = array();
//        while ($obj = $query->fetch_assoc()) {
//            array_push($result, $obj);
//        }
//        $this->close();
//        return $result;
//    }
//    
//    
//    public function getBanners() {
//        $query = $this->query("SELECT token, link FROM lit_banners "
//                ." WHERE status = 1 AND dateUntil > NOW()"
//                ." ORDER BY RAND() "
//                ." LIMIT 3 " );
//        
//        $result = array();
//        while ($obj = $query->fetch_assoc()) {
//            array_push($result, $obj);
//        }
//        $this->close();
//        return $result;
//    }
}
