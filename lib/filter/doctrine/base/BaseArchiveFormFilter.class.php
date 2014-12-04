<?php

/**
 * Archive filter form base class.
 *
 * @package    population
 * @subpackage filter
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArchiveFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nomNaissance'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nomUsage'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenoms'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'titre'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sexe'                 => new sfWidgetFormChoice(array('choices' => array('' => '', 'Masculin' => 'Masculin', 'Féminin' => 'Féminin'))),
      'dateNaissance'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'idVilleNaissance'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('villeNaissance'), 'add_empty' => true)),
      'situationFamiliale'   => new sfWidgetFormChoice(array('choices' => array('' => '', 'Célibataire' => 'Célibataire', 'Marié(e)' => 'Marié(e)', 'Pacsé(e)' => 'Pacsé(e)', 'Veuf(ve)' => 'Veuf(ve)', 'Inconnu' => 'Inconnu'))),
      'nomRueAnt'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'typeRueAnt'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numeroRueAnt'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'complementNumAnt'     => new sfWidgetFormFilterInput(),
      'nomRuePost'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'typeRuePost'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numeroRuePost'        => new sfWidgetFormFilterInput(),
      'complementNumPost'    => new sfWidgetFormFilterInput(),
      'dateArchivage'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'motifDepart'          => new sfWidgetFormChoice(array('choices' => array('' => '', 'Mutation' => 'Mutation', 'Départ commune' => 'Départ commune', 'Décès' => 'Décès', 'Inconnu' => 'Inconnu'))),
      'infosComplementaires' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nomNaissance'         => new sfValidatorPass(array('required' => false)),
      'nomUsage'             => new sfValidatorPass(array('required' => false)),
      'prenoms'              => new sfValidatorPass(array('required' => false)),
      'titre'                => new sfValidatorPass(array('required' => false)),
      'sexe'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('Masculin' => 'Masculin', 'Féminin' => 'Féminin'))),
      'dateNaissance'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'idVilleNaissance'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('villeNaissance'), 'column' => 'id')),
      'situationFamiliale'   => new sfValidatorChoice(array('required' => false, 'choices' => array('Célibataire' => 'Célibataire', 'Marié(e)' => 'Marié(e)', 'Pacsé(e)' => 'Pacsé(e)', 'Veuf(ve)' => 'Veuf(ve)', 'Inconnu' => 'Inconnu'))),
      'nomRueAnt'            => new sfValidatorPass(array('required' => false)),
      'typeRueAnt'           => new sfValidatorPass(array('required' => false)),
      'numeroRueAnt'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'complementNumAnt'     => new sfValidatorPass(array('required' => false)),
      'nomRuePost'           => new sfValidatorPass(array('required' => false)),
      'typeRuePost'          => new sfValidatorPass(array('required' => false)),
      'numeroRuePost'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'complementNumPost'    => new sfValidatorPass(array('required' => false)),
      'dateArchivage'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'motifDepart'          => new sfValidatorChoice(array('required' => false, 'choices' => array('Mutation' => 'Mutation', 'Départ commune' => 'Départ commune', 'Décès' => 'Décès', 'Inconnu' => 'Inconnu'))),
      'infosComplementaires' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('archive_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archive';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'nomNaissance'         => 'Text',
      'nomUsage'             => 'Text',
      'prenoms'              => 'Text',
      'titre'                => 'Text',
      'sexe'                 => 'Enum',
      'dateNaissance'        => 'Date',
      'idVilleNaissance'     => 'ForeignKey',
      'situationFamiliale'   => 'Enum',
      'nomRueAnt'            => 'Text',
      'typeRueAnt'           => 'Text',
      'numeroRueAnt'         => 'Number',
      'complementNumAnt'     => 'Text',
      'nomRuePost'           => 'Text',
      'typeRuePost'          => 'Text',
      'numeroRuePost'        => 'Number',
      'complementNumPost'    => 'Text',
      'dateArchivage'        => 'Date',
      'motifDepart'          => 'Enum',
      'infosComplementaires' => 'Text',
    );
  }
}
