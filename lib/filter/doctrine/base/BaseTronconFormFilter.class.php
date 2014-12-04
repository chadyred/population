<?php

/**
 * Troncon filter form base class.
 *
 * @package    population
 * @subpackage filter
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTronconFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idRue'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rue'), 'add_empty' => true)),
      'idSecteur'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Secteur'), 'add_empty' => true)),
      'numDebutPair'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numDebutImpair'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numFinPair'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numFinImpair'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'infosComplementaires' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'idRue'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rue'), 'column' => 'id')),
      'idSecteur'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Secteur'), 'column' => 'id')),
      'numDebutPair'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'numDebutImpair'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'numFinPair'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'numFinImpair'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'infosComplementaires' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('troncon_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Troncon';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'idRue'                => 'ForeignKey',
      'idSecteur'            => 'ForeignKey',
      'numDebutPair'         => 'Number',
      'numDebutImpair'       => 'Number',
      'numFinPair'           => 'Number',
      'numFinImpair'         => 'Number',
      'infosComplementaires' => 'Text',
    );
  }
}
