<?php

/**
 * Adresse filter form base class.
 *
 * @package    population
 * @subpackage filter
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdresseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numeroRue'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'complement'           => new sfWidgetFormFilterInput(),
      'nbLogementsMax'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'infosComplementaires' => new sfWidgetFormFilterInput(),
      'idRue'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rue'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'numeroRue'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'complement'           => new sfValidatorPass(array('required' => false)),
      'nbLogementsMax'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'infosComplementaires' => new sfValidatorPass(array('required' => false)),
      'idRue'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rue'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('adresse_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Adresse';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'numeroRue'            => 'Number',
      'complement'           => 'Text',
      'nbLogementsMax'       => 'Number',
      'infosComplementaires' => 'Text',
      'idRue'                => 'ForeignKey',
    );
  }
}
