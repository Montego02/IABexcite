<?php

class compController extends controller {

    protected $task;
    protected $view;
    public $table;

    function __construct() {
        $this->comp = "anfragen";
        $this->table = "j25f_anfragen";
          $this->view = "listView"; // default view
          
        // get view if set - otherwise dont overwrite default 
        if (isset($_GET['view'])) {
            $this->view = filter_input(INPUT_GET, 'view');
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

// =======================================================================================    
// control tasks (standard tasks are in main controller, f.e. view, save, delete)
// =======================================================================================    

   

}
