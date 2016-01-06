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
