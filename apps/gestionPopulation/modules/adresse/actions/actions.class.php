<?php

/**
 * adresse actions.
 *
 * @package    population
 * @subpackage adresse
 * @author     Flament Guillaume
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adresseActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->setCurrentPageToUser();

        // Cration du pager avec la classe à utiliser et le nombre d'éléments à afficher par pages
        $this->adressesPager = new sfDoctrinePager('Adresse', sfConfig::get('app_params_nb_to_display_per_page', 10));


        // Filtre par rue
        if ($this->getRequestParameter("rue")) {
            /*$this->adresses = Doctrine_Core::getTable('Adresse')
                            ->createQuery('a')
                            ->where('idRue= ?', $this->getRequestParameter("rue"))
                            ->execute();*/
            $q = Doctrine_Core::getTable('Adresse')->getAdressesByRue($this->getRequestParameter("rue"));

            //Récupération du nom de la rue correspondante à l'id passé en paramètre
            $rue = Doctrine_Core::getTable('Rue')
                            ->createQuery('b')
                            ->where('id = ?', $this->getRequestParameter("rue"))
                            ->execute();
            $this->rue = $rue->getFirst();

        } else {
            /*$this->adresses = Doctrine_Core::getTable('Adresse')
                            ->createQuery('a')
                            ->execute();*/

            // Définition de la requète
            $q = Doctrine_Core::getTable('Adresse')->getAdressesSortedById();
        }

        // Définition de la requète à utiliser
        $this->adressesPager->setQuery($q);

        // Première page à afficher
        $this->adressesPager->setPage($request->getParameter('page', 1));

        // Initialisation du pager
        $this->adressesPager->init();

    }

    public function executeShow(sfWebRequest $request) {
        $this->setCurrentPageToUser();
        $this->adresse = Doctrine_Core::getTable('Adresse')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->adresse);
