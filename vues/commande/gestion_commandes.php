<div class="">
  <?php if($userConnectAdmin){ ?>
  <h1>Gestions des commandes</h1>
  <?php if($detailsCommandeDisplay){ ?>
    <div class="">
      <p>Numéro de commande : <?php if(isset($_GET['details_commande'])) echo $_GET['details_commande']; ?>.</p>
      <?php if($client) { ?>
      <p>Client : <?= strtoupper($client['nom']); ?> <?= ucfirst($client['prenom']); ?>.</p>
      <p>Adresse : <?= $client['adresse']; ?>, <?= $client['cp']; ?> <?= $client['ville']; ?>.</p>
      <p>Commande passé le <?= $client['date_commande']; ?>.</p>
      <p>Montant : <?= $client['montant']; ?> € TTC.</p>
      <?php } ?>
    </div>
    <table border="1">
      <thead>
        <th>ID Produit</th>
        <th>Prix</th>
        <th>Date</th>
        <th>ID Salle</th>
        <th>Titre</th>
        <th>Ville</th>
      </thead>
      <tbody>
      <?php foreach ($detailsCommandeID as $value) { ?>
        <tr>
          <td><?= $value['id_produit']; ?></td>
          <td><?= $value['prix']*= 1.20; ?> € TTC</td>
          <td>Du <?= $value['date_arrivee']; ?> au <?= $value['date_depart']; ?></td>
          <td><?= $value['id_salle']; ?></td>
          <td><?= $value['titre']; ?></td>
          <td><?= $value['ville']; ?></td>
        </tr>
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
  <?php } ?>
</div>
