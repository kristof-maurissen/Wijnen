<?php
//use \Exceptions\;

use WijnshopTest\Business\KlantService;

require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");

session_start();
$naam = $_POST["naam"];
$voornaam = $_POST["voornaam"];
$straat = $_POST["straat"];
$nr = $_POST["nr"];
$postcode = $_POST["postcode"];
$gemeente = $_POST["gemeente"];
$wachtwoord = $_POST["wachtwoord"];
$email = $_POST["email"];
$error = "";
if (isset($_GET["action"]) && $_GET["action"] == "registreer") {
    
    $klantService = new KlantService();
    $wachtwoord = $klantService->checkWachtwoord($wachtwoord);
    $leeginput = $klantService->checkLeegInput($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email);
    $checkemail = $klantService->checkEmail($email);
    if (!$wachtwoord){
        header ("location: registreren.php?error=wachtwoord");
        exit(0);
    }
    if (!$leeginput) {
        header ("location: registreren.php?error=leegInput");
        exit(0);
    }
     if ($checkemail) {
        header ("location: registreren.php?error=foutEmail");
        exit(0);   
    }else{
        $klant = $klantService->newKlant($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email);
        
        print ("ok");
        header ("location: login.php"); 
        exit(0);    
}

}else if (isset($_GET["error"])) {
        $error = $_GET["error"];
        print_r($error);
}

$view = $twig->render("Registreren.twig", array("error" => $error));
    print($view);

