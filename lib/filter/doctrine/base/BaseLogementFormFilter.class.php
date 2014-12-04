<?php

/**
 * Logement filter form base class.
 *
 * @package    population
 * @subpackage filter
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLogementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'typeBatiment'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'Maison individuelle' => 'Maison individuelle', 'Maison jumelée' => 'Maison jumelée', 'Immeuble' => 'Immeuble', 'Hotel' => 'Hotel', 'Chateau' => 'Chateau', 'Bureaux' => 'Bureaux', 'Caravane' => 'Caravane', 'Hangar' => 'Hangar', 'Centre culturel' => 'Centre culturel', 'Municipal' => 'Municipal', 'Autre' => 'Autre', 'Inconnu' => 'Inconnu'))),
      'typeComplement'       => new sfWidgetFormChoice(array('choices' => array('' => '', 'Allée' => 'Allée', 'Batiment' => 'Batiment', 'Escalier' => 'Escalier', 'Couloir' => 'Couloir', 'Porte' => 'Porte', 'Zone' => 'Zone', 'Secteur' => 'Secteur'))),
      'valeurComplement'     => new sfWidgetFormFilterInput(),
      'infosComplementaires' => new sfWidgetFormFilterInput(),
      'idAdresse'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'typeBatiment'         => new sfValidatorChoice(array('required' => false, 'choices' => array('Maison individuelle' => 'Maison individuelle', 'Maison jumelée' => 'Maison jumelée', 'Immeuble' => 'Immeuble', 'Hotel' => 'Hotel', 'Chateau' => 'Chateau', 'Bureaux' => 'Bureaux', 'Caravane' => 'Caravane', 'Hangar' => 'Hangar', 'Centre culturel' => 'Centre culturel', 'Municipal' => 'Municipal', 'Autre' => 'Autre', 'Inconnu' => 'Inconnu'))),
      'typeComplement'       => new sfValidatorChoice(array('required' => false, 'choices' => array('' => '', 'Allée' => 'Allée', 'Batiment' => 'Batiment', 'Escalier' => 'Escalier', 'Couloir' => 'Couloir', 'Porte' => 'Porte', 'Zone' => 'Zone', 'Secteur' => 'Secteur'))),
      'valeurComplement'     => new sfValidatorPass(array('required' => false)),
      'infosComplementaires' => new sfValidatorPass(array('required' => false)),
      'idAdresse'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Adresse'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('logement_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Logement';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'typeBatiment'         => 'Enum',
      'typeComplement'       => 'Enum',
      'valeurComplement'     => 'Text',
      'infosComplementaires' => 'Text',
      'idAdresse'            => 'ForeignKey',
    );
  }
}
