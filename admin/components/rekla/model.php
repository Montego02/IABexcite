<?php

class Model {

    public static function getItems($table) {
        $db = IabDB::getInstance();

        if ($_POST['id'] || $_POST['name']) {
            
        } else {
            
        }


        $q = "SELECT * FROM " . $table
                // . " LEFT JOIN j25f_zahlungen AS z ON r."
                . " WHERE status = '' AND userid > 0"
                . " ORDER BY id DESC "
                . " LIMIT 50 ";


        $query = $db->query($q);

        $items = array();
        while ($obj = $query->fetch_object()) { // query reklas and add further info
            if ($obj->userid) {
                $arrAnfrage = explode(" - ", $obj->anfrage);
                $obj->anfrageid = $arrAnfrage[0];
                $obj->titel = $arrAnfrage[1];
                $obj->kaufdatum = $arrAnfrage[2];

                if ($obj->anfrageid > 0) {
                    $q = "SELECT id, status, amount, tx FROM j25f_zahlungen WHERE anfrage = " . $obj->anfrageid . " AND userid = " . $obj->userid;
                    $obj->zahlung = $db->query($q)->fetch_object();

                    $q = "SELECT id, title, email FROM j25f_verzeichnis WHERE owner = " . $obj->userid;
                    $obj->ent = $db->query($q)->fetch_object();
                }
                array_push($items, $obj);
            }
        }

//        print_r($items);
//        die();



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

//    public function saveItem($table) {
//        $db = IabDB::getInstance();
//        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
//        $obj = new stdClass();
//        $obj->name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
//        $obj->email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
//        $obj->status = filter_var($_POST['status']);
//        $obj->level = filter_var($_POST['level']);
//        $obj->registerDate = date('Y-m-d', time());
//
//        if (strlen($_POST['password']) >= 6) {
//            $obj->password = password_hash($_POST['password'], PASSWORD_DEFAULT); // brave new PHP 5.4!
//        }
//
//        if ($id > 0) {
//            $result = $db->updateObject($table, $obj, $id);
//        } else {
//            $result = $db->insertObject($table, $obj);
//        }
//
//        if ($result) {
//            return $obj;
//        } else {
//            return false;
//        }
//    }


    public static function solveRekla() {

        $data = $_POST;
        $db = IabDB::getInstance();

        $msg = "";

        //print_r ($data); die();
        // Table zahlungen ändern
        if ($data['zahlungsId'] > 0) { // Rückerstattung
            $zahlung = new stdClass();
            $zahlung->id = $data['zahlungsId'];
            $zahlung->status = "storniert";
            $zahlung->changed_latest = date('Y-m-d');

            $db->updateObject("j25f_zahlungen", $zahlung, "id");
            $msg .= "<li>Zahlung storniert</li>";
        }

        //credits aufbuchen wenn Credits übergeben; sonst andere Erstattungsweise		
        if ($data['credits'] > 0) {

            // datensatz vorbereiten
            $aufb = new stdClass();
            $aufb->userid = $data['user'];
            $dat = date('Y-m-d');

            // alten Stand der Credits abfragen und übernehmen
            $query = "SELECT id, credits, tx FROM j25f_credits WHERE userid = '" . $data['user'] . "'";
            $res = $db->query($query)->fetch_object();

            if ($res->id > 0) { // bereits Creditkonto angelegt
                // alten Text abfragen und übernehmen
                $aufb->tx = $res->tx . "," . $dat . ": StornoCrRekla+" . $data['credits'] . "<br>";
                $aufb->credits = $res->credits + $data['credits'];
                $db->updateObject("j25f_credits", $aufb, "userid");
                $msg .= "<li>" . $data['credits'] . " Credits bei " . $aufb->userid . " aufgebucht</li>";
            } else { // neuer Credit Owner
                $aufb->credits = $data['credits'];
                $aufb->tx = $dat . ": StornoCrRekla+" . $data['credits'] . "<br>";
                $db->insertObject('j25f_credits', $aufb);
                $msg .= "<li>Neuen Credit Owner angelegt: ID" . $data['user'] . "</li>";
            }
        }


        // rekla status ändern

        $rekla = new stdClass();
        $rekla->id = $data['id'];
        $rekla->status = $data['status'];
        $rekla->actions = $data['actions'];
        $stored = $db->updateObject("j25f_reklamationen", $rekla, "id");

        if ($stored) {
            $msg .= '<li>Speichern war erfolgreich</li>';
        } else {
            $msg .= '<li>Fehler beim Speichern</li>';
        }



        // ----------------------------------------------
        // message an Reklamationeur
        require_once $_SERVER['DOCUMENT_ROOT'] . 'admin/includes/modelHelper.php';

        if ($data['status'] == "deleted") {
            // wenn abgelehnt
            include $_SERVER['DOCUMENT_ROOT'] . 'admin/components/rekla/mails/' . $data['message'] . '.php';
        } else {
            // Gutschrift -> benachrichtigen
            if ($data['credits'] > 0) {
                $erstattungsweise = "Credits";
            } else {
                $erstattungsweise = "PayPal";
            }
            include $_SERVER['DOCUMENT_ROOT'] . 'admin/components/rekla/mails/erstattung.php';
        }


        include $_SERVER['DOCUMENT_ROOT'] . 'admin/components/anfragen/mails/footer.php';


        // messages to admins
        $sent = mh::sendMail($data['email'], $subject, $body);



        if ($sent !== true) {
            $msg .= 'Error sending email<br>';
        } else {
            $msg .= '<li>Benachrichtigung gesendet</li>';
        }

        $_SESSION['msg'] = $msg;

        return true;
    }

}
