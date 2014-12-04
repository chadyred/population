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
 <body onLoad="document.getElementById('sf_admin_bar').style.display='none'">
      <div id='page'>
          <header id="logo">
              <a href="<?php echo url_for('@homepage') ?>" ><img id="headerLogo" src='/images/my_Logo6.1.png'/></a>
          </header>

          <?php if (!include_slot('menu')): ?><!-- Début du Slot -->
          <div id="menu">
              <ul>
                  <li><a href='#' title='Retour' onMouseOver="document.getElementById('leftArrow').src='/images/boutons/arrowleft16red2.png'" onMouseOut="document.getElementById('leftArrow').src='/images/boutons/arrowleft16.png'" onClick="history.back()"><span><img id="leftArrow" src="/images/boutons/arrowleft16.png" alt="retour" /></span></a></li>
                  <li><a href='<?php echo url_for('@homepage') ?>' title='Accueil' ><span>Accueil</span></a></li><!-- class='current' -->
                  <li><a href='<?php echo url_for('@utilisateur') ?>' title='Utilisateurs'><span>Utilisateurs</span></a></li>
                  <li><a href='<?php echo url_for('@PasswordGenerator') ?>' title='Utilisateurs'><span>Crypter MDP</span></a></li>
                  <li><a href='<?php echo url_for('@type_rue') ?>' title='TypesRue'><span>Types de rues</span></a></li>
                  <li><a id="noBg" href='<?php echo url_for('@ville') ?>' title='Villes'><span>Villes</span></a></li>
                  <!--<li id="right"><a id="right" href='/accueil' title='Site principal'><span>Retour appli</span></a></li>-->
                  <!-- décommenter la ligne ci dessus en usage production normal-->
                  <li id="right"><a id="right" href='/gestionPopulation_dev.php/accueil' title='Site principal'><span>Retour appli</span></a></li>
                  <?php if ($sf_user->isAuthenticated()) { ?>
                    <li id="right"><a id="right" href='<?php echo url_for('@Logout') ?>' title='Deconnexion'><span>Deconnexion</span></a></li>
                  <?php } ?>
                  <li id="right"><a onClick="toggleElem('sf_admin_bar','blind');" id="noBg" href='#' title='Filtrer'>Filtrer</a></li>
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
