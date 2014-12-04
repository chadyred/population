<?php

/**
 * Utilisateur filter form base class.
 *
 * @package    population
 * @subpackage filter
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUtilisateurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'login'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'password'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nom'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenom'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'etatCompte'      => new sfWidgetFormChoice(array('choices' => array('' => '', 'En attente' => 'En attente', 'Activé' => 'Activé', 'Désactivé' => 'Désactivé', 'Désactivé temporairement' => 'Désactivé temporairement', 'A supprimer' => 'A supprimer'))),
      'typeUtilisateur' => new sfWidgetFormChoice(array('choices' => array('' => '', 'User' => 'User', 'Admin' => 'Admin', 'SuperAdmin' => 'SuperAdmin'))),
    ));

    $this->setValidators(array(
      'login'           => new sfValidatorPass(array('required' => false)),
      'password'        => new sfValidatorPass(array('required' => false)),
      'nom'             => new sfValidatorPass(array('required' => false)),
      'prenom'          => new sfValidatorPass(array('required' => false)),
      'etatCompte'      => new sfValidatorChoice(array('required' => false, 'choices' => array('En attente' => 'En attente', 'Activé' => 'Activé', 'Désactivé' => 'Désactivé', 'Désactivé temporairement' => 'Désactivé temporairement', 'A supprimer' => 'A supprimer'))),
      'typeUtilisateur' => new sfValidatorChoice(array('required' => false, 'choices' => array('User' => 'User', 'Admin' => 'Admin', 'SuperAdmin' => 'SuperAdmin'))),
    ));

    $this->widgetSchema->setNameFormat('utilisateur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Utilisateur';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'login'           => 'Text',
      'password'        => 'Text',
      'nom'             => 'Text',
      'prenom'          => 'Text',
      'etatCompte'      => 'Enum',
      'typeUtilisateur' => 'Enum',
    );
  }
}
