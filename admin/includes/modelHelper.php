<?php

class mh {

    public static function getColumn($table, $col) {
        $db = IabDB::getInstance();
        $q = $db->query(" SELECT id," . $col . " FROM " . $table . " ");
        $items = $q->fetch_all();
        return $items;
    }

    public static function getOptionsFromColumn($table, $col, $selectedId) {
        $db = IabDB::getInstance();
        $query = " SELECT id, " . $col . " FROM " . $table;

        $q = $db->query($query);

        $html = '';
        while ($obj = $q->fetch_object()) {
            $html .= "<option value='$obj->id'>" . $obj->$col . "</option>";
        }
        return $html;
    }

    public static function getUsernameById($id) {
        $db = IabDB::getInstance();
        $q = $db->query("SELECT name FROM iab_users WHERE id = " . $id);
        $item = $q->fetch_object();
        return $item->name;
    }

    public static function sendMail($recipient, $subject, $body) {
        require_once $_SERVER['DOCUMENT_ROOT'] . 'includes/phpmailer/phpmailer.php';
        $mail = new PHPMailer;
        $mail->CharSet = 'utf-8';
        ini_set('default_charset', 'UTF-8');
        $mail->setFrom('marketing@app-entwickler-verzeichnis.de', SITE); // EMAIL constant is kontakt@... but we send it to gino ;)
        $mail->addAddress($recipient);
        $mail->addAddress('marketing@app-entwickler-verzeichnis.de');
        $mail->addAddress('kontakt@app-entwickler-verzeichnis.de');

        $mail->Subject = $subject;

        $mail->msgHTML($body);
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getProduktkategorienAsDD($id, $parentsOnly) {
        $db = IabDB::getInstance();

        if ($parentsOnly) {
            $result = $db->query("SELECT id, titel FROM produktkategorien WHERE parent = 0 ORDER BY id ASC");
        } else {
            $result = $db->query("SELECT id, titel FROM produktkategorien ORDER BY id ASC");
        }

        $html = "";
        while ($obj = $result->fetch_object()) {
            $html .= "<option value='" . $obj->id . "'";
            if ($id == $obj->id) {
                $html .= " selected ";
            }
            $html .= ">" . $obj->titel . "</option>";
        }
        return $html;
    }

    public static function getAricleTitles() {
        $db = IabDB::getInstance();
        $q = $db->query("SELECT id, title FROM iab_content");

        while ($obj = $q->fetch_object()) {
            $arr[$obj->id] = $obj->title;
        }
       
        return $arr;
    }

    public static function clean($var) {
        $db = IabDB::getInstance();
        return mysqli_real_escape_string($db, $var);
    }

    
    
    
}
