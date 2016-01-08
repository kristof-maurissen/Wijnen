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
        $wachtwHashed = sha1($email . $wachtwoord);
        $klantDAO = new KlantDAO();
        $klant = $klantDAO->createKlant($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwHashed, $email);
           if (isset($klant)){
                return true;
            }else{
                return false;
            }
    }
    
    public function checkWachtwoord($wachtwoord) {
        if (strlen($wachtwoord) > 6  && strlen($wachtwoord) < 32 && preg_match('/[a-z]/', $wachtwoord) && preg_match('/[A-Z]/', $wachtwoord)){   
            $passed_count = 0;
            if( preg_match('/[0-9]/', $wachtwoord) ) { $passed_count++; }  // Bevat digit
            //if( preg_match('/[^a-zA-Z0-9]/', $wachtwoord) ) { $passed_count++; }  // Bevat symbol
            if( $passed_count >= 1 ) {
                return true;
            }else{
                return false;
            }          
        }
    }

    public function checkLeegInput($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email) {
        if (empty($naam) || empty($voornaam) || empty($straat) || empty($nr) || empty($postcode) || empty($gemeente)|| empty($wachtwoord) || empty($email)) {
            return false;
        }else{
            return true;
        }
    }
    
    public function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === true){
        $klantEmail = Klant::getEmail();
        if ($klantEmail != $email){
            $email = false;
        }else{
            return true;
        }
        }
    }
    
    public function controlKlant($email, $wachtwoord) {
        $klantDao = new KlantDAO();
        $klant = $klantDao->getKlantByEmail($email);
        if (isset($klant) && $klant->getWachtwoord() == sha1($email . $wachtwoord)){
        return true;
        }else{
        return false;
        } 
    }
    
}

