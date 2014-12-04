<?php use_helper('Date'); ?>
<?php $sf_user->setCulture('fr_FR'); 
?>

<h1>Résultats de la recherche sur les adresses</h1>
<?php if(isset($resultat[0])) 
{?>
<table id="liste">
    <tr>
        <th>Id</th>
        <th>Numero rue</th>
        <th>Complement</th>
        <th>rue</th>
        <th>Nb logements max</th>
        <th>Nb logements occupés</th>
        <th>Nb logements vides</th>
    </tr>

 </thead>
  <tbody>
    <?php  foreach ($resultat as $resultat):  ?>
    <tr>
      <td><a href="<?php echo url_for('adresse/show?id='.$resultat['adresse']) ?>">
          <?php echo $resultat['adresse']; ?></a></td>
      <td><?php echo $resultat["num"]; ?></td>
      <td><?php echo $resultat["complement"]; ?></td>
      <td><?php echo $resultat["nom"]; ?></td>
      <td><?php echo $resultat["nbmax"]; ?></td>
      <td><?php echo $resultat["nblo"];?></td>
      <td><?php echo $resultat["nblogno"]; ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php }
    else
    {?>
   <img src="/images/affichage/error.png" alt="Erreur"/>
    <h3>Aucun résultat</h3>
<?php } ?>
    
<div id="boutons">
     <?php if (isset($rue)) { ?><a class="btnLightBlue" href="<?php echo url_for('adresse/index') ?>"><img class="iconebtn16" alt="Réinitialiser" src="/images/boutons/undo.png"/>Réinitialiser</a><?php } ?>
  <a class="btnGreen" href="<?php echo url_for('adresse/new') ?>"><img class="iconebtn16" alt="Créer une nouvelle adresse" src="/images/boutons/plus.png"/>Nouveau</a>
  
  <a class="btnLightBlue" href="<?php echo url_for('@Adresse_search') ?>"><img class="iconebtn16" alt="Effectuer une recherche" src="/images/boutons/search16.png"/>Chercher</a>
  
</div>