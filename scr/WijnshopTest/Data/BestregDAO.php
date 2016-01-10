<?php
//scr/WijnshopTest/Data/BestregDAO.php

namespace WijnshopTest\Data;

use WijnshopTest\Data\DBConfig;
use WijnshopTest\Entities\Bestreg;
use WijnshopTest\Entities\Bestelling;
use WijnshopTest\Entities\Klant;
use WijnshopTest\Entities\Wijnen;
use WijnshopTest\Entities\Verpakking;
use PDO;

class BestregDAO {
    
    public function getBestelId($bestelid) {
        $sql = "select * from bestelreg, bestelling, wijnen, verpakking, klant where bestelreg.bestelid = :bestelid"; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':bestelid' => $bestelid)); 
        $resultSet = $stmt->fetchAll();
        $lijst = array();
        
        foreach ($resultSet as $rij) {
            $klant = Klant::create($rij["klant.idklant"], $rij["klant.naam"], $rij["voornaam"], $rij["straat"], $rij["nr"], $rij["postcode"], $rij["gemeente"],$rij["wachtwoord"], $rij["email"]);
            $bestelling = Bestelling::create($rij["bestelling.idbestel"], $klant, $rij["besteldata"], $rij["prijstotaal"]); 
            $wijnen = Wijnen::create($rij["wijnen.idwijn"], $rij["wijnen.naam"], $rij["jaartal"], $rij["land"], $rij["cat"], $rij["image"], $rij["artcode"],$rij["prijs"]); 
            $verpakking = Verpakking::create($rij["verpakking.idverpak"], $rij["verpakking.naam"], $rij["aantalinhoud"], $rij["materiaal"], $rij["prijs"]);
            $bestreg = Bestreg::create($rij["bestregid"], $bestelling, $wijnen, $verpakking, $rij["aantalwijn"], $rij["aantalverpak"], $rij["bestregprijs"], $rij["extra"]); 
            array_push($lijst, $bestreg);  
        } 
            $dbh = null; 
            return $lijst;       
    }
    
    public function createBestreg($bestelid, $idwijn, $idverpak, $aantalwijn, $aantalverpak, $bestregprijs, $extra) {
        $sql = "insert into bestelreg (bestelid,idwijn, idverpak, aantalwijn, aantalverpak, bestregprijs, extra) values(:bestelid :idwijn, :idverpak, :aantalwijn, :aantalverpak :bestregprijs, :extra)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":bestelid =>$bestelid, :idwijn" => $idwijn, ":idverpak" => $idverpak, ":aantalwijn" => $aantalwijn, ":aantalverpak" => $aantalverpak, ":bestregprijs" => $bestregprijs, ":extra" => $extra));
        $dbh = null;
    }
}

