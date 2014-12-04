<?php use_helper('Date'); ?>
<h2>Détails de l'individu : <?php echo $individu->getNomNaissance() . " " . $individu->getPrenoms() ?></h2>
<div id="tableauDetails">
<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $individu->getId() ?></td>
    </tr>
    <tr>
      <th>Nom naissance:</th>
      <td><?php echo $individu->getNomNaissance() ?></td>
    </tr>
    <tr>
      <th>Nom usage:</th>
      <td><?php echo $individu->getNomUsage() ?></td>
    </tr>
    <tr>
      <th>Prenoms:</th>
      <td><?php echo $individu->getPrenoms() ?></td>
    </tr>
    <tr>
      <th>Titre:</th>
      <td><?php echo $individu->getTitre() ?></td>
    </tr>
    <tr>
      <th>Sexe:</th>
      <td><?php echo $individu->getSexe() ?></td>
    </tr>
    <tr>
      <th>Date naissance:</th>
      <td><?php echo format_date($individu->getDateNaissance(), "dd/MM/yyyy") ?></td>
    </tr>
    <tr>
      <th>Ville naissance:</th>
      <td><?php echo $individu->getVilleNaissance() ?></td>
    </tr>
    <tr>
      <th>Ancienne ville naissance:</th>
      <td><?php echo $individu->getAncienneVilleNaiss() ?></td>
    </tr>
    <tr>
      <th>Situation familiale:</th>
      <td><?php echo $individu->getSituationFamiliale() ?></td>
    </tr>
    <tr>
      <th>Chef famille:</th>
      <td><?php echo $individu->getChefFamille()==1?"Oui":"Non" ?></td>
    </tr>
    <tr>
      <th>Profession:</th>
      <td><?php echo $individu->getProfession() ?></td>
    </tr>
    <tr>
      <th>Date arrivee:</th>
      <td><?php echo format_date($individu->getDateArrivee(), "dd/MM/yyyy") ?></td>
    </tr>
    <tr>
      <th>Id famille:</th>
      <td><?php echo $individu->getIdFamille() ?></td>
    </tr>
    <tr>
      <th>Adresse:</th>
      <td><?php echo $individu->getAdresseComplete() ?></td>
    </tr>
  </tbody>
</table>
</div>

<hr />

<div id="boutons">
    <a class="btnLightBlue" href="<?php echo url_for('individu/index') ?>"><img class="iconebtn16" alt="Retour liste" src="/images/boutons/back.png"/>Retour liste</a>
    &nbsp;
    <a class="btnYellow" href="<?php echo url_for('individu/edit?id='.$individu->getId()) ?>"><img class="iconebtn16" alt="Modifier" src="/images/boutons/pen.png"/>Modifier</a>
    <a class="btnYellow" href="<?php echo url_for('individu/mutation?id='.$individu->getId()) ?>"><img class="iconebtn16" alt="Mutation" src="/images/boutons/exchange20.png"/>Mutation</a>
    <a class="btnYellow" href="<?php echo url_for('individu/radiation?id='.$individu->getId()) ?>"><img class="iconebtn16" alt="Radiation" src="/images/boutons/delete.png"/>Radiation</a>
</div>