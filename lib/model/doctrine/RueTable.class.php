<?php

/**
 * RueTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class RueTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object RueTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Rue');
    }

    public function getRuesSortedById() {
        $q = $this->createQuery('r')
                        ->orderBy('r.id ASC');
        return $q;
    }

    public function getRuesByTypeRue($typeRue) {
        $q = $this->createQuery('r')
                        ->where('r.idTypeRue =?', $typeRue);
        return $q;
    }
}