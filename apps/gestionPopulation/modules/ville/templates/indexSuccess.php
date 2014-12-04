<h1>Liste des villes</h1>

<table id="liste">
  <thead>
    <tr>
      <th>Id</th>
      <th>Cp</th>
      <th>Ville</th>
      <th>Region</th>
      <th>Departement</th>
      <th>Pays</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($villes as $ville): ?>
    <tr>
      <td><a href="<?php echo url_for('ville/show?id='.$ville->getId()) ?>"><?php echo $ville->getId() ?></a></td>
      <td><?php echo $ville->getCP() ?></td>
      <td><?php echo $ville->getVille() ?></td>
      <td><?php echo $ville->getRegion() ?></td>
      <td><?php echo $ville->getDepartement() ?></td>
      <td><?php echo $ville->getPays() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<div id="boutons">
  <a href="<?php echo url_for('ville/new') ?>"><img class="iconebtn16" alt="Créer une nouvelle ville" src="/images/boutons/plus.png"/>Nouveau</a>
</div>