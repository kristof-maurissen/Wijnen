<?php
//scr/WijnshopTest/Business/WijnService.php

namespace WijnshopTest\Business;
use WijnshopTest\Data\WijnDAO;


class WijnService {
    
    public function getWijnOverzicht() {
        $wijnDAO = new WijnDAO(); 
        $lijst = $wijnDAO->getAll(); 
        return $lijst; 
    }
    public function getOverzichtByCat($cat) {
        $wijnDAO = new WijnDAO();
        $lijst = $wijnDAO->getWijnByCat($cat);
        return $lijst;
    }
    public function getOverzichtByLand($land) {
        $wijnDAO = new WijnDAO();
        $lijst = $wijnDAO->getWijnByLand($land);
        return $lijst;
    }
    
    public function getOverzichtByJaar($jaar) {
        $wijnDAO = new WijnDAO();
        $lijst = $wijnDAO->getWijnByJaar($jaar);
        return $lijst;
    }
    
    public function getIdOfWijn($idwijn){
        $wijnDAO = new WijnDao();
        $lijst = $wijnDAO->getWijnByID($idwijn);
        return $lijst;
    }

    public function newWijn($naam, $jaartal, $land, $cat, $image, $artcode, $prijs) {       
        $wijnDAO = new WijnDAO();
        $wijn = $wijnDAO->createWijn($naam, $jaartal, $land, $cat, $image, $artcode, $prijs);
            if (isset($wijn)){
                return true;
            }else{
                return false;
            } 
    }
    
   
    
}
