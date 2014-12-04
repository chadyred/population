<?php

/**
 * Logement form.
 *
 * @package    population
 * @subpackage form
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LogementForm extends BaseLogementForm
{
    public function configure(){
        $this->widgetSchema->setLabels(array(
            'typeBatiment'         => 'Type batiment',
            'typeComplement'       => 'Type complément',
            'valeurComplement'     => 'Valeur complément',
            'infosComplementaires' => 'Infos complémentaires',
            'idAdresse'            => 'Adresse'
        ));

//        $this->setWidget('idAdresse', new sfWidgetFormDoctrineChoice()
//        $this->widgetSchema['idAdresse'] = new sfWidgetFormDoctrineChoice(
//            array(
//                'model' => 'AdresseTable',
//                'add_empty' => 'Select a list',
//                'method' => 'getWithStatus',
//                'renderer_class' => 'sfWidgetFormSelect'
//            ),
//            array()
//        );

        $this->setWidget('idAdresse', new sfWidgetFormInputHidden());
    }
}
