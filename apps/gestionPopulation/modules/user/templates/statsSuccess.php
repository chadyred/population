<h2>Statistiques</h2>

<?php // Récupère les valeurs des tableaux
    $i=0;
    while ($statsFemme->get($i)) {
        $tabHom[]=$statsHomme->get($i);
        $tabFem[]=$statsFemme->get($i);
        $i++;
    }
?>


<?php // Cette fonction permet de convertir un tableau PHP en tableau JS
    function construisTableauJS($tableauPHP, $nomTableauJS){ 
       echo "var " . $nomTableauJS." = new Array();";
       foreach ( $tableauPHP as $i => $val) {
          if(!is_array($tableauPHP[$i]))	echo $nomTableauJS."['".$i."'] = '".addslashes($tableauPHP[$i])."';";
          else	construisTableauJS($tableauPHP[$i], $nomTableauJS."[".$i."]");
       }
       return;
    }
?>


<?php echo "<script type='text/javascript'>";
    construisTableauJS($tabHom, "statsHomme");
    construisTableauJS($tabFem, "statsFemme");
    echo "</script> ";
?>


<button value="afficher" onClick="displayAndHide('stats'), afficherPyramide(document.getElementById('stats'),statsHomme,statsFemme,<?php echo $popTotale ?>);">Pyramide des âges</button>

<div id="stats" style="display: none;" ></div>