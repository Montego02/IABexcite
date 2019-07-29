<?php

class compController extends controller {

    protected $task;
    protected $view;
    public $table;

    function __construct() {
        $this->comp = "verzeichnis";
        $this->table = "j25f_verzeichnis";
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

    
    function premium() {
        
        $items = Model::loadPremiums();
        $re = Model::loadOpenRe();
        
        require $_SERVER['DOCUMENT_ROOT'] . "/admin/includes/output.php";
        
        
        
    }
    
    
   

}
