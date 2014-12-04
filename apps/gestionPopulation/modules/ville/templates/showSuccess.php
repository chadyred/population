<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $ville->getId() ?></td>
    </tr>
    <tr>
      <th>Cp:</th>
      <td><?php echo $ville->getCP() ?></td>
    </tr>
    <tr>
      <th>Ville:</th>
      <td><?php echo $ville->getVille() ?></td>
    </tr>
    <tr>
      <th>Region:</th>
      <td><?php echo $ville->getRegion() ?></td>
    </tr>
    <tr>
      <th>Departement:</th>
      <td><?php echo $ville->getDepartement() ?></td>
    </tr>
    <tr>
      <th>Pays:</th>
      <td><?php echo $ville->getPays() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('ville/edit?id='.$ville->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('ville/index') ?>">List</a>
