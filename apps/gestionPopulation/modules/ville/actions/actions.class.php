<?php

/**
 * ville actions.
 *
 * @package    population
 * @subpackage ville
 * @author     Flament Guillaume
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class villeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->villes = Doctrine_Core::getTable('Ville')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->ville = Doctrine_Core::getTable('Ville')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->ville);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new VilleForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new VilleForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ville = Doctrine_Core::getTable('Ville')->find(array($request->getParameter('id'))), sprintf('Object ville does not exist (%s).', $request->getParameter('id')));
    $this->form = new VilleForm($ville);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ville = Doctrine_Core::getTable('Ville')->find(array($request->getParameter('id'))), sprintf('Object ville does not exist (%s).', $request->getParameter('id')));
    $this->form = new VilleForm($ville);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ville = Doctrine_Core::getTable('Ville')->find(array($request->getParameter('id'))), sprintf('Object ville does not exist (%s).', $request->getParameter('id')));
    $ville->delete();

    $this->redirect('ville/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ville = $form->save();

      $this->redirect('ville/edit?id='.$ville->getId());
    }
  }
}
