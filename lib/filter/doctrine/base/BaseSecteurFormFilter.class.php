<?php

/**
 * Secteur filter form base class.
 *
 * @package    population
 * @subpackage filter
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSecteurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idDecoupage' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Decoupage'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'     => new sfValidatorPass(array('required' => false)),
      'idDecoupage' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Decoupage'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('secteur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Secteur';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'libelle'     => 'Text',
      'idDecoupage' => 'ForeignKey',
    );
  }
}
