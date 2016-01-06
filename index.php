<?php

use WijnshopTest\Business\WijnService;

require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");

session_start();

$wijnService = new WijnService();
$wijnen = $wijnService->getWijnOverzicht();
exit(0);


$view = $twig->render("Index.twig", array("wijnen" => $wijnen));
print($view);


