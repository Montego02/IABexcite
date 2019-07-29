<?php

// include db for saving item
include '../db.php';
include '../includes/defines.php';

$task = filter_input(INPUT_GET, 'task');
if (isset($task)) {
    $task();
}

function scanDir1() {
    $path = '../images/' . $_POST['path'];
    $files = scandir($path);
    die(json_encode($files));
}

function scanDirRecursive($path) {
    $files = scandir($path);
    return $files;
}

// recursively scan all folders and search for class variable _searchText
function scanSearch($path) {

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

function saveImage() {
    $comp = $_POST['comp']; // post because of ajax
    $return['comp'] = $comp;
    $data = $_POST;
    //$path = $data['path'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
//$token = bin2hex(openssl_random_pseudo_bytes(16));
// handle file upload
        require_once 'includes/classUploads.php';

        if ($comp == "media") {
            $savepath = "../images" .$data['folder'];
        } else {
            $savepath = "../images/content" . $path;
        }


        $return['path'] = $savepath;

        $upload = new Upload($_FILES['image']);
        if ($upload->uploaded) {
            $upload->file_new_name_body = urlencode($upload->file_src_name_body);
            if ($comp == "content") { // resize content pics
                //$upload->allowed = array('image/*');
                $upload->image_convert = 'jpg';
                if ($upload->image_src_x > 1000) {
                    $upload->image_resize = true;
                    $upload->image_x = 1000;
                    $upload->image_ratio_y = true;
                }
            }

            if ($comp == "media") {
                // replace old file by new one -> DELETE old entry
                // ... from server
                $filenames = glob($savepath . "*"); // get all file names
                foreach ($filenames as $filename) { // iterate files
                    if (is_file($filename) && $filename == $savepath . $upload->file_src_name) {
                        $return['overwritten'] = true;
                        unlink($filename); // delete file
                        //echo $filename .  " == " . $savepath . $upload->file_src_name;  
                    }
                }
            }

//                
//                // ... from database
//                $db = IabDB::getInstance();
//                $q = "DELETE FROM images WHERE itemid = '" . $data['id'] . "'";
//                $result = $db->query($q);
//                if ($result)
//                    $return['msg'] .= "Alte Einträge in DB gelöscht.\n";
//                // end deletion
//


            $upload->Process($savepath);
            if ($upload->processed) {
                $return['filename'] .= $upload->file_dst_name;
                $return['msg'] = "Datei wurde hochgeladen. ";


//                if ($comp == "produkte") {
//                    // save entry in table "images"
//                    $img = new stdClass();
//                    $img->itemid = $data['id'];
//                    $img->filename = $upload->file_dst_name;
//                    $img->status = 1;
//                    $result = $db->insertObject('images', $img);
//
//
//                    if ($result)
//                        $return['msg'] .= "Bild in Datenbank gespeichert.";
//                }

                $upload->Clean();
            }
        }
    } else {
        $return['msg'] .= "<br>No file was uploaded";
//header('Location: index.php&task=message&msg='.$token);
    }

    die(json_encode($return));
}






function deleteFile() {
    $path = "../images" . $_POST['path'];
    $filename = $path . "/" . $_POST['filename'];


    if (@file_exists($filename) == true) {
        if (@unlink($filename) == true) {

            $rtn['msg'] = 'Die Datei: ' . $filename . ' wurde erfolgreich gelöscht.';
            $rtn['deleted'] = true;
        } else {

            $rtn['msg'] = 'Die Datei: ' . $filename . ' konnte nicht gelöscht werden!';
        }
    } else {

        $rtn['msg'] = 'Die Datei: ' . $filename . ' ist nicht vorhanden!';
    }

    die(json_encode($rtn));
}


function makeDir(){
     $path = "../images" . $_POST['path'] . "/" . $_POST['folder'];
     $h = mkdir($path);
     
     die (json_encode($h));
    
}

function delDir(){
     $path = "../images" . $_POST['path'];
     $h = rmdir($path);
     die (json_encode($h));
}


function savePdf() {
    $data = $_POST;
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
//$token = bin2hex(openssl_random_pseudo_bytes(16));
// handle file upload
        require_once 'includes/classUploads.php';

        $savepath = '../images/pdfs/';
        $return['path'] = $savepath . $_FILES["pdf"]["name"];

        move_uploaded_file($_FILES["pdf"]["tmp_name"], $savepath . $_FILES["pdf"]["name"]);
        $return['filename'] = $_FILES["pdf"]["name"];
    } else {
        $return['msg'] .= "<br>No file was uploaded";
//header('Location: index.php&task=message&msg='.$token);
    }
    die(json_encode($return));
}

function getPdfs() {
    $dir = "../images/pdfs/";
    if (!is_dir($dir)) {
        die(' directory empty:  ' . $dir);
    }
    $pdfs = scandir($dir);
    unset($pdfs[0]);
    unset($pdfs[1]); // get rid of ./..
    $utfPdfs = array_map("utf8_encode", $pdfs);
    $json = json_encode($utfPdfs);
    if ($json === false) {
        die('encoding failed: ' . json_last_error());
    };
    die($json);
}

function getTags() {
    $db = IabDB::getInstance();
    $tags = $db->getTags();
    die(json_encode($tags));
}

function register() {
    include 'components/users/model.php';
    $return = Model::saveItem('iab_users');
    if ($return->password) {
        die('User erfolgreich angelegt');
    } else {
        die('Der User konnte nicht angelegt werden. Hinweis: das Passwort muss mindestens 6 Zeichen lang sein. ');
    }
}

?>