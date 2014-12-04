<?php

/**
 * Cette classe permet la création du formulaire de recherche
 * sur les Individus
 *
 * @author Flament Guillaume
 */
class SearchLogementForm extends sfForm {

    public function configure() {
        $this->setWidgets(array(
            'Id logement' => new sfWidgetFormInput(),
            'Adresse (n° rue)' => new sfWidgetFormInput(),
            'Nom rue' => new sfWidgetFormInput(),
            'Trier selon' => new sfWidgetFormChoice(array('choices' => array('' => '', 'id' => 'Id logement', 'idAdresse' => 'Adresse'))),
            'Ordre' => new sfWidgetFormChoice(array('choices' => array('' => '', 'ASC' => 'Croissant', 'DESC' => 'Décroissant')))
        ));

        $this->widgetSchema->setNameFormat('Recherche[%s]');

        $this->setValidators(array(
            'Id logement' => new sfValidatorInteger(),
            'Adresse (n° rue)' => new sfValidatorString(),
            'Nom rue' => new sfValidatorString(),
        ));

        parent::setup();
    }

}
?>
