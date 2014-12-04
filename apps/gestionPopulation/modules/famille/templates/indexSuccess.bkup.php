<h1>List des familles
<?php if (isset($adresse)) {
        echo "habitant à l'adresse <i><a href=" . url_for('adresse/show') . "/id/" . $adresse->getId() . ">" . $adresse . "</a></i>";
    } elseif (isset($logement)){
        echo "habitant au logement <i><a href=" . url_for('logement/show') . "/id/" . $logement->getId() . ">" . $logement . "</a></i>";
    } ?>
</h1>

<?php if ($famillesPager->getNbResults() > 0){ ?>
<table id="liste">
  <thead>
    <tr>
      <th>Id (code famille)</th>
      <th>Id logement</th>
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
      <td><abbr title="<?php echo "Afficher les logement se trouvant à l'adresse " . $a ?>"><a href="<?php echo url_for('famille/index?adr='.$l->getIdAdresse()) ?>"><?php echo $a ?></a></abbr></td>
      <td><?php echo $famille->getInfosComplementaires() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php } else { ?>
    <h3>Aucune famille</h3>
<?php } ?>
 <div id="navigation">
    <?php if ($famillesPager->haveToPaginate()) {?>
        <!-- Affichage de l'image premiere page -->
        <?php if ($famillesPager->getPage() != 1) { ?>
            <a href="<?php echo url_for('@Famille?page=1')?>" ><img src="/images/boutons/navfirst20.png" alt="Première page" onMouseOver="this.src='/images/boutons/navfirst20red.png'" onMouseOut="this.src='/images/boutons/navfirst20.png'"/></a>
        <?php } else { ?>
            <img src="/images/boutons/navfirst20.png" alt="Première page" onMouseOver="this.src='/images/boutons/navfirst20red.png'" onMouseOut="this.src='/images/boutons/navfirst20.png'"/>
        <?php } ?>
        <!-- Affichage de l'image page précédente -->
        <?php if ($famillesPager->getPage() != 1) { ?>
            <a href="<?php echo url_for('@Famille?page='.$famillesPager->getPreviousPage())?>" ><img src="/images/boutons/navprev20.png" alt="Page précédente" onMouseOver="this.src='/images/boutons/navprev20red.png'" onMouseOut="this.src='/images/boutons/navprev20.png'"/></a>
        <?php } else { ?>
            <img src="/images/boutons/navprev20.png" alt="Page précédente" onMouseOver="this.src='/images/boutons/navprev20red.png'" onMouseOut="this.src='/images/boutons/navprev20.png'"/>
        <?php } ?>

        <?php foreach($famillesPager->getLinks(10) as $link) { ?>
            <?php if ($link == $famillesPager->getPage()) { ?>
                <p id="current"><?php echo $link ?></p>
            <?php } else { ?>
                <a href="<?php echo url_for('@Famille?page='.$link)?>" ><?php echo $link ?></a>
            <?php } ?>
        <?php } ?>


        <!-- Affichage de l'image page suivante -->
        <?php if ($famillesPager->getPage() == $famillesPager->getLastPage()) { ?>
            <img src="/images/boutons/navnext20.png" alt="Page suivante" onMouseOver="this.src='/images/boutons/navnext20red.png'" onMouseOut="this.src='/images/boutons/navnext20.png'"/>
            <img src="/images/boutons/navlast20.png" alt="Dernière page" onMouseOver="this.src='/images/boutons/navlast20red.png'" onMouseOut="this.src='/images/boutons/navlast20.png'"/>
        <?php } else { ?>
            <a href="<?php echo url_for('@Famille?page='.$famillesPager->getNextPage())?>" ><img src="/images/boutons/navnext20.png" alt="Page suivante" onMouseOver="this.src='/images/boutons/navnext20red.png'" onMouseOut="this.src='/images/boutons/navnext20.png'"/></a>
            <a href="<?php echo url_for('@Famille?page='.$famillesPager->getLastPage())?>" ><img src="/images/boutons/navlast20.png" alt="Dernière page" onMouseOver="this.src='/images/boutons/navlast20red.png'" onMouseOut="this.src='/images/boutons/navlast20.png'"/></a>
        <?php } ?>
    <?php } ?>
</div>
<div id="boutons">
   <?php if ((isset($logement)) OR (isset($adresse))) { ?><a class="btnLightBlue" href="<?php echo url_for('famille/index') ?>"><img class="iconebtn16" alt="Réinitialiser" src="/images/boutons/undo.png"/>Réinitialiser</a><?php } ?>
   <a class="btnGreen" href="<?php echo url_for('famille/new') ?>"><img class="iconebtn16" alt="Créer une nouvelle famille" src="/images/boutons/plus.png"/>Nouveau</a>
</div>