<?php

/**
 * typeRue actions.
 *
 * @package    population
 * @subpackage typeRue
 * @author     Flament Guillaume
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class typeRueActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->type_rues = Doctrine_Core::getTable('TypeRue')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->type_rue = Doctrine_Core::getTable('TypeRue')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->type_rue);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TypeRueForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TypeRueForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($type_rue = Doctrine_Core::getTable('TypeRue')->find(array($request->getParameter('id'))), sprintf('Object type_rue does not exist (%s).', $request->getParameter('id')));
    $this->form = new TypeRueForm($type_rue);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($type_rue = Doctrine_Core::getTable('TypeRue')->find(array($request->getParameter('id'))), sprintf('Object type_rue does not exist (%s).', $request->getParameter('id')));
    $this->form = new TypeRueForm($type_rue);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($type_rue = Doctrine_Core::getTable('TypeRue')->find(array($request->getParameter('id'))), sprintf('Object type_rue does not exist (%s).', $request->getParameter('id')));
    $type_rue->delete();

    $this->redirect('typeRue/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $type_rue = $form->save();

      $this->redirect('typeRue/edit?id='.$type_rue->getId());
    }
  }
}
