<?php
//scr/WijnshopTest/Entities/Bestelling.php

namespace WijnshopTest\Entities;

class Bestelling{
    
    private static $idMap = array();
    
    private $idbestel;
    private $idklant;
    private $besteldata;
    private $prijstotaal;

    private function __construct($idbestel, $idklant, $besteldata, $prijstotaal) {
        $this->idbestel = $idbestel;
        $this->idklant =$idklant;
        $this->besteldata = $besteldata;
        $this->prijstotaal = $prijstotaal;
    }
    
    public static function create($idbestel, $idklant, $besteldata, $prijstotaal) {
        if (!isset(self::$idMap[$idbestel])) {
            self::$idMap[$idbestel] = new Bestelling($idbestel, $idklant, $besteldata, $prijstotaal);
        }
        return self::$idMap[$idbestel];
    }
    
    public function getIdBestel(){
        return $this->idbestel;
    }
    public function getIdKlant() {
        return $this->idklant;  
    }
    public function getBestelData() {
        return $this->besteldata;  
    }
    public function getPrijsTotaal() {
        return $this->prijstotaal;  
    }

    public function setIdBestel($idbestel) {
        $this->idbestel = $idbestel;  
    }
    public function setIdKlant($idklant) {
         $this->idklant = $idklant;  
    }
    public function setBestelData($besteldata) {
         $this->besteldata = $besteldata;  
    }
    public function setPrijsTotaal($prijstotaal) {
         $this->prijstotaal = $prijstotaal;  
    }         
}

