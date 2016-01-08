<?php
//scr/WijnshopTest/Data/BestellingDAO.php

namespace WijnshopTest\Data;

use WijnshopTest\Data\DBConfig;
use WijnshopTest\Entities\Bestelling;
//use WijnshopTest\Exceptions;
use PDO;

class BestellingDAO {
    
    public function getAll() {
        $sql = "select * from bestelling"; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array(); 
        
        foreach ($resultSet as $rij) {
            $bestelling = Bestelling::create($rij["idbestel"], $rij["idklant"], $rij["besteldata"], $rij["prijstotaal"]); 
            array_push($lijst, $bestelling);  
        } 
            $dbh = null; 
            return $lijst;       
    }
    
    public function createBestel($idbestel, $idklant, $besteldata, $prijstotaal) {
        $sql = "insert into bestelling (idbestel, idklant, besteldata, prijstotaal) values(:idbestel, :idklant, :besteldata, :prijstotaal)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":idbestel" => $idbestel, ":idklant" => $idklant, ":besteldata" => $besteldata, ":prijstotaal" => $prijstotaal));
        $dbh = null;
    }
    
    
    
    public function deleteBestelling($idbestel) { 
        $sql = "delete from bestelling where idbestel = :idbestel" ; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD); 
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':idbestel' => $idbestel)); 
        $dbh = null; 
        
    }
}
