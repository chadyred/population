<?php

/**
 * BaseSecteur
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $libelle
 * @property integer $idDecoupage
 * @property Decoupage $Decoupage
 * @property Doctrine_Collection $Troncons
 * 
 * @method string              getLibelle()     Returns the current record's "libelle" value
 * @method integer             getIdDecoupage() Returns the current record's "idDecoupage" value
 * @method Decoupage           getDecoupage()   Returns the current record's "Decoupage" value
 * @method Doctrine_Collection getTroncons()    Returns the current record's "Troncons" collection
 * @method Secteur             setLibelle()     Sets the current record's "libelle" value
 * @method Secteur             setIdDecoupage() Sets the current record's "idDecoupage" value
 * @method Secteur             setDecoupage()   Sets the current record's "Decoupage" value
 * @method Secteur             setTroncons()    Sets the current record's "Troncons" collection
 * 
 * @package    population
 * @subpackage model
 * @author     Flament Guillaume
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSecteur extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('secteur');
        $this->hasColumn('libelle', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('idDecoupage', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Decoupage', array(
             'local' => 'idDecoupage',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Troncon as Troncons', array(
             'local' => 'id',
             'foreign' => 'idSecteur'));
    }
}