<?php use_helper('Date'); ?>
<?php $sf_user->setCulture('fr_FR'); 
?>

<h1>Résultats de la recherche des personnes sur le secteur <?php echo $id ?></h1>
<?php if(isset($resultat[0])) 
{?>
<table id="liste">
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Date de naissance</th>
        <th>N°</th>
        <th> Complement </th>
        <th>Rue</th>
    </tr>

 </thead>
  <tbody>
   
    <?php foreach ($resultat as $resultat):  ?>
    <tr>
      <td>
          <?php echo $resultat['nomusage']; ?></td>
      </td>
       <td>
          <?php echo $resultat['prenom']; ?></td>
      </td>
      <td>
          <?php
          echo substr($resultat['datenaissance'],8,8);
          echo "/";
          echo substr($resultat['datenaissance'],5,2);
          echo "/";
          
          echo substr($resultat['datenaissance'],0,4);
           ?></td>
      </td>
              <td>
          <?php echo $resultat['numerorue']; ?></td>
      </td>
                <td>
          <?php echo $resultat['complement']; ?></td>
      </td>
       <td>
          <?php echo $resultat['nom']; ?></td>
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
   <a class="btnLightBlue" href="<?php echo url_for('secteur/index') ?>"><img class="iconebtn16" alt="Retour liste" src="/images/boutons/back.png"/>Retour liste</a>
     <a class="btnYellow" href="<?php echo url_for('@Secteur_ExportSecteurs?id='.$id) ?>"><img class="iconebtn16" alt="Exporter les résultats" src="/images/boutons/download.png"/>Exporter résultats</a>
</div>