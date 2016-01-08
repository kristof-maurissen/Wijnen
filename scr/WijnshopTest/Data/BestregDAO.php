<?php
//scr/WijnshopTest/Data/BestregDAO.php

namespace WijnshopTest\Data;

use WijnshopTest\Data\DBConfig;
use WijnshopTest\Entities\Bestreg;
//use WijnshopTest\Exceptions;
use PDO;

class BestregDAO {
    
    public function getAll() {
        $sql = "select * from bestreg"; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array(); 
        
        foreach ($resultSet as $rij) {
            $bestreg = Bestreg::create($rij["idbestreg"], $rij["idwijn"], $rij["idverpak"], $rij["aantal"], $rij["levkost"], $rij["extra"]); 
            array_push($lijst, $bestreg);  
        } 
            $dbh = null; 
            return $lijst;       
    }
    
    public function createBestreg($idwijn, $idverpak, $aantal, $levkost, $extra) {
        $sql = "insert into bestelreg (idwijn, idverpak, aantal, levkost, extra) values(:idwijn, :idverpak, :aantal, :levkost, :extra)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":idwijn" => $idwijn, ":idverpak" => $idverpak, ":aantal" => $aantal, ":levkost" => $levkost, ":extra" => $extra));
        $dbh = null;
    }
    
    
    
    public function deleteBestreg($idbestreg) { 
        $sql = "delete from bestelreg where idbestreg = :idbestreg" ; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD); 
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':idbestreg' => $idbestreg)); 
        $dbh = null; 
        
    }
}

/*public function getWijnByCat($cat) {
        $sql = "select * from wijnen where cat = :cat";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':artcode' => $artcode)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
         
        $wijnen = Wijnen::create($rij["idwijn"], $rij["naam"], $rij["jaartal"], $rij["land"], $rij["cat"], $rij["image"], $rij["artcode"],$rij["prijs"]);
        
        $dbh = null; 
        return $wijnen; 
    }
    
    public function getWijnByArtcode($artcode) {
        $sql = "select * from wijnen where artcode = :artcode";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':artcode' => $artcode)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
         
        $wijnen = Wijnen::create($rij["idwijn"], $rij["naam"], $rij["jaartal"], $rij["land"], $rij["cat"], $rij["image"], $rij["artcode"],$rij["prijs"]);
        
        $dbh = null; 
        return $wijnen; 
    }

    public function getWijnByID($idwijn) {
        $sql = "select * from wijnen where idwijn = :idwijn";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':idwijn' => $idwijn)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
         
        $wijnen = Wijnen::create($rij["idwijn"], $rij["naam"], $rij["jaartal"], $rij["land"], $rij["cat"], $rij["image"], $rij["artcode"],$rij["prijs"]);
        
        $dbh = null; 
        return $wijnen; 
    }*/