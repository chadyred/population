<?php

/*
 * GFormulaire relatif à la recherche des adresses 
 * @author Florent Paccalet 
 */

class SearchAdresseForm extends sfForm {

    public function configure() {
        $this->setWidgets(array(
            'Id' => new sfWidgetFormInput(),
            'Numero rue' => new sfWidgetFormInput(),
            'Complement' => new sfWidgetFormInput(),
            'Rue' => new sfWidgetFormInput(),
            'Nb logements max' => new sfWidgetFormInput(),
            'Nb logements occupés' => new sfWidgetFormInput(),
            'Nb logements vides' => new sfWidgetFormInput(),
        ));

        $this->widgetSchema->setNameFormat('Recherche[%s]');

        $this->setValidators(array(
            'Id' => new sfValidatorInteger(),
            'Numero rue' => new sfValidatorInteger(),
            'Complement' => new sfValidatorString(),
            'Rue' => new sfValidatorString(),
            'Nb logements max' => new sfValidatorInteger(),
            'Nb logements occupés' => new sfValidatorInteger(),
            'Nb logements vides' => new sfValidatorInteger(),
        ));


        parent::setup();
    }

}



?>
