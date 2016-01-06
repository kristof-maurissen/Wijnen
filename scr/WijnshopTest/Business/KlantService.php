<?php
//scr/WijnshopTest/Business/KlantService.php

namespace WijnshopTest\Business;
use WijnshopTest\Data\KlantDAO;


class KlantService {
    
    public function getKlantOverzicht() {
        $klantDAO = new KlantDAO(); 
        $lijst = $klantDAO->getAll(); 
        return $lijst; 
    }

    public function newKlant($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email) {       
       $wachtwoord = sha1($email . $wachtwoord);
      // $email = $this->checkEmail($email);
        $klantDAO = new KlantDAO();
        $klant = $klantDAO->createKlant($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email);
           /* if (isset($klant)){
                return true;
            }else{
                return false;
            } */
    }
    
    public function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === true){
        $klantEmail = Klant::getEmail();
        if ($klantEmail !== $email){
            $email = true;
        }else{
            return false;
        }
        }
    }
    
    public function controlKlant($email, $wachtwoord) {
        $klantDao = new KlantDAO();
        $klant = $klantDao->getKlantByEmail($email);
        if (isset($klant) && $klant->getWachtwoord() == $wachtwoord){
        return true;
        }else{
        return false;
        } 
    }
    
}

