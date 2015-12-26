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
      <td><img src="<?= RACINE_SITE.$value['photo']; ?>" alt="<?= $value['titre']; ?>"></td>
      <td><?= $value['date_arrivee']; ?></td>
      <td><?= $value['date_depart']; ?></td>
      <td><?= $value['ville']; ?></td>
      <td><?= $value['prix']; ?></td>
      <td><a href="<?= RACINE_SITE ?>nos-salles/reservation-en-details/<?= $value['id_produit']; ?>">Voir la fiche détaillée</a></td>
      <?php if($userConnect){ ?>
        <td><a href="<?= RACINE_SITE; ?>panier/ajouter/<?= $value['id_produit']; ?>">Ajouter au panier</a></td>
      <?php } else { ?>
        <td><a href="<?= RACINE_SITE; ?>connexion/">Connectez vous pour l'ajouter au panier</a></td>
      <?php } ?>
    </tr>
  <?php } ?>
  </table>
</div>
