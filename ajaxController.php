<?php

define('IAB', 'true'); // define valid entry point
// PURE AJAX FILE: is not included but directly called from model.js
// therefore we have to include db.php and make a own instance of this controller
//require_once 'db.php';

require_once('includes/errorHandler.php');

$controller = new controller();

class controller {

    private $_fileInfo; // class variables to collect fileInformation (path)
    private $_searchText;

    function __construct() {
        $task = filter_input(INPUT_GET, 'task');

        $this->_fileInfo = array();

        if (empty($task)) {
            
        } else {
            $this->$task(); // execute task (start function with the name of the variable task)
        }
    }

    public function scanDir() {
        $path = 'images/downloads' . $_POST['path'];
        $files = scandir($path);
        die(json_encode($files));
    }

    public function scanDirRecursive($path) {
        $files = scandir($path);
        return $files;
    }

    // recursively scan all folders and search for class variable _searchText
    public function scanSearch($path) {

        $path = rtrim($path, '/');

        if (!is_dir($path)) {
            if (strpos($path, $this->_searchText) ||
                    strpos($path, strtoupper($this->_searchText))
            ) { // compare with search text
                $this->_fileInfo[] = $path;
            }
        } else {
            $files = scandir($path);

            foreach ($files as $file)
                if ($file != '.' && $file != '..')
                    $this->scanSearch($path . '/' . $file);
        }
    }

//    function loadPdf() {
//        $path = "/MSI/2050000001/Index 0/2050000001.pdf";
//
//        $im = new Imagick();
//        $im->setResolution(300, 300);
//        $im->readImage($path);
//    }

    function saveData() {

        $data = $_POST;
        die(json_encode($data));
    }

// text search in all folders
    function searchAll() {
        $this->_searchText = $_POST['search'];
        $this->scanSearch('images/downloads/');
        die(json_encode($this->_fileInfo));
    }

   

    
    

}

/*
  function getRef() {
  $db = IabDB::getInstance();
  $q = $db->query("SELECT * FROM referenzen WHERE status = 1 ORDER BY RAND() ");


  $items = array();
  while ($obj = $q->fetch_object()) {

  // load images
  $dir = "images/referenzen/apps/" . $obj->id;
  if (is_dir($dir)) {
  $dh = opendir($dir);
  while (false !== ($filename = readdir($dh))) {
  if (strpos($filename, ".jpg") || strpos($filename, ".png")) { // only show certain formats
  $obj->images[] = $dir . "/" . $filename;
  }
  }
  }
  array_push($items, $obj);
  }
  die(json_encode($items));
  }

  function sendInfo() {
  $data = $_POST;

  include 'includes/phpmailer/phpmailer.php';
  $mail = new PHPMailer;
  $mail->CharSet = 'utf-8';
  ini_set('default_charset', 'UTF-8');
  $mail->setFrom(EMAIL, SITE);

  $mail->addAddress('kontakt@internet-agentur-bodensee.com');
  $mail->addAddress('aw@winkler-technik.de');


  $mail->Subject = 'Neue Anfrage von Winkler-Technik.de';

  $msgBody = "<h2>Neue Anfrage von der Website</h2>"
  . "Name: " . $data['name'] . "<br>"
  . "E-Mail: " . $data['email'] . "<br>"
  . "Teil: " . $data['teil'];

  $mail->msgHTML($msgBody);

  if (!$mail->send()) {
  $msg = "Mailer Error: " . $mail->ErrorInfo;
  } else {
  $msg = "Mail wurde versendet.";
  }

  die($msg);
  }

 */

    