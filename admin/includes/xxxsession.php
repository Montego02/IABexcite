<?php
session_start();

if ($_SESSION['time']) {
    $user = $_SESSION['user'];

    $sessionAge = time() - $_SESSION['time']; // age in seconds
// check if session is fresh enough or reset if not
    if ($sessionAge > (SESSIONAGEMAX * 360)) {
        session_unset();
        $_SESSION['msg'] = "Ihre Sitzung ist abgelaufen. Bitte melden Sie sich erneut an.";
    } else {
        $_SESSION['time'] = time(); // refresh time on interaction
    }
}
