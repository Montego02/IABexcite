<?php

ob_start();

require "components/" . $this->comp . "/views/" . $this->view . ".php";


$content = ob_get_contents();
ob_end_clean();

echo $content;

//$_SESSION['html'] = $content;
