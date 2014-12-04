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
            $this->forward('user', 'accueil');  // redirection vers page d'accueil
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

}
