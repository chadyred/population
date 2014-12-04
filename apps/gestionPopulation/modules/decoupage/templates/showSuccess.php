<h2>Détails du découpage : <?php echo $decoupage->getLibelle() ?></h2>
<div id="tableauDetails">
<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $decoupage->getId() ?></td>
    </tr>
    <tr>
      <th>Libelle:</th>
      <td><?php echo $decoupage->getLibelle() ?></td>
    </tr>
        <tr>
      <th>Nb rue:</th>
      <td><?php echo $decoupage->getNbrue() ?></td>
    </tr>
    
    
  </tbody>
</table>
</div>

<h2>Liste des secteurs de ce découpage</h2>
<table id="liste">
  <thead>
    <tr>
      <th>Id</th>
      <th>Libelle</th>
      <th>Nombre tronçons</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($decoupage->getSecteurs() as $secteur): ?>
    <tr>
      <td><a href="<?php echo url_for('secteur/show?id='.$secteur->getId()) ?>"><?php echo $secteur->getId() ?></a></td>
      <td><a href="<?php echo url_for('secteur/show?id='.$secteur->getId()) ?>"><?php echo $secteur->getLibelle() ?></a></td>
      <td><?php echo $secteur->getTroncons()->count() ?></td>
     </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<table id="liste">
  <thead>
    <tr>
      <th>Mot Directeur</th>
      <th>Nom</th>
      <th>Secteur</th>
      <th>Debut Num Pair</th>
      <th>Fin Num Pair</th>
      <th>Debut Num Impair</th>
      <th>Fin Num Impair</th>
    </tr>
  </thead>
   <tbody>
       
       
       
    <?php foreach ($decoup as $d): ?>
    <tr>
      <td><?php echo $d['motd']; ?></td>
      <td><?php echo $d['nom']; ?></td>
      <td><?php echo $d['lib']; ?></td>
      <td><?php echo $d['ndp']; ?></td>
      <td><?php echo $d['nfp']; ?></td>
       <td><?php echo $d['ndi']; ?></td>
        <td><?php echo $d['nfi']; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<hr />
<div id="boutons">
    <a class="btnLightBlue" href="<?php echo url_for('decoupage/index') ?>"><img class="iconebtn16" alt="Retour liste" src="/images/boutons/back.png"/>Retour liste</a>
    &nbsp;
    <a class="btnYellow" href="<?php echo url_for('decoupage/edit?id='.$decoupage->getId()) ?>"><img class="iconebtn16" alt="Modifier" src="/images/boutons/pen.png"/>Modifier</a>
    &nbsp;
    <a class="btnYellow" href="<?php echo url_for('decoupage/exportDecoupageSecteur?id='.$decoupage->getId()) ?>"><img class="iconebtn16" alt="Exporter les résultats" src="/images/boutons/download.png"/>Exporter résultats</a>
</div>
