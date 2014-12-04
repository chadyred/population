<?php use_helper('Date'); ?>

<h1>Liste des individus</h1>

<table id="liste">
    <thead>
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
            <th>Profession</th>
            <th>Date arrivee</th>
            <th>Id famille</th>
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
                <td><?php echo $individu->getProfession() ?></td>
                <td><?php echo format_date($individu->getDateArrivee(), "dd/MM/yyyy") ?></td>
                <td><?php echo $individu->getIdFamille() ?> <a href="<?php echo "famille/show/id/" . $individu->getIdFamille() ?>" >Voir famille</a></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
    <div id="navigation">
        <?php if ($individusPager->haveToPaginate()) {?>
            <!-- Affichage de l'image premiere page -->
            <?php if ($individusPager->getPage() != 1) { ?>
                <a href="<?php echo url_for('@Individu?page=1')?>" ><img src="/images/boutons/navfirst20.png" alt="Première page" onMouseOver="this.src='/images/boutons/navfirst20red.png'" onMouseOut="this.src='/images/boutons/navfirst20.png'"/></a>
            <?php } else { ?>
                <img src="/images/boutons/navfirst20.png" alt="Première page" onMouseOver="this.src='/images/boutons/navfirst20red.png'" onMouseOut="this.src='/images/boutons/navfirst20.png'"/>
            <?php } ?>
            <!-- Affichage de l'image page précédente -->
            <?php if ($individusPager->getPage() != 1) { ?>
                <a href="<?php echo url_for('@Individu?page='.$individusPager->getPreviousPage())?>" ><img src="/images/boutons/navprev20.png" alt="Page précédente" onMouseOver="this.src='/images/boutons/navprev20red.png'" onMouseOut="this.src='/images/boutons/navprev20.png'"/></a>
            <?php } else { ?>
                <img src="/images/boutons/navprev20.png" alt="Page précédente" onMouseOver="this.src='/images/boutons/navprev20red.png'" onMouseOut="this.src='/images/boutons/navprev20.png'"/>
            <?php } ?>

            <?php foreach($individusPager->getLinks(10) as $link) { ?>
                <?php if ($link == $individusPager->getPage()) { ?>
                    <p id="current"><?php echo $link ?></p>
                <?php } else { ?>
                    <a href="<?php echo url_for('@Individu?page='.$link)?>" ><?php echo $link ?></a>
                <?php } ?>
            <?php } ?>
                    
            <!-- Affichage de l'image page suivante -->
            <?php if ($individusPager->getPage() == $individusPager->getLastPage()) { ?>
                <img src="/images/boutons/navnext20.png" alt="Page suivante" onMouseOver="this.src='/images/boutons/navnext20red.png'" onMouseOut="this.src='/images/boutons/navnext20.png'"/>
                <img src="/images/boutons/navlast20.png" alt="Dernière page" onMouseOver="this.src='/images/boutons/navlast20red.png'" onMouseOut="this.src='/images/boutons/navlast20.png'"/>
            <?php } else { ?>
                <a href="<?php echo url_for('@Individu?page='.$individusPager->getNextPage())?>" ><img src="/images/boutons/navnext20.png" alt="Page suivante" onMouseOver="this.src='/images/boutons/navnext20red.png'" onMouseOut="this.src='/images/boutons/navnext20.png'"/></a>
                <a href="<?php echo url_for('@Individu?page='.$individusPager->getLastPage())?>" ><img src="/images/boutons/navlast20.png" alt="Dernière page" onMouseOver="this.src='/images/boutons/navlast20red.png'" onMouseOut="this.src='/images/boutons/navlast20.png'"/></a>
            <?php } ?>
        <?php } ?>
    </div>
    <div id="boutons">
        <a class="btnLightBlue" href="<?php echo url_for('@Individu_search') ?>"><img class="iconebtn16" alt="Effectuer une recherche" src="/images/boutons/search16.png"/>Chercher</a>
        <a class="btnGreen" href="<?php echo url_for('individu/new') ?>"><img class="iconebtn16" alt="Créer une nouvel individu" src="/images/boutons/plus.png"/>Nouveau</a>
    </div>