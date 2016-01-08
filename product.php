<?php

use WijnshopTest\Business\WijnService;
use WijnshopTest\Data\WijnDAO;
require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");

session_start();

$winDao = new WijnDAO();
$wijnService = new WijnService();
$wijnen = "";
$titel = "";

    if (isset($_GET["action"]) && $_GET["action"] == "select") {
        if (isset($_GET["wijn"])) {
            $wijn = $_GET["wijn"];
            $wijnen = $wijnService->getOverzichtByCat($wijn);
            $titel = $wijn;
        }else{
            $titel = "";
        }   
        if (isset($_GET["land"])) {
            $land = $_GET["land"];
            $wijnen = $wijnService->getOverzichtByLand($land);
            $titel = $land;
        }
        else if (isset($_GET["jaar"])) {
            $jaartal = $_GET["jaar"];
            $wijnen = $wijnService->getOverzichtByJaar($jaartal);
            $titel = $jaartal;
        }
    }
    
    

$view = $twig->render("Product.twig", array("wijnen" => $wijnen, "titel" => $titel));
print($view);


  