<?php

/**
 * Project form base class.
 *
 * @package    population
 * @subpackage form
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine {

    public function setup() {
        $context = sfContext::getInstance();
        
        if (isset($this["idVilleNaissance"])) {
            $this->setWidget('idVilleNaissance', new sfWidgetFormJQueryAutocompleter(array(
                        'url' => $context->getController()->genUrl('@ajax_getVilles'),
                        'value_callback' => array("Ville", "getVilleCP")
                    )));
        }
        
        if (isset($this["idFamille"])) {
            $this->setWidget('idFamille', new sfWidgetFormJQueryAutocompleter(array(
                        'url' => $context->getController()->genUrl('@ajax_getFamilles'),
                        'value_callback' => array("Famille", "getFamilleAdresse")
                    )));
        }
        
        if (isset($this["idLogement"])) {
            $this->setWidget('idLogement', new sfWidgetFormJQueryAutocompleter(array(
                        'url' => $context->getController()->genUrl('@ajax_getLogements'),
                        'value_callback' => array("Logement", "getLogementAdresse")
                    )));
        }
        
        if (isset($this["Nouvelle famille"])) {
            $this->setWidget('Nouvelle famille', new sfWidgetFormJQueryAutocompleter(array(
                        'url' => $context->getController()->genUrl('@ajax_getFamilles'),
                        'value_callback' => array("Famille", "getFamilleAdresse")
                    )));
        }
        
    }

}
