<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('famille/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <hr/>
          <div id="boutons">
              <?php if (!$form->getObject()->isNew()){ ?>
                  <?php echo link_to('<abbr title="Supprime la famille"><img class="iconebtn16" alt="Supprimer" src="/images/boutons/delete.png"/>Supprimer</abbr>', 'famille/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Confirmer la suppression?\nLa suppression de la famille va entraîner la suppression des individus liés à cette famille!')) ?>
                  <a class="btnLightBlue" href="<?php echo url_for('famille/show?id='.$form->getObject()->getId())?>"><abbr title="Annuler les modifications"><img class="iconebtn16" alt="Retour" src="/images/boutons/undo.png"/>Retour</abbr></a>
              <?php }else{ ?>
                  &nbsp;<a class="btnLightBlue" href="<?php echo url_for('famille/index') ?>"><abbr title="Retour à la liste des familles"><img class="iconebtn16" alt="Retour liste" src="/images/boutons/back.png"/>Retour liste</abbr></a>
              <?php } ?>
              <abbr title="Enregistrer les modifications"><input class="btnGreen" id="submit" type="submit" value="Enregistrer"/></abbr>
          </div>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
