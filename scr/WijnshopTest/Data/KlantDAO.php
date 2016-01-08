<?php
//scr/WijnshopTest/Data/DrankDAO.php
namespace WijnshopTest\Data;
use WijnshopTest\Data\DBConfig;
use WijnshopTest\Entities\Klant;
//use BroodjesProject\Exceptions;
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
        $sql = "insert into klant (naam, voornaam, straat, nr, postcode, gemeente, wachtwoord, email) values(:naam, :voornaam, :straat, :nr, :postcode, :gemeente, :wachtwoord, :email)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":naam" => $naam, ":voornaam" => $voornaam, ":straat" => $straat, ":nr" => $nr, ":postcode" => $postcode, ":gemeente" => $gemeente, ":wachtwoord" => $wachtwoord, ":email" => $email));
        $dbh = null;
    }
    
    public function getKlantByEmail($email) {
        $sql = "select * from klant where email = :email";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':email' => $email)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
         
        $klanten = Klant::create($rij["idklant"], $rij["naam"], $rij["voornaam"], $rij["straat"], $rij["nr"], $rij["postcode"], $rij["gemeente"],$rij["email"]);
        
        $dbh = null; 
        return $klanten; 
    }
    public function getKlantByID($idklant) {
        $sql = "select * from klant where idklant = :idklant";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':idklant' => $idklant)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
         
        $klanten = Users::create($rij["idklant"], $rij["naam"], $rij["voornaam"], $rij["straat"], $rij["nr"], $rij["postcode"], $rij["gemeente"],$rij["email"]);
        
        $dbh = null; 
        return $klanten; 
    }
    
    public function deleteKlant($idklant) { 
        $sql = "delete from klant where idklant = :idklant" ; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD); 
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':idklant' => $idklant)); 
        $dbh = null; 
        
    }
}

