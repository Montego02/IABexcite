<?php

class Model {

    public static function getItem($table) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $db = IabDB::getInstance();
        $query = $db->query("SELECT * FROM " . $table . " WHERE id = " . $id);
        $item = $query->fetch_object();
        return $item;
    }

    public function registerUser($table) {
        $db = IabDB::getInstance();

        if ($_POST['code'] == "6482") {
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $obj = new stdClass();
            $obj->id = $id;
            $obj->username = mysqli_real_escape_string($db, filter_var($_POST['username'], FILTER_SANITIZE_STRING));
            $obj->email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));


            // check if mail was entered
            if (!$obj->email) {
                $_SESSION['msgType'] = 'alert';
                $_SESSION['msg'] = "Die eingegebene E-Mail Adresse war nicht korrekt.";
                return false;
            } else {
                // check if email exists already
                $db = IabDB::getInstance();
                $query = $db->query("SELECT id FROM " . $table . " WHERE email = '" . $obj->email . "' OR username = '" . $obj->username . "'");
                $item = $query->fetch_object();

                if ($item) {
                    $_SESSION['msgType'] = 'alert';
                    $_SESSION['msg'] = "Die eingegebene E-Mail Adresse oder der Username existiert bereits.";
                    return false;
                }
            }

            $obj->registerDate = date('Y-m-d H:i:s', time());

            $obj->state = 1;
            $obj->level = 1;
            $obj->activation = sha1($obj->email . 'addSaltNOsalsa');

            if (strlen($_POST['password']) >= 6) {
                $obj->password = password_hash($_POST['password'], PASSWORD_DEFAULT); // brave new PHP 5.4!
            } else {
                $_SESSION['msgType'] = 'alert';
                $_SESSION['msg'] = "Das Passwort muss mindestens 6 Zeichen lang sein.";
                return false;
            }


            if ($id > 0) {
                $result = $db->updateObject($table, $obj, 'id');
            } else {
                $result = $db->insertObject($table, $obj);
                $obj->id = $db->insert_id;
            }

            

            if ($result) {

                // save user to session
                if (session_status() == PHP_SESSION_NONE) {
                    session_start(); // also for ajax calls important so leave it before verification!
                }
                $_SESSION['user'] = $obj;

                // FEHLT versendung aktivierungslink
                // send message 
                include ('includes/phpmailer/phpmailer.php');
                $mail = new PHPMailer;
                $mail->CharSet = 'utf-8';
                ini_set('default_charset', 'UTF-8');
                $mail->setFrom(EMAIL, SITE);
                $mail->addAddress($obj->email);
                $mail->addBCC('kontakt@app-entwickler-verzeichnis.de');

                include ('includes/phpmailer/mails/activation.php'); // contains $msgBody

                $mail->msgHTML($msgBody);

                if (!$mail->send()) {
                    $msg = "Mailer Error: " . $mail->ErrorInfo;
                } else {
                    $msg = "Mail wurde versendet.";
                }

                $_SESSION['msgType'] = 'success';
                $_SESSION['msg'] = "Ihr User wurde angelegt";
                return $obj;
            } else {
                $_SESSION['msgType'] = 'alert';
                $_SESSION['msg'] = "Der User konnte aufgrund eines Datenbankproblems nicht angelegt werden. Bitte informieren Sie den Administrator: " . EMAIL_ADMIN;
                return false;
            }
        } else {
            $_SESSION['msgType'] = 'alert';
            $_SESSION['msg'] = "Bad Captcha.";
             return false;
        }
    }

    public function login() {
        // see ajx
    }

    public static function resetPass1() {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if ($email) {
            // check if user exists
            $db = IabDB::getInstance();
            $query = $db->query("SELECT * FROM iab_users WHERE email = '" . $email . "'");
            $item = $query->fetch_object();

            // email and username exist   
            if ($item->email) {

                include ('includes/phpmailer/phpmailer.php');
                $mail = new PHPMailer;
                $mail->CharSet = 'utf-8';
                ini_set('default_charset', 'UTF-8');
                $mail->setFrom(EMAIL, SITE);
                $mail->addAddress($item->email);
                //$mail->addBCC('kontakt@internet-agentur-bodensee.com');

                $activation = sha1(time() . 'addSaltNOsalsa');
                include ('includes/phpmailer/mails/reset1.php'); // contains $msgBody

                $mail->msgHTML($msgBody);
                $sent = $mail->send();

                if ($sent) {
                    // add activation code in user db
                    $item->activation = $activation;
                    $result = $db->updateObject('iab_users', $item, 'id');
                } else {
                    die('db update did not work out');
                }

                $_SESSION['msgType'] = 'success';
                $_SESSION['msg'] = "Es wurde eine E-Mail zum Zurücksetzen des Passwortes an " . $item->email . " versendet.";
                return true;
            } else {
                $_SESSION['msgType'] = 'alert';
                $_SESSION['msg'] = "Diese E-Mail ist uns leider nicht bekannt.";
                return false;
            }
        } else {
            $_SESSION['msgType'] = 'alert';
            $_SESSION['msg'] = "Sie haben kein gültiges E-Mail Format eingegeben.";
            return false;
        }
    }

    // change password
    public static function resetPass3() {
        $token = helper::getParameter('token', 'str');

        $db = IabDB::getInstance();
        $query = $db->query("SELECT * FROM iab_users WHERE activation = '" . $token . "'");
        $obj = $query->fetch_object();

        if ($obj->id > 0) {
            $obj->activation = '';
            $obj->password = password_hash($_POST['pass1'], PASSWORD_DEFAULT); // brave new PHP 5.4!
            $result = $db->updateObject('iab_users', $obj, 'id');

            $_SESSION['msgType'] = 'success';
            $_SESSION['msg'] = "Das Passwort Ihres Users wurde geändert. Bitte loggen Sie sich jetzt mit dem *neuen* Passwort ein.";
            return true;
        } else {
            $_SESSION['msgType'] = 'alert';
            $_SESSION['msg'] = "Der Token ist nicht mehr gültig. Bitte setzen Sie Ihr Passwort erneut zurück.";
            return true;
        }
    }

    // not yet used or adapted
    public static function sendActivation() {
        include ('includes/phpmailer/phpmailer.php');
        $mail = new PHPMailer;
        $mail->CharSet = 'utf-8';
        ini_set('default_charset', 'UTF-8');
        $mail->setFrom(EMAIL, SITE);
        $mail->addAddress($item->email);
        //$mail->addBCC('kontakt@internet-agentur-bodensee.com');

        include ('includes/phpmailer/mails/activation.php'); // contains $msgBody

        $mail->msgHTML($msgBody);
        $mail->send();
    }

    // deprecated
    public static function resetPass() {
        $username = helper::getParameter('usr', 'str');
        $email = helper::getParameter('email', 'str');
        $pass = helper::getParameter('pass', 'str');


        // check if userdata is correct
        $db = IabDB::getInstance();
        $query = $db->query("SELECT * FROM iab_users WHERE email = '" . $email . "'");
        $item = $query->fetch_object();

        // email and username exist   
        if ($item->username == $username) {
            // change password entry
            $obj = new stdClass();
            $obj->id = $item->id;
            if (strlen($pass) >= 6) {
                $obj->password = password_hash($pass, PASSWORD_DEFAULT); // brave new PHP 5.4!
            } else {
                $_SESSION['msgType'] = 'alert';
                $_SESSION['msg'] = "Das Passwort muss mindestens 6 Zeichen lang sein.";
                return false;
            }

            $result = $db->updateObject('iab_users', $obj, 'id');

            if ($result) {
                // send mail
                include ('includes/phpmailer/phpmailer.php');
                $mail = new PHPMailer;
                $mail->CharSet = 'utf-8';
                ini_set('default_charset', 'UTF-8');
                $mail->setFrom(EMAIL, SITE);
                $mail->addAddress($item->email);
                //$mail->addBCC('kontakt@internet-agentur-bodensee.com');

                include ('includes/phpmailer/mails/reset.php'); // contains $msgBody

                $mail->msgHTML($msgBody);
                $mail->send();


                $_SESSION['msgType'] = 'success';
                $_SESSION['msg'] = "Das Passwort Ihres Users wurde geändert.";
                return true;
            } else {
                $_SESSION['msgType'] = 'alert';
                $_SESSION['msg'] = "Das Passwort konnte auf diesem Wege nicht geändert werden. Bitte informieren Sie den Administrator: " . EMAIL_ADMIN;
                return false;
            }
        } else {
            $_SESSION['msgType'] = 'alert';
            $_SESSION['msg'] = "Der angegebene Username bzw. das Passwort existieren nicht. Sollten Sie auf diesem Wege Ihr Passwort nicht zurücksetzen können, wenden Sie sich bitte an: " . EMAIL_ADMIN;
            return false;
        }
    }

}
