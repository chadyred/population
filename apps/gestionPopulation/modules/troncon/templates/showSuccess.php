<h2>Détails du tronçon : <?php echo $troncon->getId() ?></h2>
<div id="tableauDetails">
<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $troncon->getId() ?></td>
    </tr>
    <tr>
      <th>Rue:</th>
      <td><?php echo $troncon->getRue()->getTypeRue() . " " . $troncon->getRue()->getNom() ?></td>
    </tr>
    <tr>
      <th>Secteur:</th>
      <td><?php echo $troncon->getSecteur() ?></td>
    </tr>
    <tr>
      <th>Num debut pair:</th>
      <td><?php echo $troncon->getNumDebutPair() ?></td>
    </tr>
    <tr>
      <th>Num debut impair:</th>
      <td><?php echo $troncon->getNumDebutImpair() ?></td>
    </tr>
    <tr>
      <th>Num fin pair:</th>
      <td><?php echo $troncon->getNumFinPair() ?></td>
    </tr>
    <tr>
      <th>Num fin impair:</th>
      <td><?php echo $troncon->getNumFinImpair() ?></td>
    </tr>
    <tr>
      <th>Infos complementaires:</th>
      <td><?php echo $troncon->getInfosComplementaires() ?></td>
    </tr>
  </tbody>
</table>
</div>

<hr />
<div id="boutons">
    <a class="btnLightBlue" href="<?php echo url_for('troncon/index') ?>"><img class="iconebtn16" alt="Retour liste" src="/images/boutons/back.png"/>Retour liste</a>
    &nbsp;
    <a class="btnYellow" href="<?php echo url_for('troncon/edit?id='.$troncon->getId()) ?>"><img class="iconebtn16" alt="Modifier" src="/images/boutons/pen.png"/>Modifier</a>
</div>