//    $this->getUser()->setFlash("lastAction", "Nombre max de logements atteint!");
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new AdresseForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new AdresseForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($adresse = Doctrine_Core::getTable('Adresse')->find(array($request->getParameter('id'))), sprintf('Object adresse does not exist (%s).', $request->getParameter('id')));
        $this->form = new AdresseForm($adresse);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($adresse = Doctrine_Core::getTable('Adresse')->find(array($request->getParameter('id'))), sprintf('Object adresse does not exist (%s).', $request->getParameter('id')));
        $this->form = new AdresseForm($adresse);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($adresse = Doctrine_Core::getTable('Adresse')->find(array($request->getParameter('id'))), sprintf('Object adresse does not exist (%s).', $request->getParameter('id')));
        $adresse->delete();

        $this->redirect('adresse/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $adresse = $form->save();

            $this->redirect('adresse/show?id=' . $adresse->getId());
        }
    }
    
    public function setCurrentPageToUser() {
        // Définit l'url de la page courante à l'utilisateur afin de pouvoir rediriger celui-ci vers la page en question après login
        $this->getUser()->setAttribute('module', $this->moduleName);
        $this->getUser()->setAttribute('action', $this->actionName);
        $this->getUser()->setAttribute('param', $this->getRequestParameter('id'));
    }
    
        public function executeSearch(sfWebRequest $request) {
              $this->form = new SearchAdresseForm();
 
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
                   }
                   else
                   {
                         // Si une pagination est demandée, cela signifi que l'affichage des premiers
                        // résultats à déja été effectué, et que la requète ne contient plus les infos
                        // du formulaire de recherche. On les récupère donc dans l'attribut flash stocké dans notre user.
                        $recherche = $this->getUser()->getAttribute('RechercheEnCours');
                   }
                   
                   
                    // Variables pour la requète
                 
                   //Si $recherche[".."] a une valeur null alors $..=% sinon $..=$recherche[".."]
                     $id = $recherche["Id"] == "" ? "'%'" : $recherche["Id"] ;
                     $numRue = $recherche["Numero rue"] == "" ? "'%'" : $recherche["Numero rue"] ;
                     $complement = $recherche["Complement"] == "" ? "'%'" : "'%".$recherche["Complement"]."%'" ;
                     $rue = $recherche["Rue"] == "" ? "'%'" : "'%".$recherche["Rue"]."%'" ;    
                     $nbLogementsMax= $recherche["Nb logements max"] == "" ? "'%'" : $recherche["Nb logements max"] ;    
                     $nbLogementsOccup= $recherche["Nb logements occupés"] == "" ? "'%'" : $recherche["Nb logements occupés"] ;  
                     $nbLogementsVide= $recherche["Nb logements vides"] == "" ? "'%'" : $recherche["Nb logements vides"] ;  
                     
                     
                     $this->setCurrentPageToUser();

                     
          /*   $q = Doctrine_Query::create()
                          ->select("a.id,a.numerorue,a.complement,a.nblogementsmax,count(f.id),(a.nblogementsmax-COUNT(f.id)) as logvide")
                          ->from("Adresse a, Rue r,famille f")
                          ->leftJoin("f.Logement add")
                          ->where("add.id=f.idlogement")
                          ->andwhere("a.idrue=r.id")
                          ->andWhere("a.id=add.idadresse")
                          ->andwhere("a.id LIKE ?",$id)
                          ->andwhere("a.numerorue LIKE ?",$numRue)
                          ->andwhere("a.complement LIKE ?",$complement)
                          ->andwhere("r.nom LIKE ?","%".$rue."%")
                          ->andwhere('a.nblogementsmax LIKE ?',$nbLogementsMax)
                          ->groupBy("add.idadresse")
                          ->having('COUNT(f.id) LIKE ?',$nbLogementsOccup)
                         ->addHaving("logvide LIKE ?",$nbLogementsVide)
                          ;*/
                     
                     $con = Doctrine_Manager::getInstance()->connection();
                     $sql = "SELECT ad.id AS adresse, ad.numerorue AS num, ad.complement, r.nom, ad.nblogementsmax AS nbmax, count( f.id ) AS nblo, (
                            count( lg.id ) - count( f.id )
                            ) AS nblogno
                            FROM logement lg
                            RIGHT JOIN adresse ad ON ad.id = lg.idadresse
                            LEFT JOIN famille f ON f.idlogement = lg.id
                            JOIN rue r
                            WHERE ad.idrue = r.id
                            and ad.id LIKE $id
                            and ad.numerorue LIKE $numRue
                            and ad.complement LIKE $complement
                            and r.nom LIKE $rue
                            and ad.nblogementsmax LIKE $nbLogementsMax
                            GROUP BY ad.id
                            having COUNT(f.id) LIKE $nbLogementsOccup AND nblogno LIKE $nbLogementsVide
                            ORDER BY `ad`.`id` ASC";
                     $st = $con->execute($sql);
                     
              
                    $this->resultat = $st->fetchAll();
                    
                     
                     
     /*                
                              La requête  recalcul toute les informations affichés dans l'affichage basique afin de pouvoir filtrer sur chacun 
                       des critères énoncés, l'équivalent sql de l'affichage général des adresses est affiché ci dessous !
                       Les where est les Having permettre de gérer le filtrage via le formulaire
                        
        SELECT ad.id AS adresse, ad.numerorue AS num, ad.complement, r.nom, ad.nblogementsmax AS nbmax, count( f.id ) AS nblo, (
        count( lg.id ) - count( f.id )
        ) AS nblogno
        FROM logement lg
        RIGHT JOIN adresse ad ON ad.id = lg.idadresse
        LEFT JOIN famille f ON f.idlogement = lg.id
        JOIN rue r
        WHERE ad.idrue = r.id
        GROUP BY ad.id
        ORDER BY `ad`.`id` ASC
        LIMIT 2280 , 30
     */
    
                   
         }
        
    

}
