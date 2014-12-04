<?php slot('menu') ?>
<div id="menu">
    <ul>
        <!--<li id="right"><a id="right" href='/accueil' title='Site principal'><span>Retour appli</span></a></li>-->
        <!-- décommenter la ligne ci dessus en usage production normal-->
        <li id="right"><a id="right" href='/gestionPopulation_dev.php/accueil' title='Site principal'><span>Retour appli</span></a></li>
    </ul>
</div>
<?php end_slot(); ?>
<h2>Page d'identification</h2>
<form id="formLogin" action="<?php echo url_for('user/login') ?>" method="post" >
    <input id="login" name="login" type="text" value="login" onFocus="this.value = this.value=='login' ? '' : this.value" onBlur="this.value = this.value=='' ? 'login' : this.value">
    <input id="password" name="password" type="password" value="password" onFocus="this.value = this.value=='password' ? '' : this.value" onBlur="this.value = this.value=='' ? 'password' : this.value">
    <input id="btnLogin" type="submit" value="Se connecter"><br/>
</form>
<hr/>
<div id="boutons">
    <abbr title="Revenir à la page prédédente"><a class="btnLightBlue" href="#" onClick="history.back()">
            <img class="iconebtn16" id="backHome" src="/images/boutons/back.png" alt="Revenir à la page prédédente" />Retour à la page prédédente</a>
    </abbr>
</div>