<?php use_helper('Date'); ?>

<h2>Détails de la famille n° <?php echo $famille->getId() . ", vivant " . $famille->getLogement()->getAdresse() . " (dans le logement n° " . $famille->getLogement()->getId() . ")" ?></h2>
<div id="tableauDetails">
<table>
  <tbody>
    <tr>
      <th>Id (code famille) :</th>
      <td><?php echo $famille->getId() ?></td>
    </tr>
    <tr>
      <th>Id logement :</th>
      <td><?php echo $famille->getIdLogement() ?></td>
    </tr>
    <tr>
      <th>Infos complementaires :</th>
      <td><?php echo $famille->getInfosComplementaires() ?></td>
    </tr>
  </tbody>
</table>
</div>

<h2>Liste des individus (<?php echo $famille->getIndividus()->count()?>)</h2>

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
      <th>Chef famille</th>
      <th>Profession</th>
      <th>Date arrivee</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($famille->getIndividus() as $individu): ?>
    <tr>
      <td><a href="<?php echo url_for('individu/show?id='.$individu->getId()) ?>"><?php echo $individu->getId() ?></a></td>
      <td><?php echo $individu->getNomNaissance() ?></td>
      <td><?php echo $individu->getNomUsage() ?></td>
      <td><?php echo $individu->getPrenoms() ?></td>
      <td><?php echo $individu->getTitre() ?></td>
      <td><?php echo $individu->getSexe() ?></td>
      <td><?php echo format_date($individu->getDateNaissance(), "dd/MM/yyyy") ?></td>
      <td><?php echo $individu->getVilleNaissance()->getVille() ?></td>
      <td><?php echo $individu->getSituationFamiliale() ?></td>
      <td><?php echo $individu->getChefFamille()==1?"Oui":"Non" ?></td>
      <td><?php echo $individu->getProfession() ?></td>
      <td><?php echo format_date($individu->getDateArrivee(), "dd/MM/yyyy") ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<hr />

<div id="boutons">
    <a class="btnLightBlue" href="<?php echo url_for('famille/index') ?>"><img class="iconebtn16" alt="Retour liste" src="/images/boutons/back.png"/>Retour liste</a>
    &nbsp;
    <a class="btnYellow" href="<?php echo url_for('famille/edit?id='.$famille->getId()) ?>"><img class="iconebtn16" alt="Modifier" src="/images/boutons/pen.png"/>Modifier</a>
</div>
