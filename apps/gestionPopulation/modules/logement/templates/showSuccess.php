<h2>Détails du logement n° <?php echo $logement->getId() . ", situé " . $logement->getAdresse() ?></h2>
<div id="tableauDetails">
<table>
  <tbody>
    <tr>
      <th>Id :</th>
      <td><?php echo $logement->getId() ?></td>
    </tr>
    <tr>
      <th>Type batiment :</th>
      <td><?php echo $logement->getTypeBatiment() ?></td>
    </tr>
    <tr>
      <th>Type complément :</th>
      <td><?php echo $logement->getTypeComplement() ?></td>
    </tr>
    <tr>
      <th>Valeur complément :</th>
      <td><?php echo $logement->getValeurComplement() ?></td>
    </tr>
    <tr>
      <th>Infos complémentaires :</th>
      <td><?php echo $logement->getInfosComplementaires() ?></td>
    </tr>
    <tr>
      <th>Adresse :</th>
      <td><?php echo $logement->getAdresse() ?></td>
    </tr>
    <tr>
      <th>Statut :</th>
      <td><?php echo ($logement->getFamilles()->count()==0 ? "Disponible" : "Occupé") ?></td>
    </tr>
  </tbody>
</table>
</div>
    
<?php if ($logement->getFamilles()->count() > 0){ ?>
<h2>Liste des familles (<?php echo $logement->getFamilles()->count()?>)</h2>
<table id="liste">
  <thead>
    <tr>
      <th>Id (code famille)</th>
      <th>Adresse logement</th>
      <th>Infos complementaires</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($logement->getFamilles() as $famille): ?>
    <tr>
      <?php $a = $famille->getLogement()->getAdresse(); $l = $famille->getLogement(); ?>
        
      <td><a href="<?php echo url_for('famille/show?id='.$famille->getId()) ?>"><?php echo $famille->getId() ?></a></td>
      <td><abbr title="<?php echo "Afficher les familles se trouvant à l'adresse " . $a ?>"><a href="<?php echo url_for('famille/index?adr='.$l->getIdAdresse()) ?>"><?php echo $a ?></a></abbr></td>
      <td><?php echo $famille->getInfosComplementaires() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php } else { ?>
    <h3>Aucune famille</h3>
<?php } ?>

<hr />

<div id="boutons">
    <a class="btnLightBlue" href="<?php echo url_for('logement/index') ?>"><img class="iconebtn16" alt="Retour liste" src="/images/boutons/back.png"/>Retour liste</a>
    &nbsp;
    <a class="btnYellow" href="<?php echo url_for('logement/edit?id='.$logement->getId()) ?>"><img class="iconebtn16" alt="Modifier" src="/images/boutons/pen.png"/>Modifier</a>
</div>