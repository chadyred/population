<?php

class IndividuMutationForm extends sfForm {

    public function configure() {

        sfProjectConfiguration::getActive()->loadHelpers('Url');
        
        $this->setWidgets(array(
            'Ancienne famille' => new sfWidgetFormInput(),
            'Nouvelle famille' => new sfWidgetFormInput()
        ));    
        
        $this->widgetSchema['Nouvelle famille'] = new sfWidgetFormJQueryAutocompleter(array(
            'url'    => url_for('@ajax_getFamilles'),
            'config' => '{minChars: 1, delay: 500}'

        ));
        
        $this->getWidget('Ancienne famille')->setAttribute('disabled', 'disabled');

        $this->widgetSchema->setNameFormat('individu[%s]');

        $this->setValidators(array(
            'Nouvelle famille' => new sfValidatorInteger()
        ));

        parent::setup();
    }

}
