<h1>Liste des découpages (<?php echo $decoupages->count() ?>)</h1>

<?php if ($decoupages->count() > 0){ ?>
<table id="liste">
  <thead>
    <tr>
      <th>Id</th>
      <th>Libelle</th>
      <th>Nombre secteurs</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($decoupages as $decoupage): ?>
    <tr>
      <td><a href="<?php echo url_for('decoupage/show?id='.$decoupage->getId()) ?>"><?php echo $decoupage->getId() ?></a></td>
      <td><a href="<?php echo url_for('decoupage/show?id='.$decoupage->getId()) ?>"><?php echo $decoupage->getLibelle() ?></a></td>
      <td><?php echo $decoupage->getSecteurs()->count() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php } else { ?>
    <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucun découpage</h3>
<?php } ?>
    
<div id="boutons">
  <a class="btnGreen" href="<?php echo url_for('decoupage/new') ?>"><img class="iconebtn16" alt="Créer un nouveau découpage" src="/images/boutons/plus.png"/>Nouveau</a>
</div>