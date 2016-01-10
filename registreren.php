<?php

//use \Exceptions\;

use WijnshopTest\Business\KlantService;

require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");

session_start();

$error = "";

if (isset($_GET["action"]) && $_GET["action"] == "registreer") {
    $naam = $_POST["naam"];
    $voornaam = $_POST["voornaam"];
    $straat = $_POST["straat"];
    $nr = $_POST["nr"];
    $postcode = $_POST["postcode"];
    $gemeente = $_POST["gemeente"];
    $wachtWoord = $_POST["wachtwoord"];
    $email = $_POST["email"];
    $klantService = new KlantService();
    $wachtwoord = $klantService->checkWachtwoord($wachtWoord);
    $leegInput = $klantService->checkLeegInput($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email);
    $checkEmail = $klantService->checkEmail($email);
    $emailValid = $klantService->valEmail($email);
    if (!$wachtwoord){
        header ("location: registreren.php?error=wachtwoord");
        exit(0);
    }
    if (!$leegInput) {
        header ("location: registreren.php?error=leegInput");
        exit(0);
    }
     if ($checkEmail) {//!
        header ("location: registreren.php?error=emailBestaat");
        exit(0);   
    }
    if ($emailvalid) {
        header ("location: registreren.php?error=noValidEmail");
        exit(0);
    }else{
        $klant = $klantService->newKlant($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email);
        
        print ("ok");
        header ("location: login.php"); 
        exit(0);    
}

}else if (isset($_GET["error"])) {
        $error = $_GET["error"];
        //print_r($error);
}

$view = $twig->render("Registreren.twig", array("error" => $error));
    print($view);


