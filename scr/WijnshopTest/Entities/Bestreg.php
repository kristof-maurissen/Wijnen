<?php
//scr/WijnshopTest/Entities/Bestreg.php

namespace WijnshopTest\Entities;

class Bestreg{
    
    private static $idMap = array();
    
    private $idbestreg;
    private $idwijn;
    private $idverpak;
    private $aantal;
    private $levkost;
    private $extra;
    

    private function __construct($idbestreg, $idwijn, $idverpak, $aantal, $levkost, $extra) {
        $this->idbestreg = $idbestreg;
        $this->idwijn =$idwijn;
        $this->idverpak = $idverpak;
        $this->aantal = $aantal;
        $this->levkost = $levkost;
        $this->extra = $extra; 
    }
    
    public static function create($idbestreg, $idwijn, $idverpak, $aantal, $levkost, $extra) {
        if (!isset(self::$idMap[$idbestreg])) {
            self::$idMap[$idbestreg] = new Bestreg($idbestreg, $idwijn, $idverpak, $aantal, $levkost, $extra);
        }
        return self::$idMap[$idbestreg];
    }
    
    public function getIdBestreg(){
        return $this->idbestreg;
    }
    public function getIdWijn() {
        return $this->idwijn;  
    }
    public function getIdVerpak() {
        return $this->idverpak;  
    }
    public function getAantal() {
        return $this->aantal;  
    }
    public function getLevKost() {
        return $this->levkost;  
    }
    public function getExtra() {
        return $this->extra;  
    }
   
     
    public function setIdWijn($idwijn) {
        $this->idwijn = $idwijn;  
    }
    public function setIdVerpak($idverpak) {
         $this->idverpak = $idverpak;  
    }
    public function setAantal($aantal) {
         $this->aantal = $aantal;  
    }
    public function setLevKost($levkost) {
         $this->levkost = $levkost;  
    }
    public function setExtra($extra) {
         $this->extra = $extra;  
    }         
}

