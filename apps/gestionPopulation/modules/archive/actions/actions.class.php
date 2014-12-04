<?php

/**
 * archive actions.
 *
 * @package    population
 * @subpackage archive
 * @author     Flament Guillaume
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class archiveActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {

        $this->setCurrentPageToUser();

        // Cration du pager avec la classe à utiliser et le nombre d'éléments à afficher par pages
        $this->archivesPager = new sfDoctrinePager('Archive', sfConfig::get('app_params_nb_to_display_per_page', 10));


        // Filtre par motif
        if ($this->getRequestParameter("motif")) {
            $m = $this->getRequestParameter("motif");
            switch ($m){
                case 'dc' :
                    $motif = "Départ commune";
                    break;
                case 'd' : 
                    $motif = "Décès";
                    break;
                case 'm' : 
                    $motif = "Mutation";
                    break;
            }
            
            $q = Doctrine_Core::getTable('Archive')->getArchivesByMotif($motif);
            $this->motif = $motif;

        } else {
            $q = Doctrine_Core::getTable('Archive')->getArchivesSortedById();
        }

        // Définition de la requète à utiliser
        $this->archivesPager->setQuery($q);

        // Première page à afficher
        $this->archivesPager->setPage($request->getParameter('page', 1));

        // Initialisation du pager
        $this->archivesPager->init();

        /* $this->archives = Doctrine_Core::getTable('Archive')
          ->createQuery('a')
          ->execute(); */
    }

    public function executeShow(sfWebRequest $request) {
        $this->setCurrentPageToUser();
        $this->archive = Doctrine_Core::getTable('Archive')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->archive);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new ArchiveForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new ArchiveForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($archive = Doctrine_Core::getTable('Archive')->find(array($request->getParameter('id'))), sprintf('Object archive does not exist (%s).', $request->getParameter('id')));
        $this->form = new ArchiveForm($archive);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($archive = Doctrine_Core::getTable('Archive')->find(array($request->getParameter('id'))), sprintf('Object archive does not exist (%s).', $request->getParameter('id')));
        $this->form = new ArchiveForm($archive);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($archive = Doctrine_Core::getTable('Archive')->find(array($request->getParameter('id'))), sprintf('Object archive does not exist (%s).', $request->getParameter('id')));
        $archive->delete();

        $this->redirect('archive/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $archive = $form->save();

            $this->redirect('archive/edit?id=' . $archive->getId());
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
        $this->form = new SearchArchiveForm();
    }

    public function executeResult(sfWebRequest $request) {
        // Pour que l'affichage des resultats soit correct, il faut stocker
        // les informations saisies dans le formulaire de recherche.
        // Pour cela on test si une pagination est necessaire
        if (!$request->hasParameter("page")) {
            // Si non, on recupère le parametre envoyer par le formulaire
            $recherche = $request->getParameter("Recherche");
            // et on stock ce parametre dans un attribut flash de l'utilisateur
            $this->getUser()->setAttribute('RechercheEnCours', $recherche);
        } else {
            // Si une pagination est demandée, cela signifie que l'affichage des premiers
            // résultats à déja été effectué, et que la requète ne contient plus les infos
            // du formulaire de recherche. On les récupère donc dans l'attribut flash stocké dans l'utilisateur.
            $recherche = $this->getUser()->getAttribute('RechercheEnCours');
        }

        // Initialisation de la requète avec les différents paramètres de la recherche
        $q = $this->initQuery($recherche);

        // La recherche est conservée pour l'export éventuel des données
        $this->getUser()->setAttribute('resultQuery', $q);

        // Cration du pager avec la classe à utiliser et le nombre d'éléments à afficher par pages
        $this->archivesPager = new sfDoctrinePager('Archive', sfConfig::get('app_params_nb_to_display_per_page', 10));

        // Définition de la requète à utiliser
        $this->archivesPager->setQuery($q);

        // Page à afficher - Affichage de la première si pas de param page
        $this->archivesPager->setPage($request->getParameter('page', 1));

        // Initialisation du pager
        $this->archivesPager->init();
    }
    
    
    /*     * ************************************************************************************************************** */
    /*     * ********************** C O D E   P O U R   L' E X T R A C T I O N   D E   D O N N E E S ********************** */
    /*     * ************************************************************************************************************** */

    public function executeExportArchives(sfWebRequest $request) {

        $date = date('y-m-d');

        // Execution de la requète
        $archives = $this->initQuery($this->getUser()->getAttribute('RechercheEnCours'))->execute();

        // Met le résultat de la requète sous forme d'un tableau
        $arrayArch = $archives->toArray();

        $i = 0;
        foreach ($archives as $archive) {
            $arrayIndiv[$i]["id"] = $archive->getId();
            $arrayIndiv[$i]["nomNaissance"] = $archive->getNomNaissance();
            $arrayIndiv[$i]["nomUsage"] = $archive->getNomNaissance();
            $arrayIndiv[$i]["prenoms"] = $archive->getPrenoms();
            $arrayIndiv[$i]["dateNaissance"] = date("d/m/Y", strtotime($archive->getDateNaissance()));
            $arrayIndiv[$i]["dateArchivage"] = date("d/m/Y", strtotime($archive->getDateArchivage()));
            $arrayIndiv[$i]["idVilleNaissance"] = $archive->getVilleNaissance()->getVille();
            /*$arrayIndiv[$i]["motif"] = $archive->getMotifDepart();
            $arrayIndiv[$i]["villeNaissance"] = $archive->getVilleNaissance();*/
            $arrayIndiv[$i]["ancAdresse"] = $archive->getNumeroRueAnt() . " " . $archive->getComplementNumAnt() . " " . $archive->getTypeRueAnt() . " " . $archive->getNomRueAnt();
            
            $arrayIndiv[$i]["nvleAdresse"] = $archive->getNumeroRuePost() . " " . $archive->getComplementNumPost() . " " . $archive->getTypeRuePost() . " " . $archive->getNomRuePost();
            
            $arrayIndiv[$i]["nomRueAnt"] = $archive->getNumeroRueAnt() . " " . $archive->getComplementNumAnt() . " " . $archive->getTypeRueAnt() . " " . $archive->getNomRueAnt();
            $arrayIndiv[$i]["nomRuePost"] = $archive->getNumeroRuePost() . " " . $archive->getComplementNumPost() . " " . $archive->getTypeRuePost() . " " . $archive->getNomRuePost();
            $i++;
        }


        // Création du document
        $doc = new sfTinyDoc();

        // Si le document est un ods (spreadsheet)
        $doc->createFrom(array('extension' => 'ods'));
        
        // Chargement du contenu du fichier (content.xml) pour pouvoir effectuer des modifications
        $doc->loadXml('content.xml');

        // Remplissage des champs du document
        $doc->mergeXmlBlock("block1", $arrayArch);

        // Sauvegarde et fermeture du document
        $doc->saveXml();
        $doc->close();

        // Envoi du document et suppression du répertoire temporaire
        $date = date('d-m-Y');
        $doc->sendResponse(array('filename' => 'Extraction_Archives_' . $date . '.ods'));
        $doc->remove();

      //  throw new sfStopException;
    }


    // Cette fonction prend en paramètre un résultat de recherche et renvoie la requète qui prend en compte les paramètres reçus
    private function initQuery($recherche) {
        
        // Variables pour la requète
        //$codeFamille = $recherche["Code famille"] == "" ? "%" : $recherche["Code famille"];
        $idArchive = $recherche["Id archive"] == "" ? "%" : $recherche["Id archive"];
        $villeNaiss = $recherche["Ville naissance"] == "" ? "%" : $recherche["Ville naissance"];
        //$numRue = $recherche["Adresse (n° rue)"] == "" ? "%" : $recherche["Adresse (n° rue)"];

        //$rue = $recherche["Rue"] == "" ? "" : $recherche["Rue"];
        //$secteur = $recherche["Secteur"] == "" ? "" : $recherche["Secteur"];
        //$decoupage = $recherche["Découpage"] == "" ? "" : $recherche["Découpage"];

        $DNaissMin = $recherche["Date naissance min"]["day"] == "" ? "1" : $recherche["Date naissance min"]["day"];
        $MNaissMin = $recherche["Date naissance min"]["month"] == "" ? "1" : $recherche["Date naissance min"]["month"];
        $YNaissMin = $recherche["Date naissance min"]["year"] == "" ? "1900" : $recherche["Date naissance min"]["year"];
        $DNaissMax = $recherche["Date naissance max"]["day"] == "" ? "1" : $recherche["Date naissance max"]["day"];
        $MNaissMax = $recherche["Date naissance max"]["month"] == "" ? "1" : $recherche["Date naissance max"]["month"];
        $YNaissMax = $recherche["Date naissance max"]["year"] == "" ? "2100" : $recherche["Date naissance max"]["year"];

        $DArchivMin = $recherche["Date archivage min"]["day"] == "" ? "1" : $recherche["Date archivage min"]["day"];
        $MArchivMin = $recherche["Date archivage min"]["month"] == "" ? "1" : $recherche["Date archivage min"]["month"];
        $YArchivMin = $recherche["Date archivage min"]["year"] == "" ? "1900" : $recherche["Date archivage min"]["year"];
        $DArchivMax = $recherche["Date archivage max"]["day"]; // Initialisé à la date courante dans le formulaire
        $MArchivMax = $recherche["Date archivage max"]["month"]; // Initialisé à la date courante dans le formulaire
        $YArchivMax = $recherche["Date archivage max"]["year"]; // Initialisé à la date courante dans le formulaire

        $dateNaissMin = $YNaissMin . "-" . $MNaissMin . "-" . $DNaissMin;
        $dateNaissMax = $YNaissMax . "-" . $MNaissMax . "-" . $DNaissMax;
        $dateArchivageMin = $YArchivMin . "-" . $MArchivMin . "-" . $DArchivMin;
        $dateArchivageMax = $YArchivMax . "-" . $MArchivMax . "-" . $DArchivMax;
        
        $crietereTri = $recherche["Trier selon"] == "" ? "" : $recherche["Trier selon"];
        $ordre = $recherche["Ordre"] == "" ? "ASC" : $recherche["Ordre"];

        /*$rues = "";
        foreach ($rue as $cle => $valeur) {
            if ($rues == "") {
                $rues = $valeur;
            } else {
                $rues = $rues . "," . $valeur;
            }
        }

        $secteurs = "";
        foreach ($secteur as $cle => $valeur) {
            if ($secteurs == "") {
                $secteurs = $valeur;
            } else {
                $secteurs = $secteurs . "," . $valeur;
            }
        }

        $decoupages = "";
        foreach ($decoupage as $cle => $valeur) {
            if ($decoupages == "") {
                $decoupages = $valeur;
            } else {
                $decoupages = $decoupages . "," . $valeur;
            }
        }*/


        // Requète sql multi critères
        $q = Doctrine_Query::create()
                        ->select("*")
                        ->from("Archive a")
                        /*->leftJoin('i.Famille f')
                        ->leftjoin('f.Logement l')
                        ->leftjoin('l.Adresse a')
                        ->leftjoin('a.Rue r')
                        ->leftjoin('r.Troncons t')
                        ->leftjoin('t.Secteur s')
                        ->leftjoin('s.Decoupage d')*/
                        ->where("a.nomnaissance LIKE ?", "%" . $recherche["Nom naissance"] . "%")
                        ->andWhere("a.nomusage LIKE ?", "%" . $recherche["Nom usage"] . "%")
                        ->andWhere("a.prenoms LIKE ?", "%" . $recherche["Prénoms"] . "%")
                        ->andWhere("a.titre LIKE ?", "%" . $recherche["Titre"] . "%")
                        ->andWhere("a.sexe LIKE ?", "%" . $recherche["Sexe"] . "%")
                        ->andWhere("a.situationFamiliale LIKE ?", "%" . $recherche["Situation familiale"] . "%")
                        //->andWhere("a.chefFamille LIKE ?", "%" . $recherche["Chef famille"] . "%")
                        //->andWhere("a.profession LIKE ?", "%" . $recherche["Profession"] . "%")
                        //->andWhere("a.ancienneVilleNaiss LIKE ?", "%" . $recherche["Ville naissance"] . "%")
                        ->andWhere("a.id LIKE ?", $idArchive)
                        ->andWhere("a.idVilleNaissance LIKE ?", $villeNaiss)
                        
                        ->andWhere("a.dateNaissance >= ?", $dateNaissMin)
                        ->andWhere("a.dateNaissance <= ?", $dateNaissMax)
                        ->andWhere("a.dateArchivage >= ?", $dateArchivageMin)
                // !!! \\     // !!! \\     // !!! \\     // !!! \\     // !!! \\     // !!! \\     // !!! \\     // !!! \\
                        ->andWhere("a.dateArchivage <= ?", $dateArchivageMax) //PROBLEME
                        // NE PREND PAS EN COMPTE LES ENREGISTREMENT DU JOUR (TODAY)
                // !!! \\     // !!! \\     // !!! \\     // !!! \\     // !!! \\     // !!! \\     // !!! \\     // !!! \\
                        ->andWhere("a.motifDepart LIKE ?", "%" . $recherche["Motif départ"] . "%");
                
                        //->andWhere("a.nomRueAnt LIKE ?", "%" . $recherche["Nom rue"] . "%")
                        //->andWhere("a.numRueAnt LIKE ?", "%" . $recherche["Nom rue"] . "%")
        ;

        // Ajout des critères si au moins un élément a été sélectionné dans les listes multi choix
        /*if ($rues != "") {
            $q->andWhere("r.id IN ($rues)");
        }

        if ($secteurs != "") {
            $q->andWhere("s.id IN ($secteurs)");
        }

        if ($decoupages != "") {
            $q->andWhere("d.id IN ($decoupages)");
        }*/
        
        if ($crietereTri != "") {
            $q->orderBy($crietereTri . " " .$ordre);
        }

        return $q;
    }

}
