<?php

defined('IAB') or die;

require_once 'includes/errorHandler.php';




require_once 'includes/defines.php';

require_once 'db.php';

require_once 'includes/helper.php';

require_once 'includes/session.php';
session_start();


// set or get language
if ($_GET['lang']) {
    $_SESSION['lang'] = $_GET['lang'];
}
if (empty($_SESSION['lang'])) {
    $_SESSION['lang'] = 'DE';
}
$lang = $_SESSION['lang'];


require_once 'includes/routing.php';


require_once 'controller.php';
$controller = new controller();




// get vars

$useragent = $_SERVER['HTTP_USER_AGENT'];
$com = helper::getParameter('com', 'str');

if (!$com) {$com = "content";}



if ($com) {
    // get component
    require_once 'components/' . $com . '/model.php';
    require_once 'components/' . $com . '/controller.php';
    $compController = new compController(); // instantiate COMPONENTS controller
} else {
    
    
}




