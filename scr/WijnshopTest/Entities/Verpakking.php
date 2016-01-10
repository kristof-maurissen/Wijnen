<?php
//scr/WijnshopTest/Entities/Verpakking.php
namespace WijnshopTest\Entities;

class Verpakking{
    
    private static $idMap = array();
    
    private $idwijn;
    private $naam;
    private $jaartal;
    private $land;
    private $cat;
    private $image;
    private $artcode;
    private $prijs;
    
    
    
    
    private function __construct($idwijn, $naam, $jaartal, $land, $cat, $image, $artcode, $prijs) {
        $this->idwijn = $idwijn;
        $this->naam =$naam;
        $this->jaartal = $jaartal;
        $this->land = $land;
        $this->cat = $cat;
        $this->image = $image;
        $this->artcode = $artcode;
        $this->prijs = $prijs;
         

    }
    
    public static function create($idwijn, $naam, $jaartal, $land, $cat, $image, $artcode, $prijs) {
        if (!isset(self::$idMap[$idwijn])) {
            self::$idMap[$idwijn] = new Wijnen($idwijn, $naam, $jaartal, $land, $cat, $image, $artcode, $prijs);
        }
        return self::$idMap[$idwijn];
    }
    
    public function getIdWijn(){
        return $this->idwijn;
    }
    public function getNaam() {
        return $this->naam;  
    }
    public function getJaartal() {
        return $this->jaartal;  
    }
    public function getLand() {
        return $this->land;  
    }
    public function getCat() {
        return $this->cat;  
    }
    public function getImage() {
        return $this->image;  
    }
    public function getArtCode() {
        return $this->artcode;  
    }
    public function getPrijs(){
        return $this->prijs;
    }
    
    
    
    public function setNaam($naam) {
        $this->naam = $naam;
    }
    public function setJaartal($jaartal) {
        $this->jaartal = $jaartal;
    }
    public function setLand($land) {
        $this->land = $land;
    }
    public function setCat($cat) {
        $this->cat = $cat;
    }
    public function setImage($image) {
        $this->image = $image;
    }
    public function setArtcode($artcode) {
        $this->artcode = $artcode;
    }
    public function setPrijs($prijs) {
        $this->prijs = $prijs;
    }           
}

