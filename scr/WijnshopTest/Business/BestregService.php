<?php
//scr/WijnshopTest/Business/BestregService.php

namespace WijnshopTest\Business;

use WijnshopTest\Data\BestregDAO;

class BestregService{
    
    public function getBestreg($bestelid){
        $bestregDAO = new BestregDAO();
        $bestreg = $bestregDAO->getBestelId($bestelid);
        return $bestreg;
    }
    
    public function setBestreg($bestelid, $idwijn, $aantalwijn, $idverpak, $aantalverpak, $prijs){
        $bestregDAO = new BestregDAO();
        $bestregDAO->createBestreg($bestelid, $idwijn, $aantalwijn, $idverpak, $aantalverpak, $prijs);
    }    
}

