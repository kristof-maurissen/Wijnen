<?php
//scr/WijnshopTest/Data/WijnDAO.php

namespace WijnshopTest\Data;

use WijnshopTest\Data\DBConfig;
use WijnshopTest\Entities\Wijnen;
//use WijnshopTest\Exceptions;
use PDO;

class WijnDAO {
    
    public function getAll() {
        $sql = "select * from wijnen"; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array(); 
        
        foreach ($resultSet as $rij) {
            $wijnen = Wijnen::create($rij["idwijn"], $rij["naam"], $rij["jaartal"], $rij["land"], $rij["cat"], $rij["image"], $rij["artcode"],$rij["prijs"]); 
            array_push($lijst, $wijnen);  
        } 
            $dbh = null; 
            return $lijst;       
    }
    
    public function createWijn($naam, $jaartal, $land, $cat, $image, $artcode, $prijs) {
        $sql = "insert into wijnen (naam, jaartal, land, cat, image, artcode, prijs) values(:naam, :jaartal, :land, :cat, :image, :artcode, :prijs)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":naam" => $naam, ":jaartal" => $jaartal, ":land" => $land, ":cat" => $cat, ":image" => $image, ":artcode" => $artcode, ":prijs" => $prijs));
        $dbh = null;
    }
    
    public function getWijnByCat($cat) {
        $sql = "select * from wijnen where cat = :cat";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':cat' => $cat)); 
        $resultSet = $stmt->fetchAll();
        $lijst = array();
        
        foreach ($resultSet as $rij) {
        $wijnen = Wijnen::create($rij["idwijn"], $rij["naam"], $rij["jaartal"], $rij["land"], $rij["cat"], $rij["image"], $rij["artcode"],$rij["prijs"]);
        array_push($lijst, $wijnen);
        }
        
        $dbh = null; 
        return $lijst; 
    }
    
    public function getWijnByLand($land) {
        $sql = "select * from wijnen where land = :land";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':land' => $land)); 
        $resultSet = $stmt->fetchAll();
        $lijst = array();
        
        foreach ($resultSet as $rij) {
        $wijnen = Wijnen::create($rij["idwijn"], $rij["naam"], $rij["jaartal"], $rij["land"], $rij["cat"], $rij["image"], $rij["artcode"],$rij["prijs"]);
        array_push($lijst, $wijnen);
        }
        
        $dbh = null; 
        return $lijst; 
    }
    
    public function getWijnByJaar($jaar) {
        $sql = "select * from wijnen where jaartal = :jaar";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':jaar' => $jaar)); 
        $resultSet = $stmt->fetchAll();
        $lijst = array();
        
        foreach ($resultSet as $rij) {
        $wijnen = Wijnen::create($rij["idwijn"], $rij["naam"], $rij["jaartal"], $rij["land"], $rij["cat"], $rij["image"], $rij["artcode"],$rij["prijs"]);
        array_push($lijst, $wijnen);
        }
        
        $dbh = null; 
        return $lijst; 
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
    }
    
    public function deleteWijn($idwijn) { 
        $sql = "delete from wijnen where idwijn = :idwijn" ; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD); 
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':idwijn' => $idwijn)); 
        $dbh = null; 
        
    }
}

