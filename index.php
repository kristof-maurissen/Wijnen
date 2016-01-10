<?php
session_start();
use WijnshopTest\Business\WijnService;

require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");



$wijnService = new WijnService();
$wijnen = $wijnService->getWijnOverzicht();
if (isset($_GET["action"]) && $_GET["action"] == "select") {
   
    $keuze = $_GET["keuze"];
    header("location: product.php?action=select&keuze=$keuze"); 
    exit(0);
    }

$view = $twig->render("Home.twig", array("wijnen" => $wijnen));
print($view);


