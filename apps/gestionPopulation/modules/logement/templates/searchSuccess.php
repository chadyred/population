<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('Date'); ?>
<?php $sf_user->setCulture('fr_FR');?>

<h2>Recherche sur les logements</h2>

<!--<form action="logement/result" method="post" class="tableau">-->
<form action="<?php echo url_for('@Logement_result')?>" method="post" class="tableau">
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
                            <a class="btnLightBlue" href="<?php echo url_for('@Logement') ?>">Retour</a>
                            <input id="submit" class="btnGreen" type="submit" value="Rechercher" />
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</form>


