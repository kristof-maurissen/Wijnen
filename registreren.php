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

if (isset($_GET["action"]) && $_GET["action"] == "registreer") {
    
    $klantService = new KlantService();
    $klant = $klantService->newKlant($_POST["naam"], $_POST["voornaam"], $_POST["straat"], $_POST["nr"], $_POST["postcode"], $_POST["gemeente"], $_POST["wachtwoord"], $_POST["email"]);
    exit(0);
    if (!$klant) {
        header ("location: registreren.php");
        
     
    }else{
        print ("ok");
        header ("location: login.php");     
     
     
}
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



$view = $twig->render("Registreren.twig", array());
    print($view);

