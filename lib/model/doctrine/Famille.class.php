<?php

/**
 * Famille
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    population
 * @subpackage model
 * @author     Flament Guillaume
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Famille extends BaseFamille {

    /*public function  __toString() {
        return $this->getId() . " - " . $this->getLogement()->getAdresse();
    }*/


    public static function getFamilleAdresse($a) {
        $f = Doctrine_core::getTable("Famille")->find($a);
        if ($f != null) {
            return ($f->getId() . " (" . $f->getLogement()->getAdresse() . ")");
        } else {
            return $a;
        }
    }

}