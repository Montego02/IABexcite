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


        include 'includes/output.php';
    }

    public function detail() {
        if ($_GET['id']) {
            $item = ModelContent::getItem($this->table);
        }
        
      include 'includes/output.php';
    }

    public function listView() {
        $items = ModelContent::getItems($this->table);
        ob_start();
        require "components/" . $this->com . "/views/" . $this->view . ".php";
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function plainView() {
        ob_start();
        require "components/" . $this->com . "/views/" . $this->view . ".php";
        $html = ob_get_contents();
        
        $html = str_replace('../images', 'images', $html); // make images in content root relative
        
         $_SESSION['html'] = $html;
        
        ob_end_clean();
        return $content;
    }

    public function loadDetail() {

        $id = $_GET['id'];
        $db = IabDB::getInstance();
        $query = $db->query("SELECT * FROM images WHERE id = " . $id);
        $item = $query->fetch_object();
        return ($item);
    }

    public function loadPagination() {

        $cat = $_GET['cat'];
        $id = $_GET['id'];

        $db = IabDB::getInstance();

        //$arrow = [];

        if (is_numeric($cat)) {
            $query = $db->query("SELECT id FROM images WHERE kategorie = " . $cat . " ORDER BY ordering ASC ");

            $items = array();
            while ($obj = $query->fetch_object()) {
                if ($obj->id == $id) {
                    // we have the current id
                    $arrow['next'] = $query->fetch_object()->id; // query one more as next
                    break;
                } else {
                    $arrow['prev'] = $obj->id;
                }
            }
        } else {
            die('no cat no fun');
        }


        return ($arrow);
    }

    public function loadCount() {

        $db = IabDB::getInstance();


        if ($_GET['cat'] <= 0) { // only count frontpage hits
            $obj = new stdClass();
            $obj->date = time();
            $db->insertObject('visits', $obj); // count visit
        }
        $n = $db->query("SELECT count(id) AS count FROM visits")->fetch_object()->count;

        return ($n);
    }

    function logout() {
        session_unset();
        $_SESSION['msg'] = "Sie wurden erfolgreich abgemeldet";
        header('Location: /index.php');
    }

    
  

    /*
      public function showMenu() {
      $cat = $_GET['cat'];
      $parent = $_GET['parent'];

      $db = IabDB::getInstance();
      $query = $db->query("SELECT * FROM kategorien ORDER BY parent,ordering ");

      $items = array();

      echo "<ul class='menu'>";

      while ($obj = $query->fetch_object()) {
      $items[] = $obj;
      }

      foreach ($items as $item)
      if ($item->parent == 0) {
      if ($listStarted) { // close last sublist first if open
      echo "</ul>";
      $listStarted = false;
      }

      // highlighting
      if ($cat == $item->id) {
      $class = 'active';
      } else {
      $class = '';
      }
      echo "<li class='" . $class . "'><a href='index.php?cat=" . $item->id . "&parent=" . $item->parent . "'>" . $item->titel . "</a></li>";


      foreach ($items as $sub) {
      if ($sub->parent == $item->id) {
      // create sub list
      if (!$listStarted) {
      echo "<ul>";
      $listStarted = true;
      }

      // highlighting
      // wenn untermenlink        || hauptmenulink    aktiv
      if ($parent == $sub->parent || $cat == $item->id) {
      if ($sub->id == $cat) {
      $class = 'active';
      } else {
      $class = '';
      }
      echo "<li class='" . $class . "'><a href='index.php?cat=" . $sub->id . "&parent=" . $sub->parent . "'>" . $sub->titel . "</a></li>";
      }
      }
      }
      }


      echo "</ul>";
      }

      public function loadList() {

      $cat = $_GET['cat'];



      $db = IabDB::getInstance();
      $query = $db->query("SELECT * FROM images WHERE kategorie = " . $cat . " ORDER BY ordering ASC ");

      $items = array();

      while ($obj = $query->fetch_object()) {
      $items[] = $obj;
      }

      return ($items);
      }
     */
}

?>