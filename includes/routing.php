<?php

/*
  SEO LINK HANDLING

 */

$uri = $_SERVER['REQUEST_URI'];
$arrPath = explode("/", $uri);

$lastSeg = $arrPath[count($arrPath) - 1];

$arrId = explode("-", $lastSeg);
$id = $arrId[0]; // id (index 0) of active (last) url element OR sef url


$arrBaseId = explode("-", $arrPath[1]); // hmm dont really know why 0 is empty but we need 1 then... 
$baseId = $arrBaseId[0]; // id of FIRST url element for side menu building
$_SESSION['baseId'] = $baseId;
$_SESSION['baseClass'] = helper::encodeUrl($arrBaseId[1]);

// main path -> link of main menu button (because its not included in sidemenu so we have to transport it
$mainPath = $arrPath[1];


if (!is_numeric($id)) {
    switch ($id) {
        case "service":
            $_SESSION['com'] = 'users';
            $_SESSION['view'] = 'login';
            break;
        case "contact":
            $_SESSION['com'] = 'content';
            $_SESSION['view'] = 'form';
            break;
        case "downloads":
            $_SESSION['com'] = 'downloads';
            $_SESSION['view'] = 'listView';
            break;
        default:
            $frontpage = true;
            $_SESSION['com'] = 'content';
            $_SESSION['view'] = 'article';
            // on frontpage we load by id depending on language
            switch ($lang) {
                case "DE":
                    $id = 100;
                    break;
                case "EN":
                    $id = 132;
                    break;
                case "CN":
                    $id = 132;
                    break;
                default:
                    $id = 100;
            }

            
    }
} else {
    $_SESSION['com'] = 'content';
    $_SESSION['view'] = 'article';
}







$_SESSION['id'] = $id;







//die($id);

//$db = IabDB::getInstance();
//$query = $db->query("SELECT * FROM iab_content WHERE id = ".$id);
//$item = $query->fetch_object();





