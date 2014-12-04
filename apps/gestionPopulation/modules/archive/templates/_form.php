<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('archive/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
                  <?php echo link_to('<abbr title="Supprime l\'archive"><img class="iconebtn16" alt="Supprimer" src="/images/boutons/delete.png"/>Supprimer</abbr>', 'archive/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Confirmer la suppression?')) ?>
                  <a class="btnLightBlue" href="<?php echo url_for('archive/show?id='.$form->getObject()->getId())?>"><abbr title="Annuler les modifications"><img class="iconebtn16" alt="Retour" src="/images/boutons/undo.png"/>Retour</abbr></a>
              <?php }else{ ?>
                  &nbsp;<a class="btnLightBlue" href="<?php echo url_for('archive/index') ?>"><abbr title="Retour à la liste des archives"><img class="iconebtn16" alt="Retour liste" src="/images/boutons/back.png"/>Retour liste</abbr></a>
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
