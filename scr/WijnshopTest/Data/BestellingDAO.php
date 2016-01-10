<?php
//scr/WijnshopTest/Data/BestellingDAO.php

namespace WijnshopTest\Data;

use WijnshopTest\Data\DBConfig;
use WijnshopTest\Entities\Bestelling;
use WijnshopTest\Entities\Klant;

use PDO;

class BestellingDAO {
    
    public function getKlantId($idklant) {
        $sql = "select * from bestelling, klant where bestelling.idklant = :idklant"; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':idklant' => $idklant)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
         
        $klant = Klant::create($rij["klant.idklant"], $rij["naam"], $rij["voornaam"], $rij["straat"], $rij["nr"], $rij["postcode"], $rij["gemeente"],$rij["email"]);
        $bestelling = Bestelling::create($rij["idbestel"], $klant, $rij["besteldata"], $rij["prijstotaal"]);
        $dbh = null; 
        return $bestelling; 
    }
    
    public function createBestel($idbestel, $idklant, $besteldata, $prijstotaal) {
        $sql = "insert into bestelling (idbestel, idklant, besteldata, prijstotaal) values(:idbestel, :idklant, :besteldata, :prijstotaal)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":idbestel" => $idbestel, ":idklant" => $idklant, ":besteldata" => $besteldata, ":prijstotaal" => $prijstotaal));
        $dbh = null;
    }
}
