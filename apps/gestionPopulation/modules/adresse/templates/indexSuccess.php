<h1>Liste des adresses <?php if (isset($rue)) { echo "de la rue <i><a href=" . url_for('rue/show') . "/id/" . $rue->getId() . ">" . $rue . "</a></i>";} ?> (<?php echo $adressesPager->getNbResults() ?>) </h1>

<?php if ($adressesPager->getNbResults() > 0){ ?>
<table id="liste">
  <thead>
    <tr>
      <th>Id</th>
      <th>Numero rue</th>
      <th>Complement</th>
      <th>Rue</th>
      <th>Nb logements max</th>
      <th>Nb logements occupés</th>
      <th>Nb logements vides</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($adressesPager->getResults() as $adresse): ?>
    <tr>
      <td><a href="<?php echo url_for('adresse/show?id='.$adresse->getId()) ?>"><?php echo $adresse->getId() ?></a></td>
      <td><?php echo $adresse->getNumeroRue() ?></td>
      <td><?php echo $adresse->getComplement() ?></td>
      <td><a href="<?php echo url_for('adresse/index?rue='.$adresse->getRue()->getId()) ?>"><?php echo $adresse->getRue() ?></a></td>
      <td><?php echo $adresse->getNbLogementsMax() ?></td>
      <td><?php echo $adresse->getNbLogementsOccupes() ?></td>
      <td><?php echo $adresse->getNbLogementsVides() ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php } else { ?>
    <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucune adresse</h3>
<?php } ?>

<?php if ($adressesPager->haveToPaginate()) { ?>
    <div id="navigation">
        <?php include_partial('navigation', array('pager' => $adressesPager)) ?>
    </div>
<?php } ?>
    
<div id="boutons">
     <?php if (isset($rue)) { ?><a class="btnLightBlue" href="<?php echo url_for('adresse/index') ?>"><img class="iconebtn16" alt="Réinitialiser" src="/images/boutons/undo.png"/>Réinitialiser</a><?php } ?>
  <a class="btnGreen" href="<?php echo url_for('adresse/new') ?>"><img class="iconebtn16" alt="Créer une nouvelle adresse" src="/images/boutons/plus.png"/>Nouveau</a>
  
  <a class="btnLightBlue" href="<?php echo url_for('@Adresse_search') ?>"><img class="iconebtn16" alt="Effectuer une recherche" src="/images/boutons/search16.png"/>Chercher</a>
  
</div>