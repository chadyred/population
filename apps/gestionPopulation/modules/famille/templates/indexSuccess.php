<h1>Liste des familles
<?php if (isset($adresse)) {
        echo "habitant à l'adresse <i><a href=" . url_for('adresse/show') . "/id/" . $adresse->getId() . ">" . $adresse . "</a></i> ";
    } elseif (isset($logement)){
        echo "habitant au logement <i><a href=" . url_for('logement/show') . "/id/" . $logement->getId() . ">" . $logement . "</a></i> ";
    }
?>
(<?php echo $famillesPager->getNbResults() ?>)
</h1>

<?php if ($famillesPager->getNbResults() > 0){ ?>
<table id="liste">
  <thead>
    <tr>
        <?php if(isset($ord)){
                $ordre=($ord=="asc"?"desc":"asc");
            } else {
                $ordre="asc";
            }

            if(isset($tri)){
                $tri2=$tri;
            } else {
                $tri2="";
            }
        ?>
      <th <?php if($tri2=="id") echo "id='selectionTri'" ?>><a href="<?php echo url_for('famille/index?tri=id&ord='.$ordre); ?>">Id (code famille)</a></th>
      <th <?php if($tri2=="idlogement") echo "id='selectionTri'" ?>><a href="<?php echo url_for('famille/index?tri=idlogement&ord='.$ordre); ?>">Id logement</a></th>
      <th>Adresse logement</th>
      <th>Infos complementaires</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($famillesPager->getResults() as $famille): ?>
    <tr>
      <?php $a = $famille->getLogement()->getAdresse(); $l = $famille->getLogement(); ?>
        
      <td><a href="<?php echo url_for('famille/show?id='.$famille->getId()) ?>"><?php echo $famille->getId() ?></a></td>
      <td><abbr title="<?php echo $l->getTypeBatiment() . " " . $l->getTypeComplement() . " " . $l->getValeurComplement() ?>"><a href="<?php echo url_for('famille/index?lgt='.$famille->getIdLogement()) ?>"><?php echo $famille->getIdLogement() ?></a></abbr></td>
      <td><abbr title="<?php echo "Afficher les familles se trouvant à l'adresse " . $a ?>"><a href="<?php echo url_for('famille/index?adr='.$l->getIdAdresse()) ?>"><?php echo $a ?></a></abbr></td>
      <td><?php echo $famille->getInfosComplementaires() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php } else { ?>
    <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucune famille</h3>
<?php } ?>

<?php if ($famillesPager->haveToPaginate()) { ?>
    <div id="navigation">
        <?php include_partial('navigation', array('pager' => $famillesPager)) ?>
    </div>
<?php } ?>

<div id="boutons">
   <?php if ((isset($logement)) OR (isset($adresse))) { ?><a class="btnLightBlue" href="<?php echo url_for('famille/index') ?>"><img class="iconebtn16" alt="Réinitialiser" src="/images/boutons/undo.png"/>Réinitialiser</a><?php } ?>
   <a class="btnLightBlue" href="<?php echo url_for('@Famille_search') ?>"><img class="iconebtn16" alt="Effectuer une recherche" src="/images/boutons/search16.png"/>Chercher</a>
   <a class="btnGreen" href="<?php echo url_for('famille/new') ?>"><img class="iconebtn16" alt="Créer une nouvelle famille" src="/images/boutons/plus.png"/>Nouveau</a>
</div>