<?php use_helper('Date'); ?>
<h2>Détails de l'archive n° <?php echo $archive->getId() ?></h2>
<div id="tableauDetails">
<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $archive->getId() ?></td>
    </tr>
    <tr>
      <th>Nom naissance:</th>
      <td><?php echo $archive->getNomNaissance() ?></td>
    </tr>
    <tr>
      <th>Nom usage:</th>
      <td><?php echo $archive->getNomUsage() ?></td>
    </tr>
    <tr>
      <th>Prenoms:</th>
      <td><?php echo $archive->getPrenoms() ?></td>
    </tr>
    <tr>
      <th>Titre:</th>
      <td><?php echo $archive->getTitre() ?></td>
    </tr>
    <tr>
      <th>Sexe:</th>
      <td><?php echo $archive->getSexe() ?></td>
    </tr>
    <tr>
      <th>Date naissance:</th>
      <td><?php echo format_date($archive->getDateNaissance(), "dd/MM/yyyy") ?></td>
    </tr>
    <tr>
      <th>Ville naissance:</th>
      <td><?php echo $archive->getVilleNaissance() ?></td>
    </tr>
    <tr>
      <th>Situation familiale:</th>
      <td><?php echo $archive->getSituationFamiliale() ?></td>
    </tr>
    <tr>
      <th>Rue ant:</th>
      <td><?php echo $archive->getTypeRueAnt() . " " . $archive->getNomRueAnt() ?></td>
    </tr>
    <tr>
      <th>Numero rue ant:</th>
      <td><?php echo $archive->getNumeroRueAnt() ?></td>
    </tr>
    <tr>
      <th>Complement num ant:</th>
      <td><?php echo $archive->getComplementNumAnt() ?></td>
    </tr>
    <tr>
      <th>Rue post:</th>
      <td><?php echo $archive->getTypeRuePost() . " " . $archive->getNomRuePost() ?></td>
    </tr>
    <tr>
      <th>Numero rue post:</th>
      <td><?php echo $archive->getNumeroRuePost() ?></td>
    </tr>
    <tr>
      <th>Complement num post:</th>
      <td><?php echo $archive->getComplementNumPost() ?></td>
    </tr>
    <tr>
      <th>Date archivage:</th>
      <td><?php echo format_date($archive->getDateArchivage(), "dd/MM/yyyy") ?></td>
    </tr>
    <tr>
      <th>Motif depart:</th>
      <td><?php echo $archive->getMotifDepart() ?></td>
    </tr>
    <tr>
      <th>Infos complémentaires:</th>
      <td><?php echo $archive->getInfosComplementaires()?></td>
    </tr>
  </tbody>
</table>
</div>

<hr />

<div id="boutons">
    <a class="btnLightBlue" href="<?php echo url_for('archive/index') ?>"><img class="iconebtn16" alt="Retour liste" src="/images/boutons/back.png"/>Retour liste</a>
    &nbsp;
    <a class="btnYellow" href="<?php echo url_for('archive/edit?id='.$archive->getId()) ?>"><img class="iconebtn16" alt="Modifier" src="/images/boutons/pen.png"/>Modifier</a>
</div>