<?php
include $_SERVER['DOCUMENT_ROOT'] . 'db.php';
include $_SERVER['DOCUMENT_ROOT'] . 'includes/defines.php';
include $_SERVER['DOCUMENT_ROOT'] . 'includes/errorHandler.php';
include $_SERVER['DOCUMENT_ROOT'] . 'admin/includes/modelHelper.php';



$task = filter_input(INPUT_GET, 'task');
if (isset($task)) {
    $task();
}



function sendActivatedMessage(){
     
    $data = $_POST;

    // subject und body element laden
    include $_SERVER['DOCUMENT_ROOT'] . 'admin/components/verzeichnis/mails/aktiviert.php';
    // footer laden
    include $_SERVER['DOCUMENT_ROOT'] . 'admin/components/anfragen/mails/footer.php';

    $sent = mh::sendMail($data['email'], $subject, $body);

    if ($sent) {
        die(true);
    } else {
        die(false);
    }
    
    
}



function generateInvoice() {
    
   $db = IabDB::getInstance();
   
   parse_str($_POST['form'], $params); // unserialize form data into arr $params

   $obj = (object) $params; // cast into object
 
    $obj->datum = date('Y-m-d');    
    
    $obj->tx = "Admin->Verzeichnis->" . $obj->numberOS . " Betriebssystem(e)";
    unset($obj->numberOS);
    
    $obj->status = "Rechnung gestellt";
  
    $handle = $db->insertObject('j25f_zahlungen', $obj);
    
    // save action
    if ($handle) {
        $txt = $obj->date . " " . $obj->anfrage . " ";
    }
    
    die($handle);
}


//// done in detailRechnungen
//function getZahlungen(){
//      $db = IabDB::getInstance();
//    $userid = $_POST['userid'];
//    $db = IabDB::getInstance();
//    $q = "SELECT anfrage, datum, status, tx FROM j25f_zahlungen WHERE userid = " . $userid . " ORDER BY id DESC LIMIT 30";
//    $query = $db->query($q);
//    $items = $db->loadObjectList($query);
//    die(json_encode($items));
//}


function bookPremiumPayment() {
   
    $db = IabDB::getInstance();
    $data = new stdClass();
    $data->id = $_POST['id'];
    $data->status = "Premium erhalten";

    if ($db->updateObject('j25f_zahlungen', $data, 'id')) {
        return true;
    } else  {
        return false;
    }
    
    
}




function saveComment() {
    $obj = (object) $_POST;
    $obj->date = date("Y-m-d");
    $db = IabDB::getInstance();
    $h = $db->insertObject('j25f_anfrageActions', $obj);

    die($h);
}





function getStornoQuota()  {
    $db = IabDB::getInstance();
    $userid = $_POST['id'];
    $db = IabDB::getInstance();
    $q = "SELECT status, count(status) as sum  FROM j25f_zahlungen WHERE userid = " . $userid . "  GROUP BY status ";
    $query = $db->query($q);
    $items = $db->loadObjectList($query);
    die(json_encode($items));
    
}
