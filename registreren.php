<?php

use WijnshopTest\Exceptions\KlantBestaatAlException;
use WijnshopTest\Business\KlantService;
require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");

session_start();

if (isset($_GET["action"]) && $_GET["action"] == "registreer") {
    
    /*
     * Reeds ingegeven input bewaren
     */
    if (empty($_SESSION["naam"])){
        $_SESSION["naam"] = $_POST["naam"];
    }
    if (empty($_SESSION["voornaam"])) {
        $_SESSION["voornaam"] = $_POST["voornaam"];
    }
    if (empty($_SESSION["straat"])) {
        $_SESSION["straat"] = $_POST["straat"];
    }
    if (empty($_SESSION["nr"])) {
        $_SESSION["nr"] = $_POST["nr"];
    }
    if (empty($_SESSION["postcode"])) {
        $_SESSION["postcode"] = $_POST["postcode"];
    }
    if (empty($_SESSION["gemeente"])) {
        $_SESSION["gemeente"] = $_POST["gemeente"];
    }
    if (empty($_SESSION["wachtwoord"])) {
        $_SESSION["wachtwoord"] = $_POST["wachtwoord"];
    }
    if (empty($_SESSION["email"])) {
        $_SESSION["email"] = $_POST["email"];
    }

    /*
     * Control op leeginput
     * Control op wachtwoord
     */
    $klantService = new KlantService();
    $checkLeegInput = $klantService->controlLeegInput($_SESSION["naam"], $_SESSION["voornaam"], $_SESSION["straat"], $_SESSION["nr"], $_SESSION["postcode"], $_SESSION["gemeente"], $_SESSION["wachtwoord"], $_SESSION["email"]);
    $checkWachtwoord = $klantService->controlWachtwoord($_POST["wachtwoord"]);
    //print_r($checkWachtwoord);
    if (!$checkLeegInput) {
        if (!$checkWachtwoord) {
            header("location:registreren.php?error=wachtwoord");
        exit(0);
        }else{
            try {
                $klantService->newKlant($_POST["naam"], $_POST["voornaam"], $_POST["straat"], $_POST["nr"], $_POST["postcode"], $_POST["gemeente"], $_POST["wachtwoord"], $_POST["email"]);
                //$klantService->newKlant($_SESSION["naam"], $_SESSION["voornaam"], $_SESSION["straat"], $_SESSION["nr"], $_SESSION["postcode"],$_SESSION["gemeente"], $_SESSION["wachtwoord"], $_SESSION["email"]);
                setcookie("email", $_SESSION["email"], time() + (86400 * 30), "/");
                $_SESSION["reg"] = true;
                header("location:index.php");
                exit(0);
            } catch (KlantBestaatAlException $ex) {
                header("location:registreren.php?error=klantBestaatAl");
                exit(0);
            }
            header("location:afrekenen.php?action=afrekenen");
            exit(0);
        }    
        }else{
            header("location:registreren.php?error=leegVeld");
            exit(0);     
    }    
    }elseif (isset($_GET["error"])) {
        $error = $_GET["error"];
    } else {
        $_SESSION["naam"] = "";
        $_SESSION["voornaam"] = "";
        $_SESSION["straat"] = "";
        $_SESSION["nr"] = "";
        $_SESSION["postcode"] = "";
        $_SESSION["gemeente"] = "";
        $_SESSION["wachtwoord"] = "";
        $_SESSION["email"] = "";

    $error = null;
    }
    
   /* $klant = $klantService->newKlant($_POST["naam"], $_POST["voornaam"], $_POST["straat"], $_POST["nr"], $_POST["postcode"], $_POST["gemeente"], $_POST["wachtwoord"], $_POST["email"]);
    exit(0);
    if (!$klant) {
        header ("location: registreren.php");
        
     
    }else{
        print ("ok");
        header ("location: login.php");     
     
     
    
}*/
 
$view = $twig->render("Registreren.twig", array("naam" => $_SESSION["naam"], "voornaam" => $_SESSION["voornaam"],"straat" => $_SESSION["straat"], "nr" => $_SESSION["nr"], "postcode" => $_SESSION["postcode"],"gemeente" => $_SESSION["gemeente"], "wachtwoord" => $_SESSION["wachtwoord"], "email" => $_SESSION["email"], "error" => $error));
print($view);

