<?php

/**
 * Individu filter form base class.
 *
 * @package    population
 * @subpackage filter
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseIndividuFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nomNaissance'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nomUsage'           => new sfWidgetFormFilterInput(),
      'prenoms'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'titre'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sexe'               => new sfWidgetFormChoice(array('choices' => array('' => '', 'Masculin' => 'Masculin', 'Féminin' => 'Féminin'))),
      'dateNaissance'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'idVilleNaissance'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('villeNaissance'), 'add_empty' => true)),
      'ancienneVilleNaiss' => new sfWidgetFormFilterInput(),
      'situationFamiliale' => new sfWidgetFormChoice(array('choices' => array('' => '', 'Célibataire' => 'Célibataire', 'Marié(e)' => 'Marié(e)', 'Pacsé(e)' => 'Pacsé(e)', 'Veuf(ve)' => 'Veuf(ve)', 'Divorcé(e)' => 'Divorcé(e)', 'Séparé(e)' => 'Séparé(e)', 'Vie maritale' => 'Vie maritale', 'Inconnue' => 'Inconnue'))),
      'chefFamille'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'profession'         => new sfWidgetFormFilterInput(),
      'email'              => new sfWidgetFormFilterInput(),
      'dateArrivee'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'idFamille'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famille'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nomNaissance'       => new sfValidatorPass(array('required' => false)),
      'nomUsage'           => new sfValidatorPass(array('required' => false)),
      'prenoms'            => new sfValidatorPass(array('required' => false)),
      'titre'              => new sfValidatorPass(array('required' => false)),
      'sexe'               => new sfValidatorChoice(array('required' => false, 'choices' => array('Masculin' => 'Masculin', 'Féminin' => 'Féminin'))),
      'dateNaissance'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'idVilleNaissance'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('villeNaissance'), 'column' => 'id')),
      'ancienneVilleNaiss' => new sfValidatorPass(array('required' => false)),
      'situationFamiliale' => new sfValidatorChoice(array('required' => false, 'choices' => array('Célibataire' => 'Célibataire', 'Marié(e)' => 'Marié(e)', 'Pacsé(e)' => 'Pacsé(e)', 'Veuf(ve)' => 'Veuf(ve)', 'Divorcé(e)' => 'Divorcé(e)', 'Séparé(e)' => 'Séparé(e)', 'Vie maritale' => 'Vie maritale', 'Inconnue' => 'Inconnue'))),
      'chefFamille'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'profession'         => new sfValidatorPass(array('required' => false)),
      'email'              => new sfValidatorPass(array('required' => false)),
      'dateArrivee'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'idFamille'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Famille'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('individu_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Individu';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'nomNaissance'       => 'Text',
      'nomUsage'           => 'Text',
      'prenoms'            => 'Text',
      'titre'              => 'Text',
      'sexe'               => 'Enum',
      'dateNaissance'      => 'Date',
      'idVilleNaissance'   => 'ForeignKey',
      'ancienneVilleNaiss' => 'Text',
      'situationFamiliale' => 'Enum',
      'chefFamille'        => 'Boolean',
      'profession'         => 'Text',
      'email'              => 'Text',
      'dateArrivee'        => 'Date',
      'idFamille'          => 'ForeignKey',
    );
  }
}
