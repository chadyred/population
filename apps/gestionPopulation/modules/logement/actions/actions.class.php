<?php

/**
 * logement actions.
 *
 * @package    population
 * @subpackage logement
 * @author     Flament Guillaume
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class logementActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->setCurrentPageToUser();

        // Cration du pager avec la classe à utiliser et le nombre d'éléments à afficher par pages
        $this->logementsPager = new sfDoctrinePager('Logement', sfConfig::get('app_params_nb_to_display_per_page', 12));

        // Filtre par adresse
        if ($this->getRequestParameter("adr")) {
            /*$this->logements = Doctrine_Core::getTable('Logement')
                            ->createQuery('a')
                            ->where('idAdresse = ?', $this->getRequestParameter("adr"))
                            ->execute();*/

            $q = Doctrine_Core::getTable('Logement')->getLogementsByAdresse($this->getRequestParameter("adr"));

            //Récupération du nom de l'adresse correspondante à l'id passé en paramètre
            $adresse = Doctrine_Core::getTable('Adresse')
                            ->createQuery('b')
                            ->where('id = ?', $this->getRequestParameter("adr"))
                            ->execute();
            $this->adresse = $adresse->getFirst();
            
        } else {
            /*$this->logements = Doctrine_Core::getTable('Logement')
                            ->createQuery('a')
                            ->execute();*/
            
            // Définition de la requète à utiliser
            $q = Doctrine_Core::getTable('Logement')->getLogementsSortedById();
        }

        // Définition de la requète
        $this->logementsPager->setQuery($q);

        // Page à afficher - Affichage de la première si pas de param page
        $this->logementsPager->setPage($request->getParameter('page', 1));

        // Initialisation du pager
        $this->logementsPager->init();
    }

    public function executeShow(sfWebRequest $request) {
        $this->setCurrentPageToUser();
        $this->logement = Doctrine_Core::getTable('Logement')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->logement);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new LogementForm();
        $this->form->setDefault('idAdresse', $request->getParameter('adr'));
        $this->adresse = Doctrine_Core::getTable('Adresse')->find(array($request->getParameter('adr')));
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new LogementForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($logement = Doctrine_Core::getTable('Logement')->find(array($request->getParameter('id'))), sprintf('Object logement does not exist (%s).', $request->getParameter('id')));
        $this->form = new LogementForm($logement);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($logement = Doctrine_Core::getTable('Logement')->find(array($request->getParameter('id'))), sprintf('Object logement does not exist (%s).', $request->getParameter('id')));
        $this->form = new LogementForm($logement);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($logement = Doctrine_Core::getTable('Logement')->find(array($request->getParameter('id'))), sprintf('Object logement does not exist (%s).', $request->getParameter('id')));
        $logement->delete();

        $this->redirect('logement/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $logement = $form->save();

            $this->redirect('logement/show?id=' . $logement->getId());
        }
    }

    public function setCurrentPageToUser() {
        // Définit l'url de la page courante à l'utilisateur afin de pouvoir rediriger celui-ci vers la page en question après login
        $this->getUser()->setAttribute('module', $this->moduleName);
        $this->getUser()->setAttribute('action', $this->actionName);
        $this->getUser()->setAttribute('param', $this->getRequestParameter('id'));
    }
    
    public function executeSearch(sfWebRequest $request) {
        // Création et affichage du formulaire de recherche
        $this->form = new SearchLogementForm();
    }

    public function executeResult(sfWebRequest $request) {
        // Pour que l'affichage des resultats soit correct, il faut stocker
        // les informations saisies dans le formulaire de recherche.
        // Pour cela on test si une pagination est nécessaire
        if (!$request->hasParameter("page")) {
            // Si non, on recupère le parametre envoyé par le formulaire
            $recherche = $request->getParameter("Recherche");
            // et on stock ce parametre dans un attribut flash de l'utilisateur
            $this->getUser()->setAttribute('RechercheEnCours', $recherche);
        } else {
            // Si une pagination est demandée, cela signifi que l'affichage des premiers
            // résultats à déja été effectué, et que la requète ne contient plus les infos
            // du formulaire de recherche. On les récupère donc dans l'attribut flash stocké dans notre user.
            $recherche = $this->getUser()->getAttribute('RechercheEnCours');
        }

        // Variables pour la requète
        $idLogement = $recherche["Id logement"] == "" ? "%" : $recherche["Id logement"] ;
        $numRue = $recherche["Adresse (n° rue)"] == "" ? "%" : $recherche["Adresse (n° rue)"] ;
        
        $crietereTri = $recherche["Trier selon"] == "" ? "" : $recherche["Trier selon"];
        $ordre = $recherche["Ordre"] == "" ? "ASC" : $recherche["Ordre"];

        
        // Requète sql multi critères
        $q = Doctrine_Query::create()
                        ->select("l.*")
                        ->from("Logement l")
                        ->leftjoin('l.Adresse a')
                        ->leftjoin('a.Rue r')
                        ->where("l.id LIKE ?", $idLogement)
                        ->andWhere("a.numerorue LIKE ?", $numRue)
                        ->andWhere("r.nom LIKE ?", "%" . $recherche["Nom rue"] . "%")
        ;
        
        if ($crietereTri != "") {
            $q->orderBy($crietereTri . " " .$ordre);
        }

        // On conserve la recherche
        $this->RechercheEnCours = $recherche;


        // Cration du pager avec la classe à utiliser et le nombre d'éléments à afficher par pages
        $this->logementsPager = new sfDoctrinePager('Logement', sfConfig::get('app_params_nb_to_display_per_page', 10));

        // Définition de la requète à utiliser
        $this->logementsPager->setQuery($q);

        // Page à afficher - Affichage de la première si pas de param page
        $this->logementsPager->setPage($request->getParameter('page', 1));

        // Initialisation du pager
        $this->logementsPager->init();
    }

}
