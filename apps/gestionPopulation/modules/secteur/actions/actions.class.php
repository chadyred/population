<?php

/**
 * secteur actions.
 *
 * @package    population
 * @subpackage secteur
 * @author     Flament Guillaume
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class secteurActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->setCurrentPageToUser();
  /*      $this->secteurs = Doctrine_Core::getTable('Secteur')
                        ->createQuery('a')
                        ->execute(); */
        
        $this->secteurs = Doctrine_Core::getTable('Secteur')->findAll();
    }

    public function executeShow(sfWebRequest $request) {
        
        
           /*recup du nombre d'individu par secteur
                    /!\ methode sale
            * */
            
                  $con = Doctrine_Manager::getInstance()->connection();  
                     $sql = "SELECT count(i.id) as nb
                        FROM secteur s
                        INNER JOIN troncon t ON t.idsecteur = s.id
                        INNER JOIN rue r ON t.idrue = r.id
                        INNER JOIN adresse a ON a.idrue = r.id
                        INNER JOIN logement l ON l.idadresse = a.id
                        INNER JOIN famille f ON f.idlogement = l.id
                        INNER JOIN individu i ON i.idfamille = f.id
                        WHERE (
                        (
                        s.id =".$request->getParameter('id').
                        "  AND mod( a.numerorue, 2 ) =0
                        AND t.numdebutpair <= a.numerorue
                        AND t.numfinpair >= a.numerorue
                        )
                        OR (
                        s.id =".$request->getParameter('id').
                        " AND mod( a.numerorue, 2 ) != 0
                        AND t.numdebutimpair <= a.numerorue
                        AND t.numfinimpair >= a.numerorue
                        )
                        ) group by s.libelle";
        
                           $st = $con->execute($sql);
                     $this->nbIndividu = $st->fetch();
        //-------------------------------------------------------------------------
        
        $this->setCurrentPageToUser();
        $this->secteur = Doctrine_Core::getTable('Secteur')->find(array($request->getParameter('id')));
        
   
        $this->troncons = Doctrine_Core::getTable('Troncon')->getTronconsBySecteur($request->getParameter('id'));
        $this->forward404Unless($this->secteur);

    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new SecteurForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new SecteurForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($secteur = Doctrine_Core::getTable('Secteur')->find(array($request->getParameter('id'))), sprintf('Object secteur does not exist (%s).', $request->getParameter('id')));
        $this->form = new SecteurForm($secteur);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($secteur = Doctrine_Core::getTable('Secteur')->find(array($request->getParameter('id'))), sprintf('Object secteur does not exist (%s).', $request->getParameter('id')));
        $this->form = new SecteurForm($secteur);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($secteur = Doctrine_Core::getTable('Secteur')->find(array($request->getParameter('id'))), sprintf('Object secteur does not exist (%s).', $request->getParameter('id')));
        $secteur->delete();

        $this->redirect('secteur/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $secteur = $form->save();

            $this->redirect('secteur/show?id=' . $secteur->getId());
        }
    }
    
    public function setCurrentPageToUser() {
        // Définit l'url de la page courante à l'utilisateur afin de pouvoir rediriger celui-ci vers la page en question après login
        $this->getUser()->setAttribute('module', $this->moduleName);
        $this->getUser()->setAttribute('action', $this->actionName);
        $this->getUser()->setAttribute('param', $this->getRequestParameter('id'));
    }
    
        public function executeShowpersecteur(sfWebRequest $request)  {
        
                 //   $this->nomsecteur=$request->getParameter('nom');
                     $this->id=$request->getParameter('id');
                     
                     $con = Doctrine_Manager::getInstance()->connection();
                     
                        
                     $sql = "SELECT s.libelle, i.nomusage, i.prenoms as prenom, i.datenaissance, a.numerorue,l.valeurcomplement as complement, r.nom
                        FROM secteur s
                        INNER JOIN troncon t ON t.idsecteur = s.id
                        INNER JOIN rue r ON t.idrue = r.id
                        INNER JOIN adresse a ON a.idrue = r.id
                        INNER JOIN logement l ON l.idadresse = a.id
                        INNER JOIN famille f ON f.idlogement = l.id
                        INNER JOIN individu i ON i.idfamille = f.id
                        WHERE (
                        (
                        s.id =".$request->getParameter('id').
                        "  AND mod( a.numerorue, 2 ) =0
                        AND t.numdebutpair <= a.numerorue
                        AND t.numfinpair >= a.numerorue
                        )
                        OR (
                        s.id =".$request->getParameter('id').
                        " AND mod( a.numerorue, 2 ) != 0
                        AND t.numdebutimpair <= a.numerorue
                        AND t.numfinimpair >= a.numerorue
                        )
                        )";
                     
                     
                     $st = $con->execute($sql);
                     $this->resultat = $st->fetchAll();
               
                   
    }
    
    
    public function executeExportSecteurs(sfWebRequest $request) {

        
  /*          echo "Fonction encore non pris en charge";
        
        die;*/
   
        $date = date('y-m-d');

        // Execution de la requète
                   $con = Doctrine_Manager::getInstance()->connection();
                     
                        
                     $sql = "SELECT s.libelle, i.nomusage, i.prenoms as prenom, i.datenaissance, a.numerorue,l.valeurcomplement as complement, r.nom
                        FROM secteur s
                        INNER JOIN troncon t ON t.idsecteur = s.id
                        INNER JOIN rue r ON t.idrue = r.id
                        INNER JOIN adresse a ON a.idrue = r.id
                        INNER JOIN logement l ON l.idadresse = a.id
                        INNER JOIN famille f ON f.idlogement = l.id
                        INNER JOIN individu i ON i.idfamille = f.id
                        WHERE (
                        (
                        s.id =".$request->getParameter('id').
                        "  AND mod( a.numerorue, 2 ) =0
                        AND t.numdebutpair <= a.numerorue
                        AND t.numfinpair >= a.numerorue
                        )
                        OR (
                        s.id =".$request->getParameter('id').
                        " AND mod( a.numerorue, 2 ) != 0
                        AND t.numdebutimpair <= a.numerorue
                        AND t.numfinimpair >= a.numerorue
                        )
                        )";
                     
                     
                     $st = $con->execute($sql);
                     
              
                    $resultat = $st->fetchAll();

        // Met le résultat de la requète sous forme d'un tableau
        $arrayIndiv = $resultat;

        $i = 0;
        foreach ($resultat as $resultat) {
            $arrayIndiv[$i]["nom"] = $resultat['nomusage'];
            $arrayIndiv[$i]["prenom"] = $resultat['prenom'];
            $arrayIndiv[$i]["dateNaissance"] = date("d/m/Y", strtotime($resultat['datenaissance']));
            $arrayIndiv[$i]["num"] = $resultat['numerorue'];
            $arrayIndiv[$i]["complement"] =$resultat['complement'];
            $arrayIndiv[$i]["rue"]=$resultat['nom'];

            $i++;
        }


        // Création du document
        $doc = new sfTinyDoc();

        // Si le document est un ods (spreadsheet)
        $doc->createFrom(array('extension' => 'ods'));
        
        // Chargement du contenu du fichier (content.xml) pour pouvoir effectuer des modifications
        $doc->loadXml('content.xml');

        // Remplissage des champs du document
        $doc->mergeXmlBlock("block1", $arrayIndiv);

        // Sauvegarde et fermeture du document
        $doc->saveXml();
        $doc->close();

        // Envoi du document et suppression du répertoire temporaire
        $doc->sendResponse(array('filename' => 'Extraction_IndividusParSecteur_' . $date . '.ods'));
        $doc->remove();

        //throw new sfStopException;
    }
    

}
