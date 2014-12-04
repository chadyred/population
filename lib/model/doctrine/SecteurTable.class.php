<?php

/**
 * SecteurTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SecteurTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object SecteurTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Secteur');
    }

    public function getSecteurEtRues($idSecteur) {
        $q = $this->createQuery('s')
                        ->leftjoin('s.Troncons t')
                        ->leftjoin('t.Rue r')
                        ->where('s.id =?', $idSecteur);
        return $q->execute()->getFirst();
    }

}