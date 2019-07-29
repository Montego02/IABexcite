<?php

class compController extends controller {

    protected $task;
    protected $view;
    public $table;

    function __construct() {
        $this->com = "downloads";
        $this->table = "iab_downloads";
        $this->view = "listView"; // default view
        // get view if set - otherwise dont overwrite default 


        $view = helper::getParameter('view', 'str');



        if (!empty($view)) {
            $this->view = $view;
        }

        // handle task before view
        $this->task = filter_input(INPUT_GET, 'task');
        if (isset($this->task)) {
            $task = $this->task;
            $this->$task();
        } else {
            parent::view();
        }
    }

    public function listView() {

        include 'includes/output.php';
    }

}
