<h2>Détails du secteur : <?php echo $secteur->getId() ?></h2>
<div id="tableauDetails">
<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $secteur->getId() ?></td>
    </tr>
    <tr>
      <th>Libelle:</th>
      <td><?php echo $secteur->getLibelle() ?></td>
    </tr>
    <tr>
      <th>Id decoupage:</th>
      <td><?php echo $secteur->getIdDecoupage() ?></td>
    </tr>
    <tr>
      <th>Libellé decoupage:</th>
      <td><?php echo $secteur->getDecoupage()->getLibelle() ?></td>
    </tr>
    <tr>
      <th>Nombre habitants:</th>
      <td><?php echo $secteur->getNbHabitants() ?></td>
    </tr>
    <tr>
      <th>Nombre familles:</th>
      <td><?php echo $secteur->getNbFamilles() ?></td>
    </tr>
  </tbody>
</table>
</div>

<h2>Liste des troncons (<?php echo $troncons->count() ?>)</h2>

<table id="liste">
  <thead>
    <tr>
      <th>Id</th>
      <th>Id rue</th>
      <th>Code rivoli</th>
      <th>Nom rue</th>
      <th>Num debut pair</th>
      <th>Num fin pair</th>
      <th>Num debut impair</th>
      <th>Num fin impair</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($troncons as $troncon): ?>
    <tr>
      <td><a href="<?php echo url_for('troncon/show?id='.$troncon->getId()) ?>"><?php echo $troncon->getId() ?></a></td>
      <td><a href="<?php echo url_for('rue/show?id='.$troncon->getIdRue()) ?>"><?php echo $troncon->getIdRue() ?></a></td>
      <td><a href="<?php echo url_for('rue/show?id='.$troncon->getIdRue()) ?>"><?php echo $troncon->getRue()->getCodeRivoli()?></a></td>
      <td><a href="<?php echo url_for('rue/show?id='.$troncon->getIdRue()) ?>"><?php echo $troncon->getRue()->getTypeRue() . " " . $troncon->getRue()->getNom()?></a></td>
      <td><?php echo $troncon->getNumDebutPair() ?></td>
      <td><?php echo $troncon->getNumFinPair() ?></td>
      <td><?php echo $troncon->getNumDebutImpair() ?></td>
      <td><?php echo $troncon->getNumFinImpair() ?></td>
    </tr>
    <?php endforeach; ?>

  </tbody>
</table>

<hr />
<div id="boutons">
    <a class="btnLightBlue" href="<?php echo url_for('secteur/index') ?>"><img class="iconebtn16" alt="Retour liste" src="/images/boutons/back.png"/>Retour liste</a>
    &nbsp;
    <a class="btnYellow" href="<?php echo url_for('secteur/edit?id='.$secteur->getId()) ?>"><img class="iconebtn16" alt="Modifier" src="/images/boutons/pen.png"/>Modifier</a>
    &nbsp;
</div>