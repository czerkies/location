<div class="">
  <?php if($userConnectAdmin){ ?>
  <h1>Gestions des membres</h1>
  <?= $msg; ?>
  <table border="1">
    <thead>
      <th>ID Membre</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Statut</th>
      <th>Sexe</th>
      <th>Supprimer</th>
    </thead>
    <tbody>
      <?php foreach ($listeMembres as $value) { ?>
        <tr>
          <td><?= $value['id_membre']; ?></td>
          <td><?= strtoupper($value['nom']); ?></td>
          <td><?= ucfirst($value['prenom']); ?></td>
          <td><?= $value['statut']; ?></td>
          <td><?= $value['sexe']; ?></td>
          <td><?php if($value['statut'] == 0) { ?>
            <a href="routeur.php?controleurs=membre&action=gestionMembres&suppMembre=<?= $value['id_membre']; ?>">X</a></td>
            <?php } ?>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="">
    <p>Création d'un compte admin</p>
  </div>
  <?php } ?>
</div>
