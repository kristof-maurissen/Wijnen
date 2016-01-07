<?php

use WijnshopTest\Business\WijnService;

require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");

session_start();

$wijnService = new WijnService();
$wijnen = $wijnService->getWijnOverzicht();
if (isset($_GET["action"]) && $_GET["action"] == "select") {
    $wijn = $wijnen->getOverzichtByCat($_GET["cat"]);
    $keuze = $_GET["cat"];
    header("location: product.php?action=select&cat=$keuze"); 
exit(0);
}


/*if (isset($_GET["action"]) && $_GET["action"] == "zoek") {
    $wijn = $wijnen->getIdOfWijn($_GET["id"]);
    header("location: product.php"); 
exit(0);
}*/


$view = $twig->render("Index.twig", array("wijnen" => $wijnen));
print($view);


