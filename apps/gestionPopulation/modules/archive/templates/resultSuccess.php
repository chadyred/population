<?php use_helper('Date'); ?>
<?php $sf_user->setCulture('fr_FR'); ?>

<h1>Résultats de la recherche sur les archives (<?php echo $archivesPager->getNbResults() ?>)</h1>

<div id="infos" style="display: none;">
    <span class="messageInfo">Le nombre de résultats peut.</span>
</div>

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
      <td><?php echo $archive->getNumeroRueAnt() . " " . $archive->getComplementNumAnt() . " " . $archive->getNomRueAnt() ?></td>
      <td><?php echo $archive->getNumeroRuePost() . " " . $archive->getComplementNumPost() . " " . $archive->getNomRuePost() ?></td>
      <td><?php echo format_date($archive->getDateArchivage(), "dd/MM/yyyy")?></td>
      <td><?php echo $archive->getMotifDepart() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php } else { ?>
    <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucun résultat</h3>
<?php } ?>

<?php if ($archivesPager->haveToPaginate()) { ?>
    <div id="navigation">
        <?php include_partial('navigation', array('pager' => $archivesPager)) ?>
    </div>
<?php } ?>

<div id="boutons">
    <a class="btnLightBlue" href="<?php echo url_for('@Archive') ?>"><img class="iconebtn16" alt="Retour" src="/images/boutons/back.png"/>Retour</a>
    <a class="btnLightBlue" href="<?php echo url_for('@Archive_search') ?>"><img class="iconebtn16" alt="Effectuer une autre recherche" src="/images/boutons/search16.png"/>Nouvelle recherche</a>
    <a class="btnYellow" href="<?php echo url_for('@Archive_exportResults') ?>"><img class="iconebtn16" alt="Exporter les résultats" src="/images/boutons/download.png"/>Exporter résultats</a>
</div>





