<?php

/**
 * troncon actions.
 *
 * @package    population
 * @subpackage troncon
 * @author     Flament Guillaume
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tronconActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->setCurrentPageToUser();
        $this->troncons = Doctrine_Core::getTable('Troncon')
                        ->createQuery('a')
                        ->execute();
    }

    public function executeShow(sfWebRequest $request) {
       $this->setCurrentPageToUser();
        $this->troncon = Doctrine_Core::getTable('Troncon')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->troncon);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new TronconForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new TronconForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($troncon = Doctrine_Core::getTable('Troncon')->find(array($request->getParameter('id'))), sprintf('Object troncon does not exist (%s).', $request->getParameter('id')));
        $this->form = new TronconForm($troncon);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($troncon = Doctrine_Core::getTable('Troncon')->find(array($request->getParameter('id'))), sprintf('Object troncon does not exist (%s).', $request->getParameter('id')));
        $this->form = new TronconForm($troncon);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($troncon = Doctrine_Core::getTable('Troncon')->find(array($request->getParameter('id'))), sprintf('Object troncon does not exist (%s).', $request->getParameter('id')));
        $troncon->delete();

        $this->redirect('troncon/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $troncon = $form->save();

            $this->redirect('troncon/show?id=' . $troncon->getId());
        }
    }
    
    public function setCurrentPageToUser() {
        // Définit l'url de la page courante à l'utilisateur afin de pouvoir rediriger celui-ci vers la page en question après login
        $this->getUser()->setAttribute('module', $this->moduleName);
        $this->getUser()->setAttribute('action', $this->actionName);
        $this->getUser()->setAttribute('param', $this->getRequestParameter('id'));
    }

}
