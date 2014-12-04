<?php

/**
 * Utilisateur form base class.
 *
 * @method Utilisateur getObject() Returns the current form's model object
 *
 * @package    population
 * @subpackage form
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUtilisateurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'login'           => new sfWidgetFormInputText(),
      'password'        => new sfWidgetFormInputText(),
      'nom'             => new sfWidgetFormInputText(),
      'prenom'          => new sfWidgetFormInputText(),
      'etatCompte'      => new sfWidgetFormChoice(array('choices' => array('En attente' => 'En attente', 'Activé' => 'Activé', 'Désactivé' => 'Désactivé', 'Désactivé temporairement' => 'Désactivé temporairement', 'A supprimer' => 'A supprimer'))),
      'typeUtilisateur' => new sfWidgetFormChoice(array('choices' => array('User' => 'User', 'Admin' => 'Admin', 'SuperAdmin' => 'SuperAdmin'))),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'login'           => new sfValidatorString(array('max_length' => 30)),
      'password'        => new sfValidatorString(array('max_length' => 50)),
      'nom'             => new sfValidatorString(array('max_length' => 50)),
      'prenom'          => new sfValidatorString(array('max_length' => 50)),
      'etatCompte'      => new sfValidatorChoice(array('choices' => array(0 => 'En attente', 1 => 'Activé', 2 => 'Désactivé', 3 => 'Désactivé temporairement', 4 => 'A supprimer'), 'required' => false)),
      'typeUtilisateur' => new sfValidatorChoice(array('choices' => array(0 => 'User', 1 => 'Admin', 2 => 'SuperAdmin'))),
    ));

    $this->widgetSchema->setNameFormat('utilisateur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Utilisateur';
  }

}
