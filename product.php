<?php

use WijnshopTest\Business\WijnService;
//use WijnshopTest\Data\WijnDAO;
require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");

session_start();
//$winDao = new WijnDAO();
$wijnService = new WijnService();
$wijnen = $wijnService->getWijnOverzicht();
//$overzicht = $wijnService->getIdOfWijn('13');
$wijn = $wijnService->getOverzichtByCat('rood');

//print($wijn);
/*print_r($overzicht);
print("<br /><hr>");
foreach ($wijnen as $wijn){*/
    
    
 /*  
}
 

print("<br /><hr>");
//$wijn = $wijnenService->getIdOfWijn($_GET["id"]);
//$cat = $wijnenService->getOverzichtByCat($_GET["rood"]);

if (isset($_GET["action"]) && $_GET["action"] == "select") {
    $select = $_GET["cat"];
   // $wijn = $wijnService->getOverzichtByCat($select);
    //print_r($wijn);
    //$keuze = $_GET["cat"];
}*/

$view = $twig->render("Product.twig", array("wijnen" => $wijnen, "wijn" => $wijn));
print($view);


//"cat" => $cat, "wijn" => $wijn "wijn" => $wijn, 

