<?php

class compController extends controller {

    protected $task;
    protected $view;
    public $table;

    function __construct() {
        $this->com = "users";
        $this->table = "iab_users";
        $this->view = "login"; // default view
        // get view if set - otherwise dont overwrite default 
        $view = helper::getParameter('view', 'str');
        if (isset($view)) {
            $this->view = helper::getParameter('view', 'str');
        }

        // handle task before view
        $this->task = filter_input(INPUT_GET, 'task');

        if (isset($this->task)) {
            //die($this->task);
            $task = $this->task;
            $this->$task();
        } else {
            if ($this->view == 'detail' || $this->view == 'listView') { // handle standard view in main controller
                parent::view();
            } else {
                $this->$view(); // special views here
                //parent::plainView();
            }
        }
    }

// =======================================================================================    
// control VIEWS
// =======================================================================================    

    function register() {
        parent::plainView();
    }

    // show login form != doLogin
    function login() {
       
//        if ($this->view == "login") {
//            $this->view = 'start';
//        }
        parent::plainView();
    }

    function logout() {
        session_destroy();
        $_SESSION = [];
        return true;
    }

    function reset1() {
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['task']);
        unset($_SESSION['msg']);
        unset($_SESSION['msgType']);

        parent::plainView();
    }

    
    // deprecated
//    function start() {
//        $user = $_SESSION['user'];
//        if ($user) {
//            include 'includes/output.php';
//        } else {
//            $_SESSION['msg'] = "Deine Sitzung ist abgelaufen. Bitte melde Dich erneut an";
//            header("Location: /index.php?com=users&view=register");
//        }
//    }

    function profile() {
        $user = $_SESSION['user'];
        if ($user) {


            include 'includes/output.php';
        } else {
            $_SESSION['msg'] = "Deine Sitzung ist abgelaufen. Bitte melde Dich erneut an";
            header("Location: /index.php?com=users&view=register");
        }
    }

// =======================================================================================    
// TASKS
// =======================================================================================    

    function doLogin() {
        // SEE ajx/users.php
//        $user = model::login();
//        die(json_encode($user));
    }

    function doRegister() {
        $user = model::registerUser($this->table);

        if ($user) {
            $this->view = "profile";
        } else {
            $this->view = "register";
        }
        include 'includes/output.php';
        
        
        
    }

    function resetPass() {
        $user = model::resetPass();
        if ($user) {
            $this->view = "login";
            $showstart = TRUE;
        } else {
            $this->view = "register";
        }
        include 'includes/output.php';
    }

    // Resetting Password:
    // 1. Enter Mail and receive reset token
    // 2. Enter new password in reset2 view
    // 3. send and Change password, redirecting to login
    function resetPass1() {
        $sendReset = model::resetPass1();
        if ($sendReset) {
            $showstart = TRUE; // goto frontpage after e-mail is entered
        } else {
            $this->view = "register"; // this should not happen
        }
        include 'includes/output.php';
    }

    function resetPass2() {
        $this->view = "reset2";
        include 'includes/output.php';
    }

    function resetPass3() {
        $reset3 = model::resetPass3();
        if ($reset3) {
            $this->view = "login";
            header('Location: ' . URL . '/index.php?com=users&view=login&msg=' . $_SESSION['msg']); // we have to forward to get rid of task
        } else {
            $this->view = "reset1";
        }

        include 'includes/output.php';
    }

    function deleteUser() {
        $user = $_SESSION['user'];
        $db = IabDB::getInstance();

        //$rtn['user'] = $user;

        if ($user->id > 0) {
            $q = "DELETE FROM `j25f_verzeichnis` WHERE owner = " . $user->id;
            $vdel = $db->query($q);
            if ($vdel) {
                $rtn['msg'] = "Ihr Firmenprofil wurde aus dem Verzeichnis gelöscht <br>";
            }

            $q = "DELETE FROM `j25f_users` WHERE id = " . $user->id;
            $udel = $db->query($q);
            if ($udel) {
                $rtn['msg'] = "Ihr User wurde gelöscht <br>";
            }

            if (!$vdel && $udel) {
                $rtn['msg'] = "Das Löschen hat nicht geklappt.";
            }

            session_destroy();
        } else {
            $rtn['msg'] = "Das Löschen hat nicht geklaptt, weil Sie nicht (mehr) eingelogged sind";
        }

        die(json_encode($rtn));

        // ajax now
        //header('Location: http://app-entwickler-verzeichnis.de/index.php?&msg=' . $_SESSION['msg']); // we have to forward to get rid of task
    }

    public function unsubscribe() {
        $user = helper::sani($_GET['userid'], int);

        if ($user > 0) {
            $db = IabDB::getInstance();
            $q = "UPDATE j25f_users SET emailNewsletter = -1 WHERE id = " . $user;
            if ($db->query($q)) {
                $_SESSION['msgType'] = "success";
                $_SESSION['msg'] = "Sie wurden vom Newsletter entfernt";
                header('Location: index.php');
                die();
            }
        }
    }

}
