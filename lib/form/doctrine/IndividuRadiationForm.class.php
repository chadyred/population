<?php

class IndividuRadiationForm extends sfForm {

    public function configure() {

        $this->setWidgets(array(
            'Motif radiation' => new sfWidgetFormChoice(array('choices' => array('Départ commune' => 'Départ commune', 'Décès' => 'Décès'))),
            'Date radiation' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')),
            'Infos complémentaires' => new sfWidgetFormInput()
        ));

        $this->getWidget('Date radiation')->setAttribute('disabled', 'disabled');
        $this->setDefault('Date radiation', date('d-m-Y'));

        $this->widgetSchema->setNameFormat('individu[%s]');

        $this->setValidators(array(
            'Motif radiation' => new sfValidatorChoice(array('choices' => array(0 => 'Départ commune', 1 => 'Décès'), 'required' => true)),
            'Date radiation' => new sfValidatorDate(array('max' => strtotime(date('d-m-Y'))))
        ));

        parent::setup();
    }

}
