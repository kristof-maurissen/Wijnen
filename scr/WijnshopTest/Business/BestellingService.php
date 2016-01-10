<?php
//scr/WijnshopTest/Business/BestellingService.php

namespace WijnshopTest\Business;

use WijnshopTest\Data\BestellingDAO;

class BestellingService{
    
    public function setBestelling($idklant, $besteldata, $prijstotaal){
        $bestelDAO = new BestellingDAO();
        $bestelling = $bestelDAO->create($idklant, $besteldata, $prijstotaal);
        return $bestelling;
    }
    
    public function getBestelling($idklant){
        $bestelDAO = new BestellingDAO();
        $bestelling = $bestelDAO->getByKlantId($idklant);
        return $bestelling;
    }
    
}

