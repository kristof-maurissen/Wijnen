<?php
//scr/WijnshopTest/Business/KlantService.php

namespace WijnshopTest\Business;
use WijnshopTest\Data\KlantDAO;


class KlantService {
    
    public function getKlantOverzicht() {
        $klantDao = new KlantDAO(); 
        $lijst = $klantDao->getAll(); 
        return $lijst; 
    }
    
    public function getKlantByEmail($email){
        $klantDao = new KlantDAO();
        $klant = $klantDao->getKlantByEmail($email);
        return $klant;
    }
    
        public function getKlantId($email) { 
        $klantDao = new KlantDAO();    
        $klant = $klantDao->getByEmailId($email);
        return $klant->getId();
    }
    
        public function getKlantById($idklant){ 
        $klantDao = new KlantDAO();
        $klant = $klantDao->getById($idklant);
        return $klant;
    }

    public function newKlant($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email) {       
        $wachtwoordHashed = sha1($email . $wachtwoord);
        $klantDao = new KlantDAO();
        $klantDao->createKlant($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoordHashed, $email);  
    }
    
    public function checkWachtwoord($wachtwoord) {
        if ((strlen($wachtwoord) > 6) && (strlen($wachtwoord) < 32) && (preg_match('/[a-z]/', $wachtwoord))  && (preg_match('/[A-Z]/', $wachtwoord))) {
        $passed_count = 0;
        if( preg_match('/[0-9]/', $wachtwoord) ) { $passed_count++; } {  // Bevat digit
            //if (preg_match('/[^a-zA-Z0-9]/', $wachtwoord)) { $passed_count++; }  // Bevat symbol
         
            if($passed_count > 0 ) {
            return true;
        }else{
            return false;
        } 
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
    
    public function valEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === true){ 
            return false;
            }else{
                return true;
            }
    }
    
    public function checkEmail($email) {
        $klantDao = new KlantDAO();
        $klantEmail = $klantDao->getKlantByEmail($email);
        if (isset($klantEmail) && ($klantEmail->getEmail() == $email)){//($klantEmail == $email)
            return true;
        }else{
            return false; 
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
    
    public function controleerGeregistreerd($email) {
        $klantDao = new KlantDAO();
        $klant = $klantDao->getKlantByEmail($email);
        if (isset($klant)) {
            return true;
        } else {
            return false;
        }
    }
    
}

