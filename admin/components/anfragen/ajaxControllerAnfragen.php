<?php

include $_SERVER['DOCUMENT_ROOT'] . 'db.php';
include $_SERVER['DOCUMENT_ROOT'] . 'includes/defines.php';
include $_SERVER['DOCUMENT_ROOT'] . 'admin/includes/modelHelper.php';



$task = filter_input(INPUT_GET, 'task');
if (isset($task)) {
    $task();
}

function sendMessage() {

    $data = $_POST;

    // subject und body element laden
    include $_SERVER['DOCUMENT_ROOT'] . 'admin/components/anfragen/mails/' . $data['message'] . '.php';
    // footer laden
    include $_SERVER['DOCUMENT_ROOT'] . 'admin/components/anfragen/mails/footer.php';

    $sent = mh::sendMail($data['email'], $subject, $body);
    
    // messages to admins
//     mh::sendMail('marketing@app-entwickler-verzeichnis.de', $subject, $body);
//     mh::sendMail('kontakt@app-entwickler-verzeichnis.de', $subject, $body);

    if ($sent) {
        die(true);
    } else {
        die(false);
    }
}

function saveAction() {
    $obj = (object) $_POST;
    $obj->date = date("Y-m-d");
    $db = IabDB::getInstance();
    $h = $db->insertObject('j25f_anfrageActions', $obj);

    die($h);
}

function loadActions() {
    $id = $_POST['id'];
    $db = IabDB::getInstance();
    $q = "SELECT * FROM j25f_anfrageActions WHERE anfrage = " . $id . " ORDER BY id DESC";
    $query = $db->query($q);
    $items = $db->loadObjectList($query);
    die(json_encode($items));
}


function loadZahlungen() {
    $id = $_POST['id'];
    $db = IabDB::getInstance();
    $q = "SELECT * FROM j25f_zahlungen WHERE anfrage = " . $id;
    $query = $db->query($q);
    $items = $db->loadObjectList($query);
    die(json_encode($items));
}

function loadFragen() {

    $id = $_POST['id'];
    $db = IabDB::getInstance();
    $q = "SELECT * FROM j25f_anfragenFragen WHERE anfrage = " . $id . " ORDER BY id DESC";
    $query = $db->query($q);
    $items = $db->loadObjectList($query);

    die(json_encode($items));
}

function saveAnswer() {
    $id = $_POST['id'];
    $db = IabDB::getInstance();
    $obj = new stdClass();
    
    // wird keine frage übergeben, hat admin frage gelöscht -> komplette zeile löschen
    if (!$_POST['frage']) {
        $db->deleteItem('j25f_anfragenFragen', $id);
        die('deleted');
    }
    
    $obj->id = $id;
    $obj->antwort = $_POST['ans'];
    $obj->frage = $_POST['frage'];
    $query = $db->query($q);
    $res = $db->updateObject('j25f_anfragenFragen', $obj, 'id');
    if ($res) {
        die(true);
    } else {
        die(false); 
    }
}


function createProject() {
    $obj->anfrage = $_POST['anfrage'];
    $db = IabDB::getInstance();
    $h = $db->insertObject('j25f_pm', $obj);

    die($h);
}
