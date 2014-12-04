<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('Date'); ?>
<?php $sf_user->setCulture('fr_FR');?>

<h2>Recherche sur les individus</h2>

<form action="individu/result" method="post" class="tableau">
    <div id="tableauSaisie">
        <table>
            <tbody>
                <?php echo $form; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <div id="boutons">
                            <hr />
                            <a class="btnLightBlue" href="<?php echo url_for('@Individu') ?>"><img class="iconebtn16" alt="Retour" src="/images/boutons/back.png"/>Retour</a>
                            <input id="submit" class="btnGreen" type="submit" value="Rechercher" />
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</form>

