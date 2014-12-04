<?php

/**
 * Rue filter form base class.
 *
 * @package    population
 * @subpackage filter
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRueFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'codeRivoli'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nom'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'motDirecteur'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'premierNumero' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dernierNumero' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idTypeRue'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeRue'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'codeRivoli'    => new sfValidatorPass(array('required' => false)),
      'nom'           => new sfValidatorPass(array('required' => false)),
      'motDirecteur'  => new sfValidatorPass(array('required' => false)),
      'premierNumero' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dernierNumero' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idTypeRue'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TypeRue'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('rue_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rue';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'codeRivoli'    => 'Text',
      'nom'           => 'Text',
      'motDirecteur'  => 'Text',
      'premierNumero' => 'Number',
      'dernierNumero' => 'Number',
      'idTypeRue'     => 'ForeignKey',
    );
  }
}
