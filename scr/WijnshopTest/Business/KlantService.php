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
        $wachtwoordHashed = sha1($email . $wachtwoord);
        $emailChecked = $this->checkEmail($email);
        $klantDAO = new KlantDAO();
        $klant = $klantDAO->createKlant($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoordHashed, $emailChecked);
            if (isset($klant)){
                return true;
            }else{
                return false;
            } 
    }
    //preg_match('^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$', 
    public function controlWachtwoord($wachtwoord){
       /* if (!empty($wachtwoord)) { //check if string is empty
                if (ctype_alnum($wachtwoord)) { //check if string is alphanumeric
                    if (7 < strlen($wachtwoord)){ //check if string meets 8 or more characters
                        if (strcspn($wachtwoord, '0123456789') != strlen($wachtwoord)){ //check if string has numbers
                            if (strcspn($wachtwoord, 'abcdefghijklmnopqrstuvwxyz') != strlen($wachtwoord)) { //check if string has small letters
                                if (strcspn($wachtwoord, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ') != strlen($wachtwoord)) { //check if string has capital letters
                                    return true;
                                }
                                else {
                                    return false;
                                }
                            }
                            else {
                                return false;
                            }
                        }
                        else {
                            return false;
                        }
                    }
                    else {
                        return false;
                    }
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }if (preg_match("/[A-Z][a-z]{5,32}\d\w+/" , $wachtwoord)){
            return true;
        }
       /* $uc = 0; $lc = 0; $num = 0; $other = 0;
        for ($i = 0, $j = strlen($wachtwoord); $i < $j; $i++) {
            $c = substr($wachtwoord,$i,1);
            if (preg_match('/[A-Z]/',$c)) {
                $uc++;
            } 
            if (preg_match('/[a-z]/',$c)) {[a-z]{6,32}\d^.*
                $lc++;
            } 
            if (preg_match('/[0-9]/',$c)) {
                $num++;/^[a-z0-9A-Z]*$/
            } else {strpbrk($wachtwoord, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ) !== FALSE
                $other++;'#.*^(?=.{6,32})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#'
            }( ) {'^.*(?=.{7,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$' }
       //&& (strlen($wachtwoord) < 6 || strlen($wachtwoord) > 32)&& && ($num >=1)(($uc >=1) && */
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
    }   
    
    public function controlLeegInput($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email){
        if(empty($naam) || empty($voornaam) || empty($straat) || empty($nr) || empty($postcode) || empty($gemeente) || empty($wachtwoord) || empty($email)){
            return false;
        }else{
            return true;
        }
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