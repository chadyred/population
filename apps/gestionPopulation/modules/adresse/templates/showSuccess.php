<h2>Détails de l'adresse : <?php echo $adresse->getNumeroRue() . " " . $adresse->getComplement() . " " . $adresse->getRue()->getTypeRue() . " " . $adresse->getRue()->getNom() ?></h2>
<div id="tableauDetails">
<table>
  <tbody>
    <tr>
      <th>Id :</th>
      <td><?php echo $adresse->getId() ?></td>
    </tr>
    <tr>
      <th>Numéro rue :</th>
      <td><?php echo $adresse->getNumeroRue() ?></td>
    </tr>
    <tr>
      <th>Rue :</th>
      <td><?php echo $adresse->getRue() ?></td>
    </tr>
    <tr>
      <th>Complement :</th>
      <td><?php echo $adresse->getComplement() ?></td>
    </tr>
    <tr>
      <th>Nombre logements maximum :</th>
      <td><?php echo $adresse->getNbLogementsMax() ?></td>
    </tr>
    <tr>
      <th>Nombre logements dispo :</th>
      <td><?php echo $adresse->getNbLogementsDispo() ?></td>
    </tr>
    <tr>
      <th>Nombre logements rattachés :</th>
      <td><?php echo $adresse->getNbLogementsMax() - $adresse->getNbLogementsDispo() ?></td>
    </tr>
    <tr>
      <th>Nombre logements rattachés vides :</th>
      <td><?php echo $adresse->getNbLogementsVides() ?></td>
    </tr>
    <tr>
      <th>Nombre logements rattachés occupés :</th>
      <td><?php echo $adresse->getNbLogementsOccupes() ?></td>
    </tr>
  </tbody>
</table>
</div>

<?php if ($adresse->getLogements()->count()> 0){ ?>
<h2>Liste des logements (<?php echo $adresse->getLogements()->count() ?>) </h2>
<table id="liste">
  <thead>
    <tr>
      <th>Id</th>
      <th>Type batiment</th>
      <th>Complement</th>
      <th>Infos complementaires</th>
      <th>Adresse</th>
      <th>Statut</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($adresse->getLogements() as $logement): ?>
    <tr>
      <td><a href="<?php echo url_for('logement/show?id='.$logement->getId()) ?>"><?php echo $logement->getId() ?></a></td>
      <td><?php echo $logement->getTypeBatiment() ?></td>
      <td><?php echo $logement->getTypeComplement() ." ". $logement->getValeurComplement() ?></td>
      <td><?php echo $logement->getInfosComplementaires() ?></td>
      <td><a href="<?php echo url_for('logement/index?adr='.$logement->getAdresse()->getId()) ?>"><?php echo $logement->getAdresse() ?></a></td>
      <td><?php echo ($logement->getFamilles()->count()==0 ? "<img src='/images/affichage/Stk_Green24.png' /> Disponible" : "<img src='/images/affichage/Stk_Red24.png' /> Occupé") ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php } else { ?>
    <h3>Aucun logement</h3>
<?php } ?>
    
<div id="warning" style="display: none;">
    <span class="messageInfo">Nombre maximum de logements déjà atteint à cette adresse.</span>
</div>

<hr />
<div id="boutons">
    <a class="btnLightBlue" href="<?php echo url_for('adresse/index') ?>"><img class="iconebtn16" alt="Retour liste" src="/images/boutons/back.png"/>Retour liste</a>
    &nbsp;
    <a class="btnYellow" href="<?php echo url_for('adresse/edit?id='.$adresse->getId()) ?>"><img class="iconebtn16" alt="Modifier" src="/images/boutons/pen.png"/>Modifier</a>
    &nbsp;
    <?php if ($adresse->getNbLogementsDispo() > 0 ) { ?>
        <a class="btnGreen" href="<?php echo url_for('logement/new?adr='.$adresse->getId()) ?>"><img class="iconebtn16" alt="Ajouter logement" src="/images/boutons/plus.png"/>Ajouter logement</a>
    <?php } else {?>
        <a onClick="toggleElemOnce('warning','blind');" class="btnRed" href="#"><img class="iconebtn16" alt="Ajouter logement" src="/images/boutons/plus.png"/>Ajouter logement</a>
    <?php } ?>
</div>
