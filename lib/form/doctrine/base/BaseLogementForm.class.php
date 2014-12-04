<?php

/**
 * Logement form base class.
 *
 * @method Logement getObject() Returns the current form's model object
 *
 * @package    population
 * @subpackage form
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLogementForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'typeBatiment'         => new sfWidgetFormChoice(array('choices' => array('Maison individuelle' => 'Maison individuelle', 'Maison jumelée' => 'Maison jumelée', 'Immeuble' => 'Immeuble', 'Hotel' => 'Hotel', 'Chateau' => 'Chateau', 'Bureaux' => 'Bureaux', 'Caravane' => 'Caravane', 'Hangar' => 'Hangar', 'Centre culturel' => 'Centre culturel', 'Municipal' => 'Municipal', 'Autre' => 'Autre', 'Inconnu' => 'Inconnu'))),
      'typeComplement'       => new sfWidgetFormChoice(array('choices' => array('' => '', 'Allée' => 'Allée', 'Batiment' => 'Batiment', 'Escalier' => 'Escalier', 'Couloir' => 'Couloir', 'Porte' => 'Porte', 'Zone' => 'Zone', 'Secteur' => 'Secteur'))),
      'valeurComplement'     => new sfWidgetFormInputText(),
      'infosComplementaires' => new sfWidgetFormInputText(),
      'idAdresse'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'typeBatiment'         => new sfValidatorChoice(array('choices' => array(0 => 'Maison individuelle', 1 => 'Maison jumelée', 2 => 'Immeuble', 3 => 'Hotel', 4 => 'Chateau', 5 => 'Bureaux', 6 => 'Caravane', 7 => 'Hangar', 8 => 'Centre culturel', 9 => 'Municipal', 10 => 'Autre', 11 => 'Inconnu'), 'required' => false)),
      'typeComplement'       => new sfValidatorChoice(array('choices' => array(0 => '', 1 => 'Allée', 2 => 'Batiment', 3 => 'Escalier', 4 => 'Couloir', 5 => 'Porte', 6 => 'Zone', 7 => 'Secteur'), 'required' => false)),
      'valeurComplement'     => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'infosComplementaires' => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'idAdresse'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'))),
    ));

    $this->widgetSchema->setNameFormat('logement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Logement';
  }

}
