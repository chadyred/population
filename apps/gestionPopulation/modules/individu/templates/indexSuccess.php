<?php use_helper('Date'); ?>

<h1>Liste des individus 
    <?php if (isset($adresse)) {
        echo "habitant à l'adresse <i><a href=" . url_for('adresse/show') . "/id/" . $adresse->getId() . ">" . $adresse . "</a></i> ";
    } ?>
    (<?php echo $individusPager->getNbResults() ?>)
</h1>

<?php if ($individusPager->getNbResults() > 0){ ?>
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
            <th <?php if($tri2=="id") echo "id='selectionTri'" ?>><a href="<?php echo url_for('individu/index?tri=id&ord='.$ordre); ?>">Id</a></th>
            <th <?php if($tri2=="nomnaissance") echo "id='selectionTri'" ?>><a href="<?php echo url_for('individu/index?tri=nomnaissance&ord='.$ordre); ?>">Nom naissance</a></th>
            <th <?php if($tri2=="nomusage") echo "id='selectionTri'" ?>><a href="<?php echo url_for('individu/index?tri=nomusage&ord='.$ordre); ?>">Nom usage</a></th>
            <th <?php if($tri2=="prenoms") echo "id='selectionTri'" ?>><a href="<?php echo url_for('individu/index?tri=prenoms&ord='.$ordre); ?>">Prenoms</a></th>
            <th <?php if($tri2=="titre") echo "id='selectionTri'" ?>><a href="<?php echo url_for('individu/index?tri=titre&ord='.$ordre); ?>">Titre</a></th>
            <th <?php if($tri2=="sexe") echo "id='selectionTri'" ?>><a href="<?php echo url_for('individu/index?tri=sexe&ord='.$ordre); ?>">Sexe</a></th>
            <th <?php if($tri2=="datenaissance") echo "id='selectionTri'" ?>><a href="<?php echo url_for('individu/index?tri=datenaissance&ord='.$ordre); ?>">Date naissance</a></th>
            <th <?php if($tri2=="idvillenaissance") echo "id='selectionTri'" ?>><a href="<?php echo url_for('individu/index?tri=idvillenaissance&ord='.$ordre); ?>">Ville naissance</a></th>
            <th <?php if($tri2=="situationfamiliale") echo "id='selectionTri'" ?>><a href="<?php echo url_for('individu/index?tri=situationfamiliale&ord='.$ordre); ?>">Situation familiale</a></th>
            <th <?php if($tri2=="cheffamille") echo "id='selectionTri'" ?>><a href="<?php echo url_for('individu/index?tri=cheffamille&ord='.$ordre); ?>">Chef famille</a></th>
            <th>Adresse</th>
            <th <?php if($tri2=="idfamille") echo "id='selectionTri'" ?>><a href="<?php echo url_for('individu/index?tri=idfamille&ord='.$ordre); ?>">Id famille</a></th>
            <th>Secteur</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($individusPager->getResults() as $individu): ?>
            <tr>
                <td><a href="<?php echo url_for('individu/show?id=' . $individu->getId()) ?>"><?php echo $individu->getId() ?></a></td>
                <td><?php echo $individu->getNomNaissance() ?></td>
                <td><?php echo $individu->getNomUsage() ?></td>
                <td><?php echo $individu->getPrenoms() ?></td>
                <td><?php echo $individu->getTitre() ?></td>
                <td><?php echo $individu->getSexe() ?></td>
                <td><?php echo format_date($individu->getDateNaissance(), "dd/MM/yyyy") ?></td>
                <td><?php echo $individu->getVilleNaissance()->getVille() ?></td>
                <td><?php echo $individu->getSituationFamiliale() ?></td>
                <td><?php echo $individu->getChefFamille() == 1 ? "Oui" : "Non" ?></td>
                <td><a href="<?php echo url_for('individu/index?adr=' . $individu->getFamille()->getLogement()->getIdAdresse()) ?>"><?php echo $individu->getAdresseComplete() ?></a></td>
                <td><?php if($individu->getIdFamille()) {?><?php echo $individu->getIdFamille() ?> <a class="darkcyan" href="<?php echo url_for("famille/show?id=" . $individu->getIdFamille()) ?>" >Voir famille</a><?php }?></td>
                <td><a class="darkcyan" href="<?php echo url_for("individu/listeSecteur?rue=" . $individu->getFamille()->getLogement()->getAdresse()->getRue()->getId()."&numrue=".$individu->getFamille()->getLogement()->getAdresse()->getNumeroRue()) ?>" >Voir secteur</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php } else { ?>
    <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucun individu</h3>
<?php } ?>

<?php if ($individusPager->haveToPaginate()) { ?>
    <div id="navigation">
        <?php include_partial('navigation', array('pager' => $individusPager)) ?>
    </div>
<?php } ?>

<div id="boutons">
    <?php if (isset($adresse)) { ?><a class="btnLightBlue" href="<?php echo url_for('individu/index') ?>"><img class="iconebtn16" alt="Réinitialiser" src="/images/boutons/undo.png"/>Réinitialiser</a><?php } ?>
    <a class="btnLightBlue" href="<?php echo url_for('@Individu_search') ?>"><img class="iconebtn16" alt="Effectuer une recherche" src="/images/boutons/search16.png"/>Chercher</a>
    <a class="btnLightBlue" href="<?php echo url_for('@Individu_search2') ?>"><img class="iconebtn16" alt="Effectuer une recherche" src="/images/boutons/search16.png"/>Beta test - Chercher</a>
    <a class="btnGreen" href="<?php echo url_for('individu/new') ?>"><img class="iconebtn16" alt="Créer une nouvel individu" src="/images/boutons/plus.png"/>Nouveau</a>
</div>