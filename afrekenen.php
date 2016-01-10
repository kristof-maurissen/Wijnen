<?php

use Pizza\Business\PizzaService;
use Pizza\Business\KlantService;
use Pizza\Business\BestellingService;
use Pizza\Business\BestregService;
use Pizza\Business\PromoService;
use Doctrine\Common\ClassLoader;

require_once ("libraries/Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/Pizza/Presentation");
$twig = new Twig_Environment($loader);
$classLoader = new ClassLoader("Pizza", "src");
$classLoader->register();

session_start();

if (isset($_GET["action"])) {
    if ($_GET["action"] == "afrekenen") {
        
        /*
         * haal array op met namen van pizza's + aantal keer gekozen
         */
        $psvc = new PizzaService();
        $_SESSION["aantallenPizza"] = $psvc->getAantalZelfdePizza($_SESSION["winkelmandje"]);
        
        if (isset($_SESSION["aangemeld"]) && !isset($_SESSION["wijzigBestelling"]) && !isset($_SESSION["wijzigGegevens"])){
                        
           /*
            * check of klant recht heeft op promo
            */
            $ksvc = new KlantService();
            $klant = $ksvc->haalKlantOp($_SESSION["email"]);
            if($klant->getPromo() == 1){
                $promosvc = new PromoService();
                foreach($_SESSION["winkelmandje"] as $pizza){
                    $promo = $promosvc->haalPromo($pizza->getPizzaId());
                    if(isset($promo)){
                        $verschil = $pizza->getPrijs() - $promo->getPromoprijs();
                        $_SESSION["totaalprijs"] -= $verschil;
                        $_SESSION["promo"] = $promo;
                    }
                }
            }            
            header("location:afrekenenController.php");
            exit(0);
        }        
    }
    if ($_GET["action"] == "bestel") {
        $tijdstip = date("Y-m-d H:i:s");
        $totaalprijs = $_SESSION["totaalprijs"];
        $bsvc = new BestellingService();
        /*
         *  Voeg bestelling en bestregs toe
         */
        if ($_SESSION["aangemeld"] == true) { //voor geregistreerde klanten
            $ksvc = new KlantService();
            $klant = $ksvc->haalKlantOp($_SESSION["email"]);          
            $_SESSION["bestellingId"] = $bsvc->voegBestellingToe($klant->getKlantId(), $tijdstip, $totaalprijs, $_POST["koerierinfo"]);
            
        } else { //voor niet geregistreerde klanten
            $_SESSION["bestellingId"] = $bsvc->voegBestellingToe(null, $tijdstip, $totaalprijs, $_POST["koerierinfo"]);
        }
        
        /*
         * Voeg bestelregels toe, check voor prijs of de pizza overeenkomt met promo
         */
        $brsvc = new BestregService();
        foreach($_SESSION["winkelmandje"] as $regel){
            if(isset($_SESSION["promo"])){
                if($regel->getPizzaId() == $_SESSION["promo"]->getPizza()->getPizzaId()){
                    $brsvc->voegBestregToe($_SESSION["bestellingId"], $regel->getPizzaId(), 1, $_SESSION["promo"]->getPromoprijs());
                }else{
                    $brsvc->voegBestregToe($_SESSION["bestellingId"], $regel->getPizzaId(), 1, $regel->getPrijs());
                }                
            }else{
                $brsvc->voegBestregToe($_SESSION["bestellingId"], $regel->getPizzaId(), 1, $regel->getPrijs());
            }
            
        }
        
        /*
         * Verwijder alle session gegevens.
         */
        unset($_SESSION["aangemeld"]);
        unset($_SESSION["winkelmandje"]);
        unset($_SESSION["naam"]);
        unset($_SESSION["voornaam"]);
        unset($_SESSION["straat"]);
        unset($_SESSION["postcode"]);
        unset($_SESSION["gemeente"]);
        unset($_SESSION["telefoon"]);
        unset($_SESSION["email"]);
        unset($_SESSION["wijzig"]);
        unset($_SESSION["wijzigBestelling"]);
        unset($_SESSION["wijzigGegevens"]);
        unset($_SESSION["bestellingId"]);
        unset($_SESSION["promo"]);
        header("location:aanbodController.php");
        exit(0);
    }
    if($_GET["action"] == "annuleer"){
        unset($_SESSION["aangemeld"]);
        unset($_SESSION["winkelmandje"]);
        unset($_SESSION["naam"]);
        unset($_SESSION["voornaam"]);
        unset($_SESSION["straat"]);
        unset($_SESSION["postcode"]);
        unset($_SESSION["gemeente"]);
        unset($_SESSION["telefoon"]);
        unset($_SESSION["email"]);
        unset($_SESSION["wijzig"]);
        unset($_SESSION["wijzigBestelling"]);
        unset($_SESSION["wijzigGegevens"]);
        unset($_SESSION["bestellingId"]);
        unset($_SESSION["promo"]);
        header("location:aanbodController.php");
        exit(0);
    }
}

$view = $twig->render("afrekenen.twig", array("winkelmandje" => $_SESSION["winkelmandje"], "totaalprijs" => $_SESSION["totaalprijs"],
    "naam" => $_SESSION["naam"], "voornaam" => $_SESSION["voornaam"], "straat" => $_SESSION["straat"], "huisnummer" => $_SESSION["huisnummer"],
    "postcode" => $_SESSION["postcode"], "gemeente" => $_SESSION["gemeente"], "telefoon" => $_SESSION["telefoon"], "aantallenPizza" => $_SESSION["aantallenPizza"]));
print($view);

