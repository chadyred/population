<?php

/**
 * famille actions.
 *
 * @package    population
 * @subpackage famille
 * @author     Flament Guillaume
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class familleActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->setCurrentPageToUser();
        
        // Cration du pager avec la classe à utiliser et le nombre d'éléments à afficher par pages
        $this->famillesPager = new sfDoctrinePager('Famille', sfConfig::get('app_params_nb_to_display_per_page', 10));

        // Critère de tri
        if ($this->getRequestParameter("tri")){
            $this->tri = $this->getRequestParameter("tri");
            $this->ord = $this->getRequestParameter("ord");
        }
        
        
        // Filtre par logement
        if ($this->getRequestParameter("lgt")) {

            /* $this->familles = Doctrine_Core::getTable('Famille')
              ->createQuery('a')
              ->where('idLogement= ?', $this->getRequestParameter("lgt"))
              ->execute(); */

            $q = Doctrine_Core::getTable('Famille')->getFamillesByLogement($this->getRequestParameter("lgt"));

            //Récupération du logement correspondante à l'id passé en paramètre
            $logement = Doctrine_Core::getTable('Logement')
                            ->createQuery('b')
                            ->where('id = ?', $this->getRequestParameter("lgt"))
                            ->execute();
            $this->logement = $logement->getFirst();

            // Filtre par adresse
        } elseif ($this->getRequestParameter("adr")) {

            /* $this->familles = Doctrine_Query::create()
              ->select('f.*')
              ->from('famille f')
              ->leftjoin('f.Logement l')
              ->where('l.idAdresse =?', $this->getRequestParameter("adr"))
              ->execute(); */
            $q = Doctrine_Core::getTable('Famille')->getFamillesByAdresse($this->getRequestParameter("adr"));

            //Récupération de l'adresse correspondante à l'id passé en paramètre
            $adresse = Doctrine_Core::getTable('Adresse')
                            ->createQuery('c')
                            ->where('id = ?', $this->getRequestParameter("adr"))
                            ->execute();

            $this->adresse = $adresse->getFirst();


            /*             * *** Index par défaut **** */
        } else {

            // Définition de la requète à utiliser
            if(isset($this->tri)){
                $q = Doctrine_Core::getTable('Famille')->getFamillesSortedBy($this->tri,$this->ord);
            } else {
                $q = Doctrine_Core::getTable('Famille')->getFamillesSortedBy("id");
            }   
 
        }

        // Définition de la requète à utiliser
        $this->famillesPager->setQuery($q);

        // Première page à afficher
        $this->famillesPager->setPage($request->getParameter('page', 1));

        // Initialisation du pager
        $this->famillesPager->init();

        /* $this->familles = Doctrine_Core::getTable('Famille')
          ->createQuery('a')
          ->execute(); */
    }

    public function executeShow(sfWebRequest $request) {
        $this->setCurrentPageToUser();
        $this->famille = Doctrine_Core::getTable('Famille')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->famille);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new FamilleForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new FamilleForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($famille = Doctrine_Core::getTable('Famille')->find(array($request->getParameter('id'))), sprintf('Object famille does not exist (%s).', $request->getParameter('id')));
        $this->form = new FamilleForm($famille);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($famille = Doctrine_Core::getTable('Famille')->find(array($request->getParameter('id'))), sprintf('Object famille does not exist (%s).', $request->getParameter('id')));
        $this->form = new FamilleForm($famille);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($famille = Doctrine_Core::getTable('Famille')->find(array($request->getParameter('id'))), sprintf('Object famille does not exist (%s).', $request->getParameter('id')));
        $famille->delete();

        $this->redirect('famille/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $famille = $form->save();

            $this->redirect('famille/show?id=' . $famille->getId());
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
        $this->form = new SearchFamilleForm();
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
        $codeFamille = $recherche["Id (code famille)"] == "" ? "%" : $recherche["Id (code famille)"] ;
        $idLogement = $recherche["Id logement"] == "" ? "%" : $recherche["Id logement"] ;
        $numRue = $recherche["Adresse (n° rue)"] == "" ? "%" : $recherche["Adresse (n° rue)"] ;
        
        // Requète sql multi critères
        $q = Doctrine_Query::create()
                        ->select("f.*")
                        ->from("Famille f")
                        ->leftjoin('f.Logement l')
                        ->leftjoin('l.Adresse a')
                        ->leftjoin('a.Rue r')
                        ->where("f.id LIKE ?", $codeFamille)
                        ->andWhere("f.idlogement LIKE ?", $idLogement)
                        ->andWhere("f.infoscomplementaires LIKE ?", "%" . $recherche["Infos complementaires"] . "%")
                        ->andWhere("a.numerorue LIKE ?", $numRue)
                        ->andWhere("r.nom LIKE ?", "%" . $recherche["Nom rue"] . "%")
        ;

        // On conserve la recherche
        $this->RechercheEnCours = $recherche;


        // Cration du pager avec la classe à utiliser et le nombre d'éléments à afficher par pages
        $this->famillesPager = new sfDoctrinePager('Famille', sfConfig::get('app_params_nb_to_display_per_page', 10));

        // Définition de la requète à utiliser
        $this->famillesPager->setQuery($q);

        // Page à afficher - Affichage de la première si pas de param page
        $this->famillesPager->setPage($request->getParameter('page', 1));

        // Initialisation du pager
        $this->famillesPager->init();
    }
    
    
    /*     * ************************************************************************************************************** */
    /*     * **************************** C O D E   P O U R   L' A U T O C O M P L E T I O N ****************************** */
    /*     * ************************************************************************************************************** */
    
    /* Ajax call
     * @param sfWebRequest $request
     * @return Json array of matching City objects converted to string
     */

    public function executeGetLogements(sfWebRequest $request) {
        $q = $request->getParameter('q');

        $limit = $request->getParameter('limit');

        $logements = Doctrine::getTable('Logement')->createQuery("l")
                        ->leftJoin('l.Adresse a')
                        ->leftJoin('a.Rue r')
                        ->where('l.id LIKE ?', $q . '%')
                        ->orWhere('r.motdirecteur LIKE ?', $q . '%')
                        ->orderBy('LENGTH(l.id)')
                        ->orderBy('l.id')
                        //->limit($limit)   // est limité à 10 par défaut
                        ->execute();

        $list = array();
        foreach ($logements as $logement) {
            $list[$logement->getId()] = sprintf('n°%s -- %s', $logement->getId(), $logement->getAdresse());
        }

        return $this->renderText(json_encode($list));
    }

}
