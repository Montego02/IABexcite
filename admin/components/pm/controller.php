<?php

class compController extends controller {

    protected $task;
    protected $view;
    public $table;

    function __construct() {
        $this->comp = "pm";
        $this->table = "j25f_pm";
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


    function detail() {


        $item = Model::getItem($this->table);
        if ($item->anfrage) {
            $anfrage = Model::getAnfrage($item->anfrage);
        }

        ob_start();
        require "components/" . $this->comp . "/views/" . $this->view . ".php";
        $content = ob_get_contents();
        ob_end_clean();

        echo $content;
    }

    function angebot() {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $items = Model::loadAngebot();
        if ($id) {
            $anfrage = Model::getAnfrage($id);
        }

        ob_start();
        require "components/" . $this->comp . "/views/" . $this->view . ".php";
        $content = ob_get_contents();
        ob_end_clean();

        echo $content;
    }

}
