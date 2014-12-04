<h1>Liste des logements <?php if (isset($adresse)) { echo "<i><a href=" . url_for('adresse/show') . "/id/" . $adresse->getId() . ">" . $adresse . "</a></i>";} ?> (<?php echo $logementsPager->getNbResults() ?>) </h1>

<?php if ($logementsPager->getNbResults() > 0){ ?>
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
    <?php foreach ($logementsPager as $logement): ?>
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
    <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucun logement</h3>
<?php } ?>

<?php if ($logementsPager->haveToPaginate()) { ?>
    <div id="navigation">
        <?php include_partial('navigation', array('pager' => $logementsPager)) ?>
    </div>
<?php } ?>
    
<div id="boutons">
  <?php if (isset($adresse)) { ?><a class="btnLightBlue" href="<?php echo url_for('logement/index') ?>"><img class="iconebtn16" alt="Réinitialiser" src="/images/boutons/undo.png"/>Réinitialiser</a><?php } ?>
  <a class="btnLightBlue" href="<?php echo url_for('@Logement_search') ?>"><img class="iconebtn16" alt="Effectuer une recherche" src="/images/boutons/search16.png"/>Chercher</a>
<!--  <a class="btnGreen" href="<?php //echo url_for('logement/new') ?>"><img class="iconebtn16" alt="Créer une nouveau logement" src="/images/boutons/plus.png"/>Nouveau</a>-->
</div>