<?php
session_start();
use WijnshopTest\Business\WijnService;


require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");



    if(!isset($_SESSION["winkelmandje"])) {
        $_SESSION["winkelmandje"] = array();
        $_SESSION["totaalFles"] = 0;
    }
    
 
$wijnService = new WijnService();
$wijnen = "";
$prijsfles = 0;
 //&& $_GET["action"] == "keuze") 
   if (isset($_GET["action"])) {
       $wijnen = $wijnService->getSelectWijn($_GET["id"]);
  
    if(isset($_POST["submit"])) {
        
        $wijnen = $wijnService->getIdOfWijn($_GET["id"]);
        $_SESSION["winkelmandje"] = $wijnen;
        $prijsfles = $_GET["name"];
        $aantalfles = $_POST["aantal"];
        $wijn = $wijnen;
       
        if ($aantalfles <=0) {
            print ("geen negatief");
            print(" of geen invoer");
          
        }else{
            $prijswijn = ($aantalfles*$prijsfles);
            $_SESSION["totaalFles"] += $prijswijn;
            $_SESSION["winkelmandje"] = $wijnService->insertwinkelmandje($wijn, $aantalfles, $_SESSION["winkelmandje"]);
            print_r($_SESSION["winkelmandje"]);
            //header("location:");
            exit(0);
        
        }
    }
    }
    


$view = $twig->render("Selected.twig", array("wijnen" => $wijnen, "winkelmandje" => $_SESSION["winkelmandje"], "totaalprijs" => $_SESSION["totaalFles"]));
print($view);