<?php

/**
 * Rue form base class.
 *
 * @method Rue getObject() Returns the current form's model object
 *
 * @package    population
 * @subpackage form
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRueForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'codeRivoli'    => new sfWidgetFormInputText(),
      'nom'           => new sfWidgetFormInputText(),
      'motDirecteur'  => new sfWidgetFormInputText(),
      'premierNumero' => new sfWidgetFormInputText(),
      'dernierNumero' => new sfWidgetFormInputText(),
      'idTypeRue'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeRue'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'codeRivoli'    => new sfValidatorString(array('max_length' => 8)),
      'nom'           => new sfValidatorString(array('max_length' => 150)),
      'motDirecteur'  => new sfValidatorString(array('max_length' => 50)),
      'premierNumero' => new sfValidatorInteger(),
      'dernierNumero' => new sfValidatorInteger(),
      'idTypeRue'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TypeRue'))),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Rue', 'column' => array('codeRivoli')))
    );

    $this->widgetSchema->setNameFormat('rue[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rue';
  }

}
