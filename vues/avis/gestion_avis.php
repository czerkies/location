<div class="">
  <h1>Gestions des avis</h1>
  <table border="1">
    <thead>
      <th>Salle</th>
      <th>Nom</th>
      <th>Commentaire</th>
      <th>Note</th>
      <th>Date de l'avis</th>
      <th>Supprimer</th>
    </thead>
    <tbody>
      <?php foreach ($listeAvis as $value) { ?>
        <tr>
          <td><?= $value['id_salle']; ?></td>
          <td><?= $value['prenom']; ?></td>
          <td><?= $value['commentaire']; ?></td>
          <td><?= $value['note']; ?>/10</td>
          <td><?= $value['date']; ?></td>
          <td><a href="routeur.php?controleurs=avis&action=gestionAvis&supp=<?= $value['id_avis']; ?>">X</a></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>