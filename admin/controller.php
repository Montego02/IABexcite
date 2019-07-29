<?php

class controller {

    function __construct() {
        $task = filter_var($_GET['task']);

        // only manage core tasks in main controller
        if ($task == "login" ||
                $task == "logout"
        ) {
            $this->$task(); // execute task (function with the name of the variable task)
        }
    }

    public function view() {
        $view = $this->view;
        $content = $this->$view();
        
        // possibility for content modification
        echo $content;
    }

    public function detail() {
        if ($_GET['id'] || $_GET['ownerid']) {
            $item = Model::getItem($this->table);
        }

        ob_start();
        require "components/" . $this->comp . "/views/" . $this->view . ".php";
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    
    public function listView() {
        $items = Model::getItems($this->table);
        ob_start();
        require "components/" . $this->comp . "/views/" . $this->view . ".php";
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function save() {
        $items = model::saveItem($this->table);
        $this->view();
    }

    public function delete() {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
// ugly: model stuff in controller 
        $db = IabDB::getInstance();
        $db->deleteItem($this->table, $id);
        $this->view();
    }

    public function deleteList() {
        // ugly: model stuff in controller 
        $db = IabDB::getInstance();
        $db->deleteList($this->table, $ids);
        $this->view();
    }
    
       public function copySelection() {
        $db = IabDB::getInstance();
        $db->copySelection($this->table);
        $this->view();
    }
    
    
    

    public function login() {
// delegate to component users model
        require_once 'components/users/model.php';
        $model = new model();
        $user = model::login();
        
        if ($user->id > 0) {
            session_unset();
            $_SESSION['logged'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['time'] = time();
        } else {
            $_SESSION['loginFailed'] = true;
        }
    }

    public function logout() {
        session_unset();
        $_SESSION['msg'] = "Sie wurden erfolgreich abgemeldet";
    }

//////////////////////////////////////////////////////////////////////////////////////////
// AJAX FUCNTIONS


    function changeStatus() {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

// MISSING CHECK: does user own this id?


        $obj = new stdClass();

        if ($_POST['status'] == "0" || $stausOld == "-1") {
            $obj->status = 1;
        } else {
            $obj->status = -1;
        }


        $return = IabDB::updateObject($this->table, $obj, $id);
        die($return);
    }

}

?>