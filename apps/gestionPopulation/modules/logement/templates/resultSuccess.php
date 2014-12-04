<?php use_helper('Date'); ?>
<?php $sf_user->setCulture('fr_FR'); ?>

<h1>Résultats de la recherche sur les logements (<?php echo $logementsPager->getNbResults() ?>)</h1>

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
      <td><?php echo $logement->getAdresse() ?></td>
      <td><?php echo ($logement->getFamilles()->count()==0 ? "<img src='/images/affichage/Stk_Green24.png' /> Disponible" : "<img src='/images/affichage/Stk_Red24.png' /> Occupé") ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php } else { ?>
    <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucun résultat</h3>
<?php } ?>

<?php if ($logementsPager->haveToPaginate()) { ?>
    <div id="navigation">
        <?php include_partial('navigation', array('pager' => $logementsPager)) ?>
    </div>
<?php } ?>

<div id="boutons">
    <a class="btnLightBlue" href="<?php echo url_for('@Logement') ?>"><img class="iconebtn16" alt="Retour" src="/images/boutons/back.png"/>Retour</a>
    <a class="btnLightBlue" href="<?php echo url_for('@Logement_search') ?>"><img class="iconebtn16" alt="Effectuer une autre recherche" src="/images/boutons/search16.png"/>Nouvelle recherche</a>
</div>





