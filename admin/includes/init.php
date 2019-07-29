<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
error_reporting(E_ERROR);

require_once '../includes/defines.php';
require_once '../includes/errorHandler.php';

require_once '../includes/session.php';
require_once '../db.php';
//$model = new iabDB();



require_once 'includes/layoutHelper.php';
require_once 'includes/modelHelper.php';
require_once 'includes/helper.php';


require_once 'controller.php';
$controller = new controller();

$task = filter_input(INPUT_GET, 'task');

