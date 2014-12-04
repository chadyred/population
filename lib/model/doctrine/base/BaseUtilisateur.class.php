<?php

/**
 * BaseUtilisateur
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $login
 * @property string $password
 * @property string $nom
 * @property string $prenom
 * @property enum $etatCompte
 * @property enum $typeUtilisateur
 * 
 * @method string      getLogin()           Returns the current record's "login" value
 * @method string      getPassword()        Returns the current record's "password" value
 * @method string      getNom()             Returns the current record's "nom" value
 * @method string      getPrenom()          Returns the current record's "prenom" value
 * @method enum        getEtatCompte()      Returns the current record's "etatCompte" value
 * @method enum        getTypeUtilisateur() Returns the current record's "typeUtilisateur" value
 * @method Utilisateur setLogin()           Sets the current record's "login" value
 * @method Utilisateur setPassword()        Sets the current record's "password" value
 * @method Utilisateur setNom()             Sets the current record's "nom" value
 * @method Utilisateur setPrenom()          Sets the current record's "prenom" value
 * @method Utilisateur setEtatCompte()      Sets the current record's "etatCompte" value
 * @method Utilisateur setTypeUtilisateur() Sets the current record's "typeUtilisateur" value
 * 
 * @package    population
 * @subpackage model
 * @author     Flament Guillaume
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUtilisateur extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('utilisateur');
        $this->hasColumn('login', 'string', 30, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 30,
             ));
        $this->hasColumn('password', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('nom', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('prenom', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('etatCompte', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'En attente',
              1 => 'Activé',
              2 => 'Désactivé',
              3 => 'Désactivé temporairement',
              4 => 'A supprimer',
             ),
             'default' => 'En attente',
             'notnull' => true,
             ));
        $this->hasColumn('typeUtilisateur', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'User',
              1 => 'Admin',
              2 => 'SuperAdmin',
             ),
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}