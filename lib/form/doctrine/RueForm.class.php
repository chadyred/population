<?php

/**
 * Rue form.
 *
 * @package    population
 * @subpackage form
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RueForm extends BaseRueForm
{
  public function configure()
  {
        $this->widgetSchema->setLabels(array(
            'codeRivoli'    => 'Code rivoli',
            'nom'           => 'Nom',
            'motDirecteur'  => 'Mot directeur',
            'codeRivoli'    => 'Code rivoli',
            'premierNumero' => 'Premier numéro',
            'dernierNumero' => 'Dernier numéro',
            'idTypeRue'     => 'Type rue'
        ));
  }
}
