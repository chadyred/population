<?php

/**
 * user actions.
 *
 * @package    population
 * @subpackage user
 * @author     Flament Guillaume
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        //index vide
    }

    public function executeSecure(sfWebRequest $request) {
        // vide
    }

    public function executeLogin() {

        // Récupération login et du mot de passe que l'utilisateur à saisi
        $login = $this->getRequestParameter('login');
        $password = md5(sha1($this->getRequestParameter('password')));

        // Authentification
        if (Doctrine_Core::getTable('Utilisateur')->verifierLogin($login, $password)) { // le mot de passe et l'email correspondent
            $res = Doctrine_Core::getTable('Utilisateur')->login($login, $password);
            $this->getUser()->setAuthenticated(true);
            $this->getUser()->setAttribute('id', $res->getId());
            $this->getUser()->setFlash('lastAction', 'Authentification réussie');
            $this->getUser()->addCredential($res->getTypeUtilisateur());
            if ($res->getTypeUtilisateur()=="SuperAdmin"){
                $this->getUser()->addCredential("Admin");
            }


            //****** Récupération des attributs pour recréer une URL ******/
            if ($this->getUser()->hasAttribute('module')) {
                $m = $this->getUser()->getAttribute('module');
                $a = $this->getUser()->getAttribute('action');
                $p = $this->getUser()->getAttribute('param');

                // Suppression des attributs pour éviter comportements anormaux de l'appli
                $this->getUser()->getAttributeHolder()->remove('module', 'action', 'param');

                //****** Redirection ******************************************/
                // si on vient de "show", on désire alors effectuer une modificaton
                if ($a == "show") {
                    $this->redirect("$m/edit?id=$p");   // redirection vers modifier
                }

                // si on vient de "show", on désire alors effectuer un ajout
                elseif ($a == "index") {
                    $this->redirect("$m/new?id=$p");   // redirection vers nouveau
                }

            //****** Pas d'attributs donc redirection vers la page d'accueil ******/
            } else {
                $this->forward('user', 'accueil');  // redirection vers page d'accueil
            }
            
        } else {                   // le mot de passe et l'email ne correspondent pas
            $this->getUser()->setFlash('lastAction', 'Echec de l\'authentification.');
            $this->forward('user', 'index'); // on redemande l'authentification
        }
    }

    public function executeLogout() {
        $user = $this->getUser();          // on récupère l'objet de session
        $user->setAuthenticated(false);    // l'utilisateur n'est plus authentifié
        $user->clearCredentials();         // l'utilisateur n'a plus de droits
        $this->getUser()->setFlash('lastAction', 'Deconnexion réussie');
        $this->redirect("@homepage");
    }

    public function executeAccueil() {
        
    }
    
    public function executeStats(sfWebRequest $request) {
        $i = 0;
        while ($i < 11) {
            if ($i!=10) {
                // on souhaite obtenir des tranches de 10 ans
                $arrayStatsValuesHomme[] = $this->getStatsByTrancheAge('Masculin',$i*10,$i*10+9);
                $arrayStatsValuesFemmes[] = $this->getStatsByTrancheAge('Féminin',$i*10,$i*10+9);
            } else {
                // on souhaite obtenir les + de 100 ans
                $arrayStatsValuesHomme[] = $this->getStatsByTrancheAge('Masculin',$i*10);
                $arrayStatsValuesFemmes[] = $this->getStatsByTrancheAge('Féminin',$i*10);
            }
            $i++;
        }
        
        $this->statsHomme = $arrayStatsValuesHomme;
        $this->statsFemme = $arrayStatsValuesFemmes;
//        $this->popTotale = Doctrine_Query::create()->count()->from('individu');
        $this->popTotale = Doctrine_Core::getTable('Individu')->count();
    }
    
    public function getStatsByTrancheAge($sexe, $ageMin=0, $ageMax=150) {
        
        // variables       
        $date = date('d/m/Y');
        $year = date('Y');
        $yearMin = $year - $ageMax;
        $yearMax = $year - $ageMin;
        $dateMin = date("$yearMin-m-d");
        $dateMax = date("$yearMax-m-d");
        
        // requète

        /*$q = Doctrine_Query::create()
                //->createQuery('i')
                ->select('count(*) as nombre')
                ->from('individu i')
                ->where('i.sexe=?', $sexe)
                ->andWhere('i.dateNaissance >= ?', $dateMin)
                ->andWhere('i.dateNaissance <= ?', $dateMax);
                //->execute();
        
        //return $q->toArray();
        return $q->fetchArray();*/

    
    
    // get Doctrine_Connection object
    $con = Doctrine_Manager::getInstance()->connection();
    // execute SQL query, receive Doctrine_Connection_Statement
    $st = $con->execute("select count(*) as nombre from individu i where i.sexe='$sexe' 
        and i.dateNaissance >= '$dateMin' 
        and i.dateNaissance <= '$dateMax'");
    // fetch query result
    $result = $st->fetch();
    return $result[0];
    
    }

}
