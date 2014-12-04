<?php

/**
 * BaseLogement
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property enum $typeBatiment
 * @property enum $typeComplement
 * @property string $valeurComplement
 * @property string $infosComplementaires
 * @property integer $idAdresse
 * @property Adresse $Adresse
 * @property Doctrine_Collection $Familles
 * 
 * @method enum                getTypeBatiment()         Returns the current record's "typeBatiment" value
 * @method enum                getTypeComplement()       Returns the current record's "typeComplement" value
 * @method string              getValeurComplement()     Returns the current record's "valeurComplement" value
 * @method string              getInfosComplementaires() Returns the current record's "infosComplementaires" value
 * @method integer             getIdAdresse()            Returns the current record's "idAdresse" value
 * @method Adresse             getAdresse()              Returns the current record's "Adresse" value
 * @method Doctrine_Collection getFamilles()             Returns the current record's "Familles" collection
 * @method Logement            setTypeBatiment()         Sets the current record's "typeBatiment" value
 * @method Logement            setTypeComplement()       Sets the current record's "typeComplement" value
 * @method Logement            setValeurComplement()     Sets the current record's "valeurComplement" value
 * @method Logement            setInfosComplementaires() Sets the current record's "infosComplementaires" value
 * @method Logement            setIdAdresse()            Sets the current record's "idAdresse" value
 * @method Logement            setAdresse()              Sets the current record's "Adresse" value
 * @method Logement            setFamilles()             Sets the current record's "Familles" collection
 * 
 * @package    population
 * @subpackage model
 * @author     Flament Guillaume
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLogement extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('logement');
        $this->hasColumn('typeBatiment', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'Maison individuelle',
              1 => 'Maison jumelée',
              2 => 'Immeuble',
              3 => 'Hotel',
              4 => 'Chateau',
              5 => 'Bureaux',
              6 => 'Caravane',
              7 => 'Hangar',
              8 => 'Centre culturel',
              9 => 'Municipal',
              10 => 'Autre',
              11 => 'Inconnu',
             ),
             'default' => 'Inconnu',
             'notnull' => true,
             ));
        $this->hasColumn('typeComplement', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => '',
              1 => 'Allée',
              2 => 'Batiment',
              3 => 'Escalier',
              4 => 'Couloir',
              5 => 'Porte',
              6 => 'Zone',
              7 => 'Secteur',
             ),
             'default' => '',
             'notnull' => false,
             ));
        $this->hasColumn('valeurComplement', 'string', 30, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 30,
             ));
        $this->hasColumn('infosComplementaires', 'string', 75, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 75,
             ));
        $this->hasColumn('idAdresse', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Adresse', array(
             'local' => 'idAdresse',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Famille as Familles', array(
             'local' => 'id',
             'foreign' => 'idLogement'));
    }
}