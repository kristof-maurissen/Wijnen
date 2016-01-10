<?php
//use WijnshopTest\Exceptions\;
session_start();
use WijnshopTest\Business\KlantService;

require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");



if (isset($_GET["action"]) && $_GET["action"] == "aanmelden") {
        $klantservice = new KlantService;
        $toegelaten = $klantservice->controlKlant($_POST["txtEmail"], $_POST["txtWachtwoord"]);
        
        if (!$toegelaten) {
            $_SESSION["aangemeld"] = true;
            header ("location: index.php"); 
            exit(0);
        
        }else {
            header ("location: login.php?error=fouteInlog");
            exit(0);
            
        }
}else if (isset($_GET["error"])) {
        $error = $_GET["error"];
        //print_r($error);
} 




    $view = $twig->render("Login.twig", array());
    print($view);

//"error" => $error