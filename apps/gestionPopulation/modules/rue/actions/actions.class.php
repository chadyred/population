<?php

/**
 * rue actions.
 *
 * @package    population
 * @subpackage rue
 * @author     Flament Guillaume
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class rueActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->setCurrentPageToUser();

        // Cration du pager avec la classe à utiliser et le nombre d'éléments à afficher par pages
        $this->ruesPager = new sfDoctrinePager('Rue', sfConfig::get('app_params_nb_to_display_per_page', 10));

        // Filtre par adresse
        if ($this->getRequestParameter("typ")) {
            /*$this->logements = Doctrine_Core::getTable('Logement')
                            ->createQuery('a')
                            ->where('idAdresse = ?', $this->getRequestParameter("adr"))
                            ->execute();*/

            $q = Doctrine_Core::getTable('Rue')->getRuesByTypeRue($this->getRequestParameter("typ"));

            //Récupération du type rue correspondant à l'id passé en paramètre
            $typeRue = Doctrine_Core::getTable('TypeRue')
                            ->createQuery('tr')
                            ->where('id = ?', $this->getRequestParameter("typ"))
                            ->execute();
            $this->typeRue = $typeRue->getFirst();

        } else {
            /*$this->rues = Doctrine_Core::getTable('Rue')
                        ->createQuery('a')
                        ->execute();*/

            // Définition de la requète à utiliser
            $q = Doctrine_Core::getTable('Rue')->getRuesSortedById();
        }

        // Définition de la requète
        $this->ruesPager->setQuery($q);

        // Page à afficher - Affichage de la première si pas de param page
        $this->ruesPager->setPage($request->getParameter('page', 1));

        // Initialisation du pager
        $this->ruesPager->init();

    }

    public function executeShow(sfWebRequest $request) {
        $this->setCurrentPageToUser();
        $this->rue = Doctrine_Core::getTable('Rue')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->rue);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new RueForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new RueForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($rue = Doctrine_Core::getTable('Rue')->find(array($request->getParameter('id'))), sprintf('Object rue does not exist (%s).', $request->getParameter('id')));
        $this->form = new RueForm($rue);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($rue = Doctrine_Core::getTable('Rue')->find(array($request->getParameter('id'))), sprintf('Object rue does not exist (%s).', $request->getParameter('id')));
        $this->form = new RueForm($rue);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($rue = Doctrine_Core::getTable('Rue')->find(array($request->getParameter('id'))), sprintf('Object rue does not exist (%s).', $request->getParameter('id')));
        $rue->delete();

        $this->redirect('rue/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            
            if ($form->getObject()->isNew()) {
                $this->getUser()->setFlash('lastAction', 'Rue créé avec succès');
            } else {
                $this->getUser()->setFlash('lastAction', 'Rue modifiée avec succès');
            }
            
            $rue = $form->save();

            $this->redirect('rue/show?id=' . $rue->getId());
        }
    }
    
    public function setCurrentPageToUser() {
        // Définit l'url de la page courante à l'utilisateur afin de pouvoir rediriger celui-ci vers la page en question après login
        $this->getUser()->setAttribute('module', $this->moduleName);
        $this->getUser()->setAttribute('action', $this->actionName);
        $this->getUser()->setAttribute('param', $this->getRequestParameter('id'));
    }

}
