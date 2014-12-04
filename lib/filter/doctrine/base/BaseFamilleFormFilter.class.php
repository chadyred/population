<?php

/**
 * Famille filter form base class.
 *
 * @package    population
 * @subpackage filter
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFamilleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idLogement'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Logement'), 'add_empty' => true)),
      'infosComplementaires' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'idLogement'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Logement'), 'column' => 'id')),
      'infosComplementaires' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('famille_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Famille';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'idLogement'           => 'ForeignKey',
      'infosComplementaires' => 'Text',
    );
  }
}
