<div class="">
  <h1>Gestions des commandes</h1>
  <?php if($detailsCommandeDisplay){ ?>
    <table border="1">
      <thead>
        <th>ID Commande</th>
        <th>Montant</th>
        <th>Date</th>
        <th>ID Membre</th>
        <th>Pseudo</th>
        <th>ID Produit</th>
        <th>ID Salle</th>
        <th>Ville</th>
      </thead>
        <tbody>
      <?php foreach ($detailsCommandeID as $value) { ?>
          <tr>
            <td><?= $value['id_commande']; ?></td>
            <td><?= $value['montant']; ?></td>
            <td><?= $value['date']; ?></td>
            <td><?= $value['id_membre']; ?></td>
            <td><?= $value['pseudo']; ?></td>
            <td><?= $value['id_produit']; ?></td>
            <td><?= $value['id_salle']; ?></td>
            <td><?= $value['ville']; ?></td>
          <tr>
      <?php } ?>
      </tbody>
    </table>
  <?php } ?>
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
