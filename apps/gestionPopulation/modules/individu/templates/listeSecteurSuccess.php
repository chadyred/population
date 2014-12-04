<h1>Liste des Secteurs pour cette adresse (<?php echo $requete->count(); ?> secteurs)</h1>
<?php if ($requete->count()!=0){ ?>
<table id="liste">
  <thead>
 <th>Id</th>
        <th>Secteur</th>
        <th>Découpage</th>
  </thead>
  <tbody>

<?php        
foreach($requete as $liste) 
         {
             ?>
                 <tr>
                        <td>
                            <a href="<?php echo url_for('secteur/show?id='.$liste->idsecteur) ?>">
              <?php echo $liste->idsecteur; ?>
                            </a>
                        </td>
                         <td>
                                <a href="<?php echo url_for('secteur/show?id='.$liste->idsecteur) ?>">
              <?php echo $liste->libsecteur;?>
                                </a>
                        </td>
                         <td>
                             <a href="<?php echo url_for('decoupage/show?id='.$liste->iddecoupage) ?>">
            <?php echo $liste->libdecoupage; ?>
                             </a>
                        </td>
                </tr>
    <?php } ?>   
  </tbody>
</table>

<?php } else { ?>
    <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucune adresse</h3>
<?php } ?>
    
<div id="boutons">
      <a class="btnLightBlue" href="<?php echo url_for('/individu/index') ?>"><img class="iconebtn16" alt="Retour liste" src="/images/boutons/back.png"/>Retour liste</a>
  <a class="btnLightBlue" href="<?php echo url_for('@Individu_search') ?>"><img class="iconebtn16" alt="Recherche Individu" src="/images/boutons/search16.png"/>Chercher</a>
  
</div>
