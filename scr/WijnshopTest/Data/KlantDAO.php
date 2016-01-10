<?php
//scr/WijnshopTest/Data/KlantDAO.php

namespace WijnshopTest\Data;

use WijnshopTest\Data\DBConfig;
use WijnshopTest\Entities\Klant;

use PDO;

class KlantDAO {
    
    public function getAll() {
        $sql = "select * from klant"; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array(); 
        
        foreach ($resultSet as $rij) {
            $klanten = Klant::create($rij["idklant"], $rij["naam"], $rij["voornaam"], $rij["straat"], $rij["nr"], $rij["postcode"], $rij["gemeente"],$rij["wachtwoord"], $rij["email"]); 
            array_push($lijst, $klanten);  
        } 
            $dbh = null; 
            return $lijst;       
    }
    
    public function createKlant($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email) {
        $sql = "insert into klant (naam, voornaam, straat, nr, postcode, gemeente, wachtwoord,email) values(:naam, :voornaam, :straat, :nr, :postcode, :gemeente, :wachtwoord, :email)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":naam" => $naam, ":voornaam" => $voornaam, ":straat" => $straat, ":nr" => $nr, ":postcode" => $postcode, ":gemeente" => $gemeente, ":wachtwoord" => $wachtwoord, ":email" => $email));
        
        $dbh = null;
    }
    
    public function getKlantByEmail($email) {
        $sql = "select count(idklant) from klant where email = :email";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':email' => $email)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
         
        $klant = Klant::create($rij["idklant"], $rij["naam"], $rij["voornaam"], $rij["straat"], $rij["nr"], $rij["postcode"], $rij["gemeente"],$rij["wachtwoord"], $rij["email"]);
        
        $dbh = null; 
        return $klant; 
    }

    public function getById($idKlant) {
        $sql = "select * from klant where idklant = :idKlant";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':idKlant' => $idKlant)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
         
        $klant = Klant::create($rij["idklant"], $rij["naam"], $rij["voornaam"], $rij["straat"], $rij["nr"], $rij["postcode"], $rij["gemeente"], $rij["wachtwoord"], $rij["email"]);
        
        $dbh = null; 
        return $klant; 
    }
    
    public function deleteKlant($idKlant) { 
        $sql = "delete from klant where idklant = :idKlant" ; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD); 
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':idKlant' => $idKlant)); 
        $dbh = null; 
        
    }
}

