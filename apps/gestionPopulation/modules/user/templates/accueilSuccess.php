<h2>Page d'accueil</h2>
Bienvenue sur l'application population.<br/><br/>

Vous pouvez acceder aux différentes rubriques an sélectionnant un élément dans le menu.

<div id="infosUpdate">
    <img onClick="toggleElem('modifs','blind');" src="/images/affichage/info.png">
    <u onClick="toggleElem('modifs','blind');">Dernières modifications :</u><br>
    <ul id="modifs" style="display: none">

        <li>Individus : Champs secteur et découpage à vide par défaut dans recherche</li>
        <li>Découpage : Nombre rue -> nombre troncons</li>
        <li>Détail Secteur : Ajout nombre habitants et familles</li>
        <li>Statistiques : Ajout pyramide des âges</li>
        <li>Individus : Liste - Ajout en-têtes colonnes cliquable pour le tri</li>
        <li>Archive : modifications possibles, seule le type de rue doit être renseigné manuellement pour les archives créées avant le 31/08/2012</li>
        <li>Logements : Ajout recherche</li>
    </ul>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#infosUpdate").fadeTo("slow", 0.5); // This sets the opacity of the thumbs to fade down to 60% when the page loads

        $("#infosUpdate").hover(function(){
            $(this).fadeTo("slow", 1.0); // This should set the opacity to 100% on hover
        },function(){
            $(this).fadeTo("slow", 0.5); // This should set the opacity back to 60% on mouseout
        });
    });
</script>