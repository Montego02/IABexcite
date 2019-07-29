<?php

function myErrorHandler($errno, $errstr, $errfile, $errline) {
    $err = new stdClass();
    $err->no = $errno; // schweregrad
    $err->file = $errfile;
    $err->str = $errstr;
    $err->line = $errline;


    if ($err->no <= 1) { // nur errors behandeln 
        print_r($err);
    } else {
        //echo "unwesentliche Fehler aufgetreten";
        return false; // standardmäßige fehlerbehandlung von php fortsetzen
    }
}

function myFatalErrorShutdownHandler() {
    $last_error = error_get_last();
    if ($last_error['type'] === E_ERROR) {
        myErrorHandler(E_ERROR, $last_error['message'], $last_error['file'], $last_error['line']);
    }
}

set_error_handler('myErrorHandler');
register_shutdown_function('myFatalErrorShutdownHandler');


