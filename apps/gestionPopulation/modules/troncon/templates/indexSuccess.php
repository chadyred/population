<h1>Liste des troncons (<?php echo $troncons->count() ?>)</h1>

<?php if ($troncons->count() > 0){ ?>
<table id="liste">
  <thead>
    <tr>
      <th>Id</th>
      <th>Id rue</th>
      <th>Id secteur</th>
      <th>Num debut pair</th>
      <th>Num debut impair</th>
      <th>Num fin pair</th>
      <th>Num fin impair</th>
      <th>Infos complementaires</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($troncons as $troncon): ?>
    <tr>
      <td><a href="<?php echo url_for('troncon/show?id='.$troncon->getId()) ?>"><?php echo $troncon->getId() ?></a></td>
      <td><?php echo $troncon->getIdRue() ?></td>
      <td><?php echo $troncon->getIdSecteur() ?></td>
      <td><?php echo $troncon->getNumDebutPair() ?></td>
      <td><?php echo $troncon->getNumDebutImpair() ?></td>
      <td><?php echo $troncon->getNumFinPair() ?></td>
      <td><?php echo $troncon->getNumFinImpair() ?></td>
      <td><?php echo $troncon->getInfosComplementaires() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php } else { ?>
    <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucun tronçon</h3>
<?php } ?>
    
<div id="boutons">
  <a class="btnGreen" href="<?php echo url_for('troncon/new') ?>"><img class="iconebtn16" alt="Créer une nouveau troncon" src="/images/boutons/plus.png"/>Nouveau</a>
</div>