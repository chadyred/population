<?php

/**
 * Adresse form base class.
 *
 * @method Adresse getObject() Returns the current form's model object
 *
 * @package    population
 * @subpackage form
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdresseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'numeroRue'            => new sfWidgetFormInputText(),
      'complement'           => new sfWidgetFormInputText(),
      'nbLogementsMax'       => new sfWidgetFormInputText(),
      'infosComplementaires' => new sfWidgetFormInputText(),
      'idRue'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rue'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numeroRue'            => new sfValidatorInteger(),
      'complement'           => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'nbLogementsMax'       => new sfValidatorInteger(),
      'infosComplementaires' => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'idRue'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rue'))),
    ));

    $this->widgetSchema->setNameFormat('adresse[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Adresse';
  }

}
