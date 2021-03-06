<?php

/**
 * TronconTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TronconTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object TronconTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Troncon');
    }

    public function getTronconsBySecteur($idSecteur) {
        $q = $this->createQuery('t')
                        ->where('t.idSecteur =?', $idSecteur);
        return $q->execute();
    }

}