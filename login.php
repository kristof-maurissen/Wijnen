<?php
//use WijnshopTest\Exceptions\;
use WijnshopTest\Business\KlantService;

require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");

session_start();

if (isset($_GET["action"]) && $_GET["action"] == "aanmelden") {
        $klantservice = new KlantService;
        $toegelaten = $klantservice->controlKlant($_POST["txtEmail"], $_POST["txtWachtwoord"]);
        
        if (!$toegelaten) {
            $_SESSION["aangemeld"] = true;
            header ("location: index.php"); 
            exit(0);
        
        }else {
            header ("location: login.php");
            exit(0);
            
        }
} 




    $view = $twig->render("Login.twig", array());
    print($view);

