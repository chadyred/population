<?php

/**
 * Troncon form base class.
 *
 * @method Troncon getObject() Returns the current form's model object
 *
 * @package    population
 * @subpackage form
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTronconForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'idRue'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rue'), 'add_empty' => false)),
      'idSecteur'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Secteur'), 'add_empty' => false)),
      'numDebutPair'         => new sfWidgetFormInputText(),
      'numDebutImpair'       => new sfWidgetFormInputText(),
      'numFinPair'           => new sfWidgetFormInputText(),
      'numFinImpair'         => new sfWidgetFormInputText(),
      'infosComplementaires' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idRue'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rue'))),
      'idSecteur'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Secteur'))),
      'numDebutPair'         => new sfValidatorInteger(),
      'numDebutImpair'       => new sfValidatorInteger(),
      'numFinPair'           => new sfValidatorInteger(),
      'numFinImpair'         => new sfValidatorInteger(),
      'infosComplementaires' => new sfValidatorString(array('max_length' => 75, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('troncon[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Troncon';
  }

}
