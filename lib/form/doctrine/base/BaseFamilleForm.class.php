<?php

/**
 * Famille form base class.
 *
 * @method Famille getObject() Returns the current form's model object
 *
 * @package    population
 * @subpackage form
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFamilleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'idLogement'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Logement'), 'add_empty' => true)),
      'infosComplementaires' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idLogement'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Logement'), 'required' => false)),
      'infosComplementaires' => new sfValidatorString(array('max_length' => 75, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('famille[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Famille';
  }

}
