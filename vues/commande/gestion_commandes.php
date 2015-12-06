<div class="">
  <h1>Gestions des commandes</h1>
  <table border="1">
    <thead>
      <th>ID Commande</th>
      <th>ID Membre</th>
      <th>Montant</th>
    </thead>
    <tbody>
      <?php foreach ($listeCommandes as $value) { ?>
        <tr>
          <td><a href="routeur.php?controleurs=commande&action=gestionCommandes&details_commande=<?= $value['id_commande']; ?>"><?= $value['id_commande']; ?></a></td>
          <td><?= $value['id_membre']; ?></td>
          <td><?= $value['montant']; ?> €</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="">
    <p>Le chiffre d'affaires (CA) de notre société est de : <?= $totalCA; ?> €.</p>
  </div>
</div>
