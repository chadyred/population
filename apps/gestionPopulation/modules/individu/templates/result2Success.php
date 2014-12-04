<?php use_helper('Date'); ?>
<?php $sf_user->setCulture('fr_FR');?>
<h1>Résultats de la recherche sur les individus (<?php echo $nbIndividu; ?>)
<br />Nombre de familles (<?php echo $nbFamille; ?>)
<br />Nombre de logements  (<?php echo $nbLogement; ?>)
</h1>

<?php if ($individusPager->getNbResults() > 0){ ?>
<table id="liste">
    <tr>
        <th>Id</th>
        <th>Nom naissance</th>
        <th>Nom usage</th>
        <th>Prenoms</th>
        <th>Titre</th>
        <th>Sexe</th>
        <th>Date naissance</th>
        <th>Ville naissance</th>
        <th>Situation familiale</th>
        <th>Chef famille</th>
        <th>Adresse</th>
        <th>Id famille</th>
        <th>Secteur</th>
    </tr>
    <?php


    foreach ($individusPager->getResults() as $individu)
    {

                //S'il est présent dans le secteur on affiche ce dernier
                if($individu->getIndividuPresentDansSecteur() == true)
                {
                    ?>

                    <tr>
                        <td><a class="darkcyan" href="<?php echo url_for('individu/show?id=' . $individu->getId()) ?>"><?php echo $individu->getId() ?></a></td>
                        <td><?php echo $individu->getNomNaissance() ?></td>
                        <td><?php echo $individu->getNomUsage() ?></td>
                        <td><?php echo $individu->getPrenoms() ?></td>
                        <td><?php echo $individu->getTitre() ?></td>
                        <td><?php echo $individu->getSexe() ?></td>
                        <td><?php echo format_date($individu->getDateNaissance(), "dd/MM/yyyy") ?></td>
                        <td><?php echo $individu->getVilleNaissance()->getVille() ?></td>
                        <td><?php echo $individu->getSituationFamiliale() ?></td>
                        <td><?php echo $individu->getChefFamille() == 1 ? "Oui" : "Non" ?></td>
                        <td><?php echo $individu->getAdresseComplete() ?></td>
                        <td><?php echo $individu->getIdFamille() ?> <a class="darkcyan" href="<?php echo url_for("famille/show?id=" . $individu->getIdFamille()) ?>" >Voir famille</a></td>
                         <td><a class="darkcyan" href="<?php echo url_for("individu/listeSecteur?rue=" . $individu->getFamille()->getLogement()->getAdresse()->getRue()->getId()."&numrue=".$individu->getFamille()->getLogement()->getAdresse()->getNumeroRue()) ?>" >Voir secteur</a></td>
                    </tr>
            <?php
                    }
           }
          ?>
</table>
<?php } else { ?>
    <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucun résultat</h3>
<?php } ?>

<?php if ($individusPager->haveToPaginate()) { ?>
    <div id="navigation">
        <?php include_partial('navigation', array('pager' => $individusPager)) ?>
    </div>
<?php } ?>

<div id="boutons">
    <a class="btnLightBlue" href="<?php echo url_for('@Individu') ?>"><img class="iconebtn16" alt="Retour" src="/images/boutons/back.png"/>Retour</a>
    <a class="btnLightBlue" href="<?php echo url_for('@Individu_search2') ?>"><img class="iconebtn16" alt="Effectuer une recherche" src="/images/boutons/search16.png"/>Beta test - Nouvelle recherche</a>
    <a class="btnYellow" href="<?php echo url_for('@Individu_exportResults2') ?>"><img class="iconebtn16" alt="Exporter les résultats" src="/images/boutons/download.png"/>Beta test - Exporter résultats</a>
</div>





