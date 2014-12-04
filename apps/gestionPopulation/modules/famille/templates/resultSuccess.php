<?php use_helper('Date'); ?>
<?php $sf_user->setCulture('fr_FR'); ?>

<h1>Résultats de la recherche sur les familles (<?php echo $famillesPager->getNbResults() ?>)</h1>

<?php if ($famillesPager->getNbResults() > 0){ ?>
<table id="liste">
    <tr>
        <th>Id (code famille)</th>
        <th>Id logement</th>
        <th>Adresse logement</th>
        <th>Infos complementaires</th>
    </tr>
    <?php foreach ($famillesPager->getResults() as $famille) { ?>
        <?php $a = $famille->getLogement()->getAdresse();
        $l = $famille->getLogement(); ?>
        <tr>
            <td><a href="<?php echo url_for('famille/show?id=' . $famille->getId()) ?>"><?php echo $famille->getId() ?></a></td>
            <td><abbr title="<?php echo $l->getTypeBatiment() . " " . $l->getTypeComplement() . " " . $l->getValeurComplement() ?>"><a href="<?php echo url_for('famille/index?lgt=' . $famille->getIdLogement()) ?>"><?php echo $famille->getIdLogement() ?></a></abbr></td>
            <td><abbr title="<?php echo "Afficher les logement se trouvant à l'adresse " . $a ?>"><a href="<?php echo url_for('famille/index?adr=' . $l->getIdAdresse()) ?>"><?php echo $a ?></a></abbr></td>
            <td><?php echo $famille->getInfosComplementaires() ?></td>
        </tr>
    <?php } ?>

</table>
<?php } else { ?>
    <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucun résultat</h3>
<?php } ?>


<?php if ($famillesPager->haveToPaginate()) {?>
    <div id="navigation">
<?php include_partial('navigation', array('pager' => $famillesPager)) ?>
        </div>
<?php } ?>

<div id="boutons">
    <a class="btnLightBlue" href="<?php echo url_for('@Famille') ?>"><img class="iconebtn16" alt="Retour" src="/images/boutons/back.png"/>Retour</a>
    <a class="btnLightBlue" href="<?php echo url_for('@Famille_search') ?>"><img class="iconebtn16" alt="Effectuer une autre recherche" src="/images/boutons/search16.png"/>Nouvelle recherche</a>
</div>





