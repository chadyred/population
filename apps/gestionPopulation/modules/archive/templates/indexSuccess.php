<?php use_helper('Date'); ?>

<h1>Liste des archives <?php if (isset($motif)) { echo "dont le motif de départ est <i>" . $motif ."</i>";} ?> (<?php echo $archivesPager->getNbResults() ?>) </h1>

<?php if ($archivesPager->getNbResults() > 0){ ?>
<table id="liste">
  <thead>
    <tr>
      <th>Id</th>
      <th>Nom naissance</th>
      <th>Nom usage</th>
      <th>Prenoms</th>
      <th>Titre</th>
      <th>Sexe</th>
      <th>Date naissance</th>
      <th>Ville naissance</th>
      <th>Situation familiale</th> 
      <th>Adresse ant</th>
      <th>Adresse post</th>
      <th>Date archivage</th>
      <th>Motif depart</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($archivesPager->getResults() as $archive): ?>
    <tr>
      <td><a href="<?php echo url_for('archive/show?id='.$archive->getId()) ?>"><?php echo $archive->getId() ?></a></td>
      <td><?php echo $archive->getNomNaissance() ?></td>
      <td><?php echo $archive->getNomUsage() ?></td>
      <td><?php echo $archive->getPrenoms() ?></td>
      <td><?php echo $archive->getTitre() ?></td>
      <td><?php echo $archive->getSexe() ?></td>
      <td><?php echo format_date($archive->getDateNaissance(), "dd/MM/yyyy") ?></td>
      <td><?php echo $archive->getVilleNaissance()->getVille() ?></td>
      <td><?php echo $archive->getSituationFamiliale() ?></td>
      <td><?php echo $archive->getNumeroRueAnt() . " " . $archive->getComplementNumAnt() . " " . $archive->getTypeRueAnt() . " " . $archive->getNomRueAnt() ?></td>
      <td><?php echo $archive->getNumeroRuePost() . " " . $archive->getComplementNumPost() . " " . $archive->getTypeRuePost() . " " . $archive->getNomRuePost() ?></td>
      <td><?php echo format_date($archive->getDateArchivage(), "dd/MM/yyyy")?></td>
      <?php if($archive->getMotifDepart()=="Départ commune") {
          $m = 'dc';
      } else if($archive->getMotifDepart()=="Décès") {
          $m = 'd';
      } else {
          $m = 'm';
      } ?>
      <td><a href="<?php echo url_for('archive/index?motif='.$m) ?>"><?php echo $archive->getMotifDepart() ?><a/></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php } else { ?>
    <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucune archive</h3>
<?php } ?>

<?php if ($archivesPager->haveToPaginate()) { ?>
    <div id="navigation">
        <?php include_partial('navigation', array('pager' => $archivesPager)) ?>
    </div>
<?php } ?>

<div id="boutons">
    <?php if (isset($motif)) { ?><a class="btnLightBlue" href="<?php echo url_for('archive/index') ?>"><img class="iconebtn16" alt="Réinitialiser" src="/images/boutons/undo.png"/>Réinitialiser</a><?php } ?>
    <a class="btnLightBlue" href="<?php echo url_for('@Archive_search') ?>"><img class="iconebtn16" alt="Effectuer une recherche" src="/images/boutons/search16.png"/>Chercher</a>
  <!--<a class="btnGreen" href="<?php //echo url_for('archive/new') ?>"><img class="iconebtn16" alt="Créer une nouvelle archive" src="/images/boutons/plus.png"/>Nouveau</a>-->
</div>