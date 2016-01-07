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
    
    public function checkWachtwoord($wachtwoord) {
        if (strlen($wachtwoord) > 6  && strlen($wachtwoord) < 32 && preg_match('/[a-z]/', $wachtwoord) && preg_match('/[A-Z]/', $wachtwoord)){   
            $passed_count = 0;
            if( preg_match('/[0-9]/', $wachtwoord) ) { $passed_count++; }  // contains digit
            //if( preg_match('/[^a-zA-Z0-9]/', $wachtwoord) ) { $passed_count++; }  // contains symbol
            if( $passed_count >= 1 ) {
                return true;
            }else{
                return false;
            }          
        }
        
        /*$uc = 0; $lc = 0; $num = 0; $other = 0;
        for ($i = 0, $j = strlen($wachtwoord); $i < $j; $i++) {
            $c = substr($wachtwoord,$i,1);
            if (preg_match('/[A-Z]/',$c)) {
                $uc++;
            } elseif (preg_match('/[a-z]/',$c)) {
                $lc++;
            } elseif (preg_match('/[0-9]/',$c)) {
                $num++;
            } else {
                $other++;
            }
        }( ($uc >=1) && ($lc >=1)&& ($num >=1) && )*/
        if (strlen($wachtwoord) < 6 || strlen($wachtwoord) > 32)  {
            return true;
        }else{
            return false;
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
        if ($klantEmail !== $email){
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

