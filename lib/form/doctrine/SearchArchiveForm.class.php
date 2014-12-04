<?php

/**
 * Cette classe permet la création du formulaire de recherche
 * sur les Individus
 *
 * @author Flament Guillaume
 */
class SearchArchiveForm extends sfForm {

    public function configure() {
        
        sfProjectConfiguration::getActive()->loadHelpers('Url');

        $this->setWidgets(array(
            'Nom naissance' => new sfWidgetFormInput(),
            'Nom usage' => new sfWidgetFormInput(),
            'Prénoms' => new sfWidgetFormInput(),
            'Titre' => new sfWidgetFormInput(),
            'Sexe' => new sfWidgetFormChoice(array('choices' => array('' => '', 'Masculin' => 'Masculin', 'Féminin' => 'Féminin'))),
            'Date naissance min' => new sfWidgetFormDate(),
            'Date naissance max' => new sfWidgetFormDate(),
            'Situation familiale' => new sfWidgetFormChoice(array('choices' =>
                array('' => '', 'Célibataire' => 'Célibataire', 'Marié(e)' => 'Marié(e)',
                    'Veuf(ve)' => 'Veuf(ve)', 'Divorcé(e)' => 'Divorcé(e)', 'Séparé(e)' => 'Séparé(e)',
                    'Vie maritale' => 'Vie maritale', 'Pacsé(e)' => 'Pacsé(e)', 'Inconnue' => 'Inconnue'))),
            'Ville naissance' => new sfWidgetFormJQueryAutocompleter(array(
                'url'    => url_for('@ajax_getVilles'),
                'config' => '{minChars: 1, delay: 500}'

            )),
            'Date archivage min' => new sfWidgetFormDate(),
            'Date archivage max' => new sfWidgetFormDate(),
            'Id archive' => new sfWidgetFormInput(),
            /*'Adresse (n° rue)' => new sfWidgetFormInput(),
            'Nom rue' => new sfWidgetFormInput(),
            'Rue' => new sfWidgetFormDoctrineChoice(array('model' => 'Rue', 'add_empty' => true, 'multiple' => true, 'expanded' => false)),
            'Découpage' => new sfWidgetFormDoctrineChoice(array('model' => 'Decoupage', 'add_empty' => true, 'multiple' => true, 'expanded' => false, 'default' => 4)),
            'Secteur' => new sfWidgetFormDoctrineChoice(array('model' => 'Secteur', 'add_empty' => true, 'multiple' => true, 'expanded' => false, 'default' => 12)),*/
            'Motif départ' => new sfWidgetFormChoice(array('choices' => array('' => '', 'Mutation' => 'Mutation', 'Départ commune' => 'Départ commune', 'Décès' => 'Décès'))),
            'Trier selon' => new sfWidgetFormChoice(array('choices' => array('' => '', 'nomNaissance' => 'Nom naissance', 'nomUsage' => 'Nom usage',
                                                            'prenoms' => 'Prénoms', 'titre' => 'Titre', 'sexe' => 'Sexe', 'dateNaissance' => 'Date de naissance',
                                                            'dateArchivage' => 'Date d\'archivage', 'id' => 'Id archive'))),
            'Ordre' => new sfWidgetFormChoice(array('choices' => array('' => '', 'ASC' => 'Croissant', 'DESC' => 'Décroissant')))
            
        ));

        $this->widgetSchema->setNameFormat('Recherche[%s]');

        $this->setValidators(array(
            'Nom naissance' => new sfValidatorString(),
            'Nom usage' => new sfValidatorString(),
            'Prénoms' => new sfValidatorString(),
            'Titre' => new sfValidatorString(),
            'Sexe' => new sfValidatorChoice(array('choices' => array(0 => '', 1 => 'Masculin', 2 => 'Féminin'), 'required' => false)),
            'Date naissance min' => new sfValidatorDate(),
            'Date naissance max' => new sfValidatorDate(),
            'Situation familiale' => new sfValidatorChoice(array('choices' => array(
                0 => '', 1 => 'Célibataire', 2 => 'Marié(e)', 3 => 'Veuf(ve)', 4 => 'Divorcé(e)',
                5 => 'Séparé(e)', 6 => 'Vie maritale', 7 => 'Pacsé(e)', 8 => 'Inconnue'), 'required' => false)),
            'Chef famille' => new sfValidatorChoice(array('choices' => array(
                0 => '', 1 => 'Oui', 2 => 'Non'), 'required' => false)),
            //'Profession' => new sfValidatorString(),
            'Ville naissance' => new sfValidatorString(),
            'Date archivage min' => new sfValidatorDate(),
            'Date archivage max' => new sfValidatorDate(),
            'Id archive' => new sfValidatorInteger(),
            /*'Adresse (n° rue)' => new sfValidatorInteger(),
            'Nom rue' => new sfValidatorString(),*/
            'Motif départ' => new sfValidatorChoice(array('choices' => array(0 => '', 1 => 'Mutation', 2 => 'Départ commune', 3 => 'Décès'), 'required' => false))
        ));


        $range = range('1900', date('Y') + 100);
        $shortRange = range('1900', date('Y'));


        $widgetDateDNMI = $this->widgetSchema['Date naissance min'] =
                new sfWidgetFormJQueryDate(array(
                    'image' => '/images/jquery-ui-images/calendar.gif',
                    'culture' => 'fr',
                    'date_widget' => new sfWidgetFormDate(array(
                        'format' => '%day%/%month%/%year%',
                        'years' => array_combine($range, $range)))
                ));

        $widgetDateDNMA = $this->widgetSchema['Date naissance max'] =
                new sfWidgetFormJQueryDate(array(
                    'image' => '/images/jquery-ui-images/calendar.gif',
                    'culture' => 'fr',
                    'date_widget' => new sfWidgetFormDate(array(
                        'format' => '%day%/%month%/%year%',
                        'years' => array_combine($range, $range)))
                ));

        $widgetDateDAMI = $this->widgetSchema['Date archivage min'] =
                new sfWidgetFormJQueryDate(array(
                    'image' => '/images/jquery-ui-images/calendar.gif',
                    'culture' => 'fr',
                    'date_widget' => new sfWidgetFormDate(array(
                        'format' => '%day%/%month%/%year%',
                        'years' => array_combine($shortRange, $shortRange)))
                ));

        $widgetDateDAMA = $this->widgetSchema['Date archivage max'] =
                new sfWidgetFormJQueryDate(array(
                    'image' => '/images/jquery-ui-images/calendar.gif',
                    'culture' => 'fr',
                    'date_widget' => new sfWidgetFormDate(array(
                        'format' => '%day%/%month%/%year%',
                        'years' => array_combine($shortRange, $shortRange)))
                ));

        $this->setDefault('Date archivage max', date('Y/m/d'));

        parent::setup();
    }

}
?>
