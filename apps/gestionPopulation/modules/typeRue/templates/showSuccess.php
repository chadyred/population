<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $type_rue->getId() ?></td>
    </tr>
    <tr>
      <th>Libelle:</th>
      <td><?php echo $type_rue->getLibelle() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('typeRue/edit?id='.$type_rue->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('typeRue/index') ?>">List</a>
