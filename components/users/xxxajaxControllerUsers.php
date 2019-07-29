<?php

// PURE AJAX FILE: is not included but directly called from model.js
// therefore we have to include db.php and make a own instance of this controller
session_start();
require_once 'db.php';
require_once 'includes/defines.php';
require_once 'includes/fctry.php';
require_once 'includes/helper.php';
$controller = new controller();


class controller {

    function __construct() {
        $task = filter_input(INPUT_GET, 'task');

        if (empty($task)) {
            
        } else {
            $this->$task(); // execute task (start function with the name of the variable task)
        }
    }

    public function resetPass() {
        include "components/users/model.php";
        $model = new Model();
        $user = $model->login();

        die(json_encode($_SESSION));
    }

}