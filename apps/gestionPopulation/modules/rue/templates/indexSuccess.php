<h1>Liste des rues <?php if (isset($typeRue)) { echo "de type <i>" . $typeRue . "</i>";} ?> (<?php echo $ruesPager->getNbResults() ?>)</h1>

<?php if ($ruesPager->getNbResults() > 0){ ?>
<table id="liste">
  <thead>
    <tr>
      <th>Id</th>
      <th>Code rivoli</th>
      <th>Type rue</th>
      <th>Nom</th>
      <th>Mot directeur</th>
      <th>Premier numero</th>
      <th>Dernier numero</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ruesPager->getResults() as $rue): ?>
    <tr> 
      <td><a href="<?php echo url_for('rue/show?id='.$rue->getId()) ?>"><?php echo $rue->getId() ?></a></td>
      <td><a href="<?php echo url_for('rue/show?id='.$rue->getId()) ?>"><?php echo $rue->getCodeRivoli() ?></a></td>
      <td><a href="<?php echo url_for('rue/index?typ='.$rue->getIdTypeRue()) ?>"><?php echo $rue->getTypeRue()->getLibelle() ?></a></td>
      <td><?php echo $rue->getNom() ?></td>
      <td><?php echo $rue->getMotDirecteur() ?></td>
      <td><?php echo $rue->getPremierNumero() ?></td>
      <td><?php echo $rue->getDernierNumero() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php } else { ?>
    <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucune rue</h3>
<?php } ?>

<?php if ($ruesPager->haveToPaginate()) { ?>
    <div id="navigation">
        <?php include_partial('navigation', array('pager' => $ruesPager)) ?>
    </div>
<?php } ?>
    
<div id="boutons">
    <?php if (isset($typeRue)) { ?><a class="btnLightBlue" href="<?php echo url_for('rue/index') ?>"><img class="iconebtn16" alt="Réinitialiser" src="/images/boutons/undo.png"/>Réinitialiser</a><?php } ?>
    <a class="btnGreen" href="<?php echo url_for('rue/new') ?>"><img class="iconebtn16" alt="Créer une nouvelle rue" src="/images/boutons/plus.png"/>Nouveau</a>
</div>