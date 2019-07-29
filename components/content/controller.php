<?php

class compController extends controller {

    protected $task;
    protected $view;
    public $table;

    function __construct() {
        $this->com = "content";
        $this->table = "iab_content";
        $this->view = "article"; // default view
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

    public function article() {
        $_SESSION['dbg'] = "con";
        $item = ModelContent::getItem($this->table);

        include 'includes/output.php';
    }

    public function form() {
        include 'includes/output.php';
    }

    public function sendMail() {
        // does not work on subdomain
        // https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting
        require 'includes/phpmailer/phpmailer.php';
        $mail = new PHPMailer;
        $mail->CharSet = 'utf-8';
        ini_set('default_charset', 'UTF-8');
        $mail->setFrom(EMAIL, SITE);
        $mail->addAddress(EMAIL);

        $data = $_POST;
        $obj = (object) $data;

        unset($obj->id);

        $mail->subject = "Kontaktformular von ".SITE;
        
        // compile array to email
        $htmlForm = "<style> label {background: #ddd; margin: 3px; padding: 3px 6px; display: inline-block}</style>";
        foreach ($obj as $key => $value) {
            if ($value) {
                $htmlForm .= "<label>" . $key . "</label> " . $value . "</br>";
            }
        }

        $mail->isHTML(true);
        $mail->msgHTML($htmlForm);

        if (!$mail->send()) {
            $msg = "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $msg = "Mail wurde versendet.";
        }
        
        echo $msg;
        die();

        $msg = 'success';
        $msg = "Ihr User wurde angelegt";
       

        $this->view = "form";
        include 'includes/output.php';
    }

    function category() {

        include 'includes/output.php';
    }

// tasks to modify db for moving from joomla to excite


    /*
     * 
     * 
     * ublic function setstatus() {
      $db = IabDB::getInstance();



      $q = "SELECT * FROM jos_content WHERE id > 2000";
      $query = $db->query($q);
      while ($obj = $query->fetch_object()) {
      $obj->status = 1;
      $result = $db->updateObject("jos_content", $obj, $obj->id);
      }
      }
     * 
     * 
      public function addnew() {
      $db = IabDB::getInstance();

      echo "<pre>";

      $q = "SELECT * FROM iab_content2";
      $query = $db->query($q);
      while ($obj = $query->fetch_object()) {
      $obj->status = $obj->state;
      unset($obj->state);
      $obj->language = $obj->lang;
      unset($obj->language);
      $result = $db->insertObject("jos_content", $obj);
      }
      }

      function

      copyfalang() {
      $db = IabDB::getInstance();

      $q = "SELECT id, catid, images FROM jos_content";
      $query = $db->query($q);
      $items = array();
      while ($obj = $query->fetch_object()) {
      array_push($items, $obj);
      }

      echo "<pre>";

      foreach ($items as $item) {
      $q = "SELECT * FROM jos_falang_content WHERE reference_id = " . $item->id;
      $query = $db->query($q);
      $ti = new stdClass(); // translated item

      while ($field = $query->fetch_object()) { // get translations for different fields
      if ($field->reference_field == 'title' || $field->reference_field == 'alias' || $field->reference_field == 'introtext' || $field->reference_field == 'fulltext') {
      $ti->{$field->reference_field} = $field->value;
      }
      }

      $ti->id = $item->id + 2000; // we start new translated articles with id 2000
      $ti->lang = "en";
      $ti->catid = $item->catid;
      $ti->images = $item->images;
      $ti->asset_id = $item->id;


      echo $ti->id . " created <br>";
      $result = $db->insertObject("jos_content", $ti);

      //print_r($ti);
      }
      }
     */
}
