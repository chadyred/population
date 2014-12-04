<h1>Liste des types de rue</h1>

<table id="liste">
  <thead>
    <tr>
      <th>Id</th>
      <th>Libelle</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($type_rues as $type_rue): ?>
    <tr>
      <td><a href="<?php echo url_for('typeRue/show?id='.$type_rue->getId()) ?>"><?php echo $type_rue->getId() ?></a></td>
      <td><?php echo $type_rue->getLibelle() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<div id="boutons">
  <a class="btnGreen" href="<?php echo url_for('typeRue/new') ?>"><img class="iconebtn16" alt="Créer une nouveau type" src="/images/boutons/plus.png"/>Nouveau</a>
</div>