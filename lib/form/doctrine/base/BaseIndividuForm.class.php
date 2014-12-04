<?php

/**
 * Individu form base class.
 *
 * @method Individu getObject() Returns the current form's model object
 *
 * @package    population
 * @subpackage form
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseIndividuForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'nomNaissance'       => new sfWidgetFormInputText(),
      'nomUsage'           => new sfWidgetFormInputText(),
      'prenoms'            => new sfWidgetFormInputText(),
      'titre'              => new sfWidgetFormInputText(),
      'sexe'               => new sfWidgetFormChoice(array('choices' => array('Masculin' => 'Masculin', 'Féminin' => 'Féminin'))),
      'dateNaissance'      => new sfWidgetFormDate(),
      'idVilleNaissance'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('villeNaissance'), 'add_empty' => true)),
      'ancienneVilleNaiss' => new sfWidgetFormInputText(),
      'situationFamiliale' => new sfWidgetFormChoice(array('choices' => array('Célibataire' => 'Célibataire', 'Marié(e)' => 'Marié(e)', 'Pacsé(e)' => 'Pacsé(e)', 'Veuf(ve)' => 'Veuf(ve)', 'Divorcé(e)' => 'Divorcé(e)', 'Séparé(e)' => 'Séparé(e)', 'Vie maritale' => 'Vie maritale', 'Inconnue' => 'Inconnue'))),
      'chefFamille'        => new sfWidgetFormInputCheckbox(),
      'profession'         => new sfWidgetFormInputText(),
      'email'              => new sfWidgetFormInputText(),
      'dateArrivee'        => new sfWidgetFormDate(),
      'idFamille'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famille'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nomNaissance'       => new sfValidatorString(array('max_length' => 60)),
      'nomUsage'           => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'prenoms'            => new sfValidatorString(array('max_length' => 100)),
      'titre'              => new sfValidatorString(array('max_length' => 4)),
      'sexe'               => new sfValidatorChoice(array('choices' => array(0 => 'Masculin', 1 => 'Féminin'))),
      'dateNaissance'      => new sfValidatorDate(array('required' => false)),
      'idVilleNaissance'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('villeNaissance'), 'required' => false)),
      'ancienneVilleNaiss' => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'situationFamiliale' => new sfValidatorChoice(array('choices' => array(0 => 'Célibataire', 1 => 'Marié(e)', 2 => 'Pacsé(e)', 3 => 'Veuf(ve)', 4 => 'Divorcé(e)', 5 => 'Séparé(e)', 6 => 'Vie maritale', 7 => 'Inconnue'))),
      'chefFamille'        => new sfValidatorBoolean(),
      'profession'         => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'email'              => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'dateArrivee'        => new sfValidatorDate(array('required' => false)),
      'idFamille'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Famille'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('individu[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Individu';
  }

}
