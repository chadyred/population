<?php

/**
 * Individu form.
 *
 * @package    population
 * @subpackage form
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class IndividuForm extends BaseIndividuForm {
    public function configure(){
       // Permet de redéfinir la plage d'années sur une plage plus grande
       $range = range('2038', '1901');

       $widgetDate = $this->widgetSchema['dateNaissance'] =
               new sfWidgetFormJQueryDate(array('image'=>'/images/jquery-ui-images/calendar.gif',
                                                         'culture' => 'fr',
                                                         'date_widget' => new sfWidgetFormDate(array(
                                                            'format' => '%day%/%month%/%year%',
                                                            'years' => array_combine($range, $range))
                                                          )));
       
       $widgetDate = $this->widgetSchema['dateArrivee'] =
               new sfWidgetFormJQueryDate(array('image'=>'/images/jquery-ui-images/calendar.gif',
                                                         'culture' => 'fr',
                                                         'date_widget' => new sfWidgetFormDate(array(
                                                            'format' => '%day%/%month%/%year%',
                                                            'years' => array_combine($range, $range))
                                                          )));

//       $this->widgetSchema['dateArrivee'] = new sfWidgetFormDate(array(
//                                                            'format' => '%day%/%month%/%year%',
//                                                            'years' => array_combine($range, $range)));


       // Ce validateur permet de vérifier que la date d'arrivée du nouvel individu n'est pas supérieure à la date courante
       $this->validatorSchema['dateArrivee'] = new sfValidatorDate(
             array( 'max' => strtotime(date('d-m-Y')), 'required' => false));

       // Redéfinitions des labels (th)
       $this->widgetSchema->setLabels(array(
            'nomNaissance'      => 'Nom naissance',
            'nomUsage'          => 'Nom usage',
            'prenoms'           => 'Prénoms',
            'titre'             => 'Titre',
            'sexe'              => 'Sexe',
            'dateNaissance'     => 'Date naissance',
            'idVilleNaissance'  => 'Ville naissance',
            'situationFamiliale'=> 'Situation familiale',
            'chefFamille'       => 'Chef famille',
            'profession'        => 'Profession',
            'idFamille'         => 'Id famille',
            'dateArrivee'       => 'Date arrivée',
            'email'             => 'Email'
        ));

       $this->setWidget('ancienneVilleNaiss', new sfWidgetFormInputHidden());
       //$this->setWidget('dateArrivee', new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')));
       $this->setDefault('dateArrivee', date('d-m-Y'));

    }
}
