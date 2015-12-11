<h1>Réservations</h1>
<h2>Toutes nos offres</h2>
<div id="reservation">
  <table border="1">
    <thead>
      <tr>
        <th>Titre</th>
        <th>Ville</th>
        <th>Photo</th>
        <th>Date d'arrivée</th>
        <th>Date de départ</th>
        <th>Ville</th>
        <th>Prix</th>
        <th>Détails</th>
        <th>Ajouter</th>
      </tr>
    </thead>
  <?php foreach ($lesProduits as $value) { ?>
    <tr>
      <td><?= $value['titre']; ?></td>
      <td><?= $value['ville']; ?></td>
      <td><img src="<?= $value['photo']; ?>" alt="<?= $value['titre']; ?>"></td>
      <td><?= $value['date_arrivee']; ?></td>
      <td><?= $value['date_depart']; ?></td>
      <td><?= $value['ville']; ?></td>
      <td><?= $value['prix']; ?></td>
      <td><a href="routeur.php?controleurs=produit&action=reservationDetails&id_produit=<?= $value['id_produit']; ?>">Voir la fiche détaillée</a></td>
      <?php if($userConnect){ ?>
        <td><a href="routeur.php?controleurs=panier&action=affichagePanier&id_produit=<?= $value['id_produit']; ?>">Ajouter au panier</a></td>
      <?php } else { ?>
        <td><a href="routeur.php?controleurs=membre&action=connexionMembre">Connectez vous pour l'ajouter au panier</a></td>
      <?php } ?>
    </tr>
  <?php } ?>
  </table>
</div>
