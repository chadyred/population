<?php

/**
 * Logement
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    population
 * @subpackage model
 * @author     Flament Guillaume
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Logement extends BaseLogement
{
    public function __tostring(){
        //return "n°" . $this->getId() . " -- " . $this->getAdresse() . ", " . $this->getTypeBatiment() . ($this->getTypeComplement()=="" ? "" : ", " . $this->getTypeComplement())  . ($this->getValeurComplement()=="" ? "" : " : " . $this->getValeurComplement());
        return "n°" . $this->getId() . " -- " . $this->getAdresse();
    }
    
    public static function getLogementAdresse($a) {
        $l = Doctrine_core::getTable("Logement")->find($a);
        if ($l != null) {
            return ("n°" . $l->getId() . " -- " . $l->getAdresse());
        } else {
            return $a;
        }
    }
}
