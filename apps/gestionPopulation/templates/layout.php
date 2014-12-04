<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/images/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body onLoad='var exp = new RegExp("Microsoft"); if (exp.test(navigator.appName)){ document.body.innerHTML="Application non compatible avec Internet Explorer";} '>
      <div id='page'>
          <header id="logo">
              <a href="<?php echo url_for('@homepage') ?>" ><img id="headerLogo" src='/images/my_Logo7.png'/></a>
          </header>

          <?php if (!include_slot('menu')): ?><!-- Début du Slot -->
          <div id="menu">
              <ul>
                  <li><a href='#' title='Retour' onMouseOver="document.getElementById('leftArrow').src='/images/boutons/arrowleft16red2.png'" onMouseOut="document.getElementById('leftArrow').src='/images/boutons/arrowleft16.png'" onClick="history.back()"><span><img id="leftArrow" src="/images/boutons/arrowleft16.png" alt="retour" /></span></a></li>
                  <li><a href='<?php echo url_for('@homepage') ?>' title='Accueil' ><span>Accueil</span></a></li><!-- class='current' -->
                  <li><a href='<?php echo url_for('@Individu') ?>' title='Individus'><span>Individus</span></a></li>
                  <li><a href='<?php echo url_for('@Famille') ?>' title='Familles'><span>Familles</span></a></li>
                  <li><a href='<?php echo url_for('@Logement') ?>' title='Logements'><span>Logements</span></a></li>
                  <li><a href='<?php echo url_for('@Adresse') ?>' title='Adresses'><span>Adresses</span></a></li>
                  <li><a href='<?php echo url_for('@Rue') ?>' title='Rues'><span>Rues</span></a></li>
                  <li><a href='<?php echo url_for('@Troncon') ?>' title='Troncons'><span>Troncons</span></a></li>
                  <li><a href='<?php echo url_for('@Secteur') ?>' title='Secteurs'><span>Secteurs</span></a></li>
                  <li><a href='<?php echo url_for('@Decoupage') ?>' title='Decoupages'><span>Decoupages</span></a></li>
                  <li><a id="noBg" href='<?php echo url_for('@Archive') ?>' title='Archives'><span>Archives</span></a></li>

                  <li id="right"><a id="right" href='/backend.php' title='Administration'><span>Administration</span></a></li>
                  <?php if ($sf_user->isAuthenticated()) { ?>
                    <li id="right"><a id="right" href='<?php echo url_for('@Logout') ?>' title='Deconnexion'><span>Deconnexion</span></a></li>
                  <?php } ?>
                  <li id="right"><a id="noBg" href='<?php echo url_for('@Statistiques') ?>' title='Statistiques'><span><img id="leftArrow" src="/images/boutons/graph16.png" alt="retour" /></span></a></li>
                  <!-- onClick="toggleElem('recherche','puff');" -->
              </ul>
          </div>
          <?php endif; ?><!-- Fin du Slot -->
   
          <div id="contenu">
              <div id="messages">
                  <?php if ($sf_user->hasFlash('lastAction')): ?>
                      <span class="messageInfo">
                          <!-- Affiche un "check" vert si le message contient le mot succès-->
                          <?php if(substr_count($sf_user->getFlash('lastAction'), "succès")!=0) {echo "<img src='/images/boutons/check.png' />";} ?>
                          <?php echo $sf_user->getFlash('lastAction') ?>
                      </span>
                  <?php endif; ?>
              </div>
              <div id="recherche" style="display: none;">
                  <form class="search">
                      <input class="search-field" type="text"/>
                      <input class="search-button" type="submit" value="chercher"/>
                  </form>
              </div>
              <?php echo $sf_content ?>
          </div>
      </div>
      <div id="footer">
          <footer id="infos">
              Site sous licence GNU GPL - 2012<br/>
              Développé par Guillaume Flament avec le framework Symfony
          </footer>
      </div>
  </body>
</html>
