<?php

/**
 * Adresse form.
 *
 * @package    population
 * @subpackage form
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdresseForm extends BaseAdresseForm
{
  public function configure(){
        $this->widgetSchema->setLabels(array(
            'numeroRue'      => 'Numéro rue',
            'complement'     => 'Complément',
            'nbLogementsMax' => 'Nombre logements total',
            'idRue'          => 'Rue',
        ));
  }
}
