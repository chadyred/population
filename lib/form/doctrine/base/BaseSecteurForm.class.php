<?php

/**
 * Secteur form base class.
 *
 * @method Secteur getObject() Returns the current form's model object
 *
 * @package    population
 * @subpackage form
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSecteurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'libelle'     => new sfWidgetFormInputText(),
      'idDecoupage' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Decoupage'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'     => new sfValidatorString(array('max_length' => 50)),
      'idDecoupage' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Decoupage'))),
    ));

    $this->widgetSchema->setNameFormat('secteur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Secteur';
  }

}
