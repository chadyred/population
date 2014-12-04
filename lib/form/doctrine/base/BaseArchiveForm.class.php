<?php

/**
 * Archive form base class.
 *
 * @method Archive getObject() Returns the current form's model object
 *
 * @package    population
 * @subpackage form
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArchiveForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'nomNaissance'         => new sfWidgetFormInputText(),
      'nomUsage'             => new sfWidgetFormInputText(),
      'prenoms'              => new sfWidgetFormInputText(),
      'titre'                => new sfWidgetFormInputText(),
      'sexe'                 => new sfWidgetFormChoice(array('choices' => array('Masculin' => 'Masculin', 'Féminin' => 'Féminin'))),
      'dateNaissance'        => new sfWidgetFormDate(),
      'idVilleNaissance'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('villeNaissance'), 'add_empty' => true)),
      'situationFamiliale'   => new sfWidgetFormChoice(array('choices' => array('Célibataire' => 'Célibataire', 'Marié(e)' => 'Marié(e)', 'Pacsé(e)' => 'Pacsé(e)', 'Veuf(ve)' => 'Veuf(ve)', 'Inconnu' => 'Inconnu'))),
      'nomRueAnt'            => new sfWidgetFormInputText(),
      'typeRueAnt'           => new sfWidgetFormInputText(),
      'numeroRueAnt'         => new sfWidgetFormInputText(),
      'complementNumAnt'     => new sfWidgetFormInputText(),
      'nomRuePost'           => new sfWidgetFormInputText(),
      'typeRuePost'          => new sfWidgetFormInputText(),
      'numeroRuePost'        => new sfWidgetFormInputText(),
      'complementNumPost'    => new sfWidgetFormInputText(),
      'dateArchivage'        => new sfWidgetFormDate(),
      'motifDepart'          => new sfWidgetFormChoice(array('choices' => array('Mutation' => 'Mutation', 'Départ commune' => 'Départ commune', 'Décès' => 'Décès', 'Inconnu' => 'Inconnu'))),
      'infosComplementaires' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nomNaissance'         => new sfValidatorString(array('max_length' => 60)),
      'nomUsage'             => new sfValidatorString(array('max_length' => 60)),
      'prenoms'              => new sfValidatorString(array('max_length' => 100)),
      'titre'                => new sfValidatorString(array('max_length' => 4)),
      'sexe'                 => new sfValidatorChoice(array('choices' => array(0 => 'Masculin', 1 => 'Féminin'))),
      'dateNaissance'        => new sfValidatorDate(array('required' => false)),
      'idVilleNaissance'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('villeNaissance'), 'required' => false)),
      'situationFamiliale'   => new sfValidatorChoice(array('choices' => array(0 => 'Célibataire', 1 => 'Marié(e)', 2 => 'Pacsé(e)', 3 => 'Veuf(ve)', 4 => 'Inconnu'))),
      'nomRueAnt'            => new sfValidatorString(array('max_length' => 50)),
      'typeRueAnt'           => new sfValidatorString(array('max_length' => 50)),
      'numeroRueAnt'         => new sfValidatorInteger(),
      'complementNumAnt'     => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'nomRuePost'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'typeRuePost'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'numeroRuePost'        => new sfValidatorInteger(array('required' => false)),
      'complementNumPost'    => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'dateArchivage'        => new sfValidatorDate(),
      'motifDepart'          => new sfValidatorChoice(array('choices' => array(0 => 'Mutation', 1 => 'Départ commune', 2 => 'Décès', 3 => 'Inconnu'))),
      'infosComplementaires' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('archive[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archive';
  }

}
