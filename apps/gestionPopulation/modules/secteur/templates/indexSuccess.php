<h1>Liste des secteurs (<?php echo $secteurs->count() ?>)</h1>

<?php if ($secteurs->count() > 0){ ?>
<table id="liste">
  <thead>
    <tr>
      <th>Id</th>
      <th>Libelle</th>
      <th>Découpage</th>
      <th>Nombre Individu</th>
      <th>Nombre famille</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($secteurs as $secteur): ?>
    <tr>
      <td><a href="<?php echo url_for('secteur/show?id='.$secteur->getId()) ?>"><?php echo $secteur->getId() ?></a></td>
      <td><a href="<?php echo url_for('secteur/showpersecteur?id='.$secteur->getId() /*.'&nom='.$secteur->getLibelle()*/) ?>"><?php echo $secteur->getLibelle() ?></a></td>
      <td><?php echo $secteur->getDecoupage() ?></td>
      <td><?php echo $secteur->getNbHabitants() ?></td>
      <td><?php echo $secteur->getNbFamilles(); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php } else { ?>
    <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucun secteur</h3>
<?php } ?>
    
<div id="boutons">
  <a class="btnGreen" href="<?php echo url_for('secteur/new') ?>"><img class="iconebtn16" alt="Créer une nouveau secteur" src="/images/boutons/plus.png"/>Nouveau</a>
</div>