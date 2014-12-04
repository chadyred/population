<?php

/**
 * Cette classe permet la création du formulaire de recherche
 * sur les Individus
 *
 * @author Flament Guillaume
 */
class SearchFamilleForm extends sfForm {

    public function configure() {
        $this->setWidgets(array(
            'Id (code famille)' => new sfWidgetFormInput(),
            'Infos complementaires' => new sfWidgetFormInput(),
            'Id logement' => new sfWidgetFormInput(),
            'Adresse (n° rue)' => new sfWidgetFormInput(),
            'Nom rue' => new sfWidgetFormInput(),
        ));

        $this->widgetSchema->setNameFormat('Recherche[%s]');

        $this->setValidators(array(
            'Id (code famille)' => new sfValidatorInteger(),
            'Infos complementaires' => new sfValidatorString(),
            'Id logement' => new sfValidatorInteger(),
            'Adresse (n° rue)' => new sfValidatorString(),
            'Nom rue' => new sfValidatorString(),
        ));


        parent::setup();
    }

}
?>
