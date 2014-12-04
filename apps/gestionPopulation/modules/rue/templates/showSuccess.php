<h2>Détails de la rue "<?php echo $rue->getTypeRue()->getLibelle() . " " . $rue->getNom() ?>"</h2>
<div id="tableauDetails">
<table>
  <tbody>
    <tr>
      <th>Id :</th>
      <td><?php echo $rue->getId() ?></td>
    </tr>
    <tr>
      <th>Code rivoli :</th>
      <td><?php echo $rue->getCodeRivoli() ?></td>
    </tr>
    <tr>
      <th>Nom :</th>
      <td><?php echo $rue->getNom() ?></td>
    </tr>
    <tr>
      <th>Mot directeur :</th>
      <td><?php echo $rue->getMotDirecteur() ?></td>
    </tr>
    <tr>
      <th>Premier numero :</th>
      <td><?php echo $rue->getPremierNumero() ?></td>
    </tr>
    <tr>
      <th>Dernier numero :</th>
      <td><?php echo $rue->getDernierNumero() ?></td>
    </tr>
    <tr>
      <th>Type rue :</th>
      <td><?php echo $rue->getTypeRue()->getLibelle() ?></td>
    </tr>
  </tbody>
</table>
</div>

<h2>Liste des tronçons (<?php echo $rue->getTroncons()->count() ?>)</h2>

<?php if ($rue->getTroncons()->count() > 0){ ?>
    <table id="liste">
      <thead>
        <tr>
          <th>Id</th>
          <th>Id rue</th>
          <th>Id secteur</th>
          <th>Num début pair</th>
          <th>Num début impair</th>
          <th>Num fin pair</th>
          <th>Num fin impair</th>
          <th>Infos complémentaires</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rue->getTroncons() as $troncon): ?>
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
    <br />

<h2>Liste des adresses (<?php echo $rue->getAdresses()->count() ?>) </h2>

<?php if ($rue->getAdresses()->count() > 0){ ?>
<table id="liste">
  <thead>
    <tr>
      <th>Id</th>
      <th>Numero rue</th>
      <th>Complément</th>
      <th>Nb logements max</th>
      <th>Nb logements occupés</th>
      <th>Nb logements vides</th>
    </tr>
  </thead>
  <tbody>
    <?php $nbLogementsMax = 0; $nbLogementRattaches = 0 ?>
    <?php foreach ($rue->getAdresses() as $adresse): ?>
    <tr>
      <td><a href="<?php echo url_for('adresse/show?id='.$adresse->getId()) ?>"><?php echo $adresse->getId() ?></a></td>
      <td><?php echo $adresse->getNumeroRue() ?></td>
      <td><?php echo $adresse->getComplement() ?></td>
      <td><?php echo $adresse->getNbLogementsMax() ?></td>
      <td><?php echo $adresse->getNbLogementsOccupes() ?></td>
      <td><?php echo $adresse->getNbLogementsVides() ?></td>
    </tr>
    <?php $nbLogementsMax += $adresse->getNbLogementsMax();
          $nbLogementRattaches += $adresse->getLogements()->count();
    endforeach; ?>
    <tr>
        <td colspan="6"><?php echo "Nombre de logements rattachés/total de la rue : " . $nbLogementRattaches . "/" .$nbLogementsMax ?></td>
    </tr>
  </tbody>
</table>

<?php } else { ?>
    <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucune adresse</h3>
<?php } ?>
    
<hr />
<div id="boutons">
    <a class="btnLightBlue" href="<?php echo url_for('rue/index') ?>"> <img class="iconebtn16" alt="Retour liste" src="/images/boutons/back.png"/>Retour liste</a>
    &nbsp;
    <a class="btnYellow" href="<?php echo url_for('rue/edit?id='.$rue->getId()) ?>"> <img class="iconebtn16" alt="Modifier" src="/images/boutons/pen.png"/>Modifier</a>
</div>

