<?php

/**
 * decoupage actions.
 *
 * @package    population
 * @subpackage decoupage
 * @author     Flament Guillaume
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class decoupageActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->decoupages = Doctrine_Core::getTable('Decoupage')
                        ->createQuery('a')
                        ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->setCurrentPageToUser();
        $this->decoupage = Doctrine_Core::getTable('Decoupage')->find(array($request->getParameter('id')));

        $req = "SELECT DISTINCT * FROM rue r
          WHERE r.id IN (
                SELECT idrue FROM troncon t
                WHERE t.idsecteur IN (
                    SELECT id FROM secteur s
                    WHERE s.iddecoupage = " . $request->getParameter('id') . "))";

        // get Doctrine_Connection object
        $con = Doctrine_Manager::getInstance()->connection();
        // execute SQL query, receive Doctrine_Connection_Statement
        $st = $con->execute($req);
        // fetch query result
        $this->rues = $st->fetchObject();

        $this->forward404Unless($this->decoupage);
        
        
     /*recup avec les rues*/   
       $con2 = Doctrine_Manager::getInstance()->connection();
        $req2="
        SELECT r.motdirecteur as motd, r.nom as nom, s.libelle as lib, t.numdebutpair as ndp, t.numfinpair as nfp, t.numdebutimpair as ndi, t.numfinimpair as nfi
        FROM decoupage d
        INNER JOIN secteur s ON d.id = s.iddecoupage
        INNER JOIN troncon t ON s.id = t.idsecteur
        INNER JOIN rue r ON t.idrue = r.id
        WHERE d.id =" . $request->getParameter('id') . "
        ORDER BY `r`.`motdirecteur` ASC";

        $st2 = $con2->execute($req2);
        $this->decoup = $st2->fetchAll();

    /*  foreach ($this->decoup as $decoup):
             echo $decoup['motd'];
               echo $decoup['nom'] ;
                 echo $decoup['lib'];
     endforeach; 
        */
   //     die;
               
    /*----------------------------------*/    
        
        
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new DecoupageForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new DecoupageForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($decoupage = Doctrine_Core::getTable('Decoupage')->find(array($request->getParameter('id'))), sprintf('Object decoupage does not exist (%s).', $request->getParameter('id')));
        $this->form = new DecoupageForm($decoupage);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($decoupage = Doctrine_Core::getTable('Decoupage')->find(array($request->getParameter('id'))), sprintf('Object decoupage does not exist (%s).', $request->getParameter('id')));
        $this->form = new DecoupageForm($decoupage);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($decoupage = Doctrine_Core::getTable('Decoupage')->find(array($request->getParameter('id'))), sprintf('Object decoupage does not exist (%s).', $request->getParameter('id')));
        $decoupage->delete();

        $this->redirect('decoupage/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $decoupage = $form->save();

            $this->redirect('decoupage/show?id=' . $decoupage->getId());
        }
    }
    
    public function setCurrentPageToUser() {
        // Définit l'url de la page courante à l'utilisateur afin de pouvoir rediriger celui-ci vers la page en question après login
        $this->getUser()->setAttribute('module', $this->moduleName);
        $this->getUser()->setAttribute('action', $this->actionName);
        $this->getUser()->setAttribute('param', $this->getRequestParameter('id'));
    }
    
    
    
    public function executeExportDecoupageSecteur(sfWebRequest $request) {
        
        
 
           
        $date = date('y-m-d');

    
        
        $con = Doctrine_Manager::getInstance()->connection();
        $sql="
        SELECT r.motdirecteur as motd, r.nom as nom, s.libelle as lib, t.numdebutpair as ndp, t.numfinpair as nfp, t.numdebutimpair as ndi, t.numfinimpair as nfi
        FROM decoupage d
        INNER JOIN secteur s ON d.id = s.iddecoupage
        INNER JOIN troncon t ON s.id = t.idsecteur
        INNER JOIN rue r ON t.idrue = r.id
        WHERE d.id =" . $request->getParameter('id') . "
        ORDER BY `r`.`motdirecteur` ASC";
        
       $st = $con->execute($sql);
                     
              
        $resultat = $st->fetchAll();

        // Met le résultat de la requète sous forme d'un tableau
        $arrayIndiv = $resultat;

        $i = 0;
        foreach ($resultat as $resultat) {
            $arrayIndiv[$i]["motd"] = $resultat['motd'];
            $arrayIndiv[$i]["nom"] = $resultat['nom'];
            $arrayIndiv[$i]["lib"] = $resultat['lib'];
            $arrayIndiv[$i]["ndp"] =$resultat['ndp'];
            $arrayIndiv[$i]["nfp"]=$resultat['nfp'];
            $arrayIndiv[$i]["ndi"]=$resultat['ndi'];
            $arrayIndiv[$i]["nfi"]=$resultat['nfi'];
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
        $doc->sendResponse(array('filename' => 'Extraction_SecteurParDecoupage_' . $date . '.ods'));
        $doc->remove();
        
    }

}
