<?php

ob_start();

//if ($frontpage) {
//    require "includes/pages/start.php";
//} else {
    require "components/" . $this->com . "/views/" . $this->view . ".php";
//}

$html = ob_get_contents();
ob_end_clean();

 $html = str_replace('../images', '/images', $html); // make images in content root relative

$_SESSION['html'] = $html;
