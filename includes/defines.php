<?php

define('EMAIL', "kontakt@app-entwickler-verzeichnis.de");
define('EMAIL_ADMIN', "kontakt@app-entwickler-verzeichnis.de");
define('URL', "http://wisco.internet-agentur-bodensee.com/");
define('SITE', "WISCO Lasertechnik");
define('TITLE', "WISCO Lasertechnik - High Performance Laser Systems");
define('DESC', 'WISCO');
define('KEYWORDS', 'WISCO');

if ($_GET['mode'] == 'test') {
    define('SESSIONAGEMAX', 1); // max session age in MINUTES   
} else {
    define('SESSIONAGEMAX', 60); // max session age in MINUTES
}







