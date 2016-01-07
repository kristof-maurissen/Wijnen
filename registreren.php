<?php
//use \Exceptions\;
//use \Business\Service;
use WijnshopTest\Business\KlantService;
//use WijnshopTest\Data\KlantDAO;
require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");

//$klantDAO = new KlantDAO();
//$klanten = $klantDAO->getAll();
//print_r ($klanten);

session_start();
$error = "";
if (isset($_GET["action"]) && $_GET["action"] == "registreer") {
    
    $klantService = new KlantService();
    $wachtwoord = $klantService->checkWachtwoord($_POST["wachtwoord"]);
    $leeginput = $klantService->checkLeegInput($_POST["naam"], $_POST["voornaam"], $_POST["straat"], $_POST["nr"], $_POST["postcode"], $_POST["gemeente"], $_POST["wachtwoord"], $_POST["email"]);
    $checkemail = $klantService->checkEmail($_POST["email"]);
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
        $klant = $klantService->newKlant($_POST["naam"], $_POST["voornaam"], $_POST["straat"], $_POST["nr"], $_POST["postcode"], $_POST["gemeente"], $_POST["wachtwoord"], $_POST["email"]);
        
        print ("ok");
        header ("location: login.php"); 
        exit(0);    
}

}else if (isset($_GET["error"])) {
    $error = $_GET["error"];
    print_r($error);
}


 /*if (empty($_GET["textemail"])) {
     $emailErr = "Email is required";
   } else {
     $email = $_GET["textemail"];
     print($email);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format";
     }
   }*/



$view = $twig->render("Registreren.twig", array("error" => $error));
    print($view);

