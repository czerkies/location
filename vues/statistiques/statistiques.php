<?php if($userConnectAdmin){ $i=1; ?>
<h1>Statisques</h1>
<div class="menu_page_active">
  <ul>
    <li><a href="routeur.php?controleurs=statistiques&action=affichageStatistiques&top=cinqNotes">Top 5 des salles les mieux notés</a></li>
    <li><a href="routeur.php?controleurs=statistiques&action=affichageStatistiques&top=cinqVendues">Top 5 des salles les plus vendues</a></li>
    <li><a href="routeur.php?controleurs=statistiques&action=affichageStatistiques&top=cinqMembresQuantite">Top 5 des membres qui achète le plus</a></li>
    <li><a href="routeur.php?controleurs=statistiques&action=affichageStatistiques&top=cinqMembresPrix">Top 5 des membres qui achète le plus cher</a></li>
  </ul>
</div>
<div>
  <?php if($cinqNotes){ ?>
  <h2>Top 5 des salles les mieux notés</h2>
  <table>
    <theah>
      <th></th>
      <th>ID Salle</th>
      <th>Titre</th>
      <th>Note</th>
    </thead>
    <tbody>
      <?php foreach($cinqNotes as $note) { ?>
        <tr>
          <td><?= $i; $i++; ?></td>
          <td><?= $note['id_salle']; ?></td>
          <td><?= $note['titre']; ?></td>
          <td><?= round($note['note'], 2); ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php } if($cinqVendues){ ?>
  <h2>Top 5 des salles les plus vendues</h2>
  <table>
    <thead>
      <th></th>
      <th>Titre de la salle</th>
      <th>ID Salle</th>
      <th>Nombre commandé</th>
    </thead>
    <tbody>
      <?php foreach ($cinqVendues as $vendues) { ?>
        <tr>
          <td><?= $i; $i++; ?></td>
          <td><?= $vendues['titre']; ?></td>
          <td><?= $vendues['id_salle']; ?></td>
          <td><?= $vendues['nbcommande']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php } if($cinqMembresQuantite){ ?>
  <h2>Top 5 des membres qui achète le plus</h2>
  <table>
    <thead>
      <th></th>
      <th>Prénom</th>
      <th>Nom</th>
      <th>Nombre de produits achetés</th>
    </thead>
    <tbody>
      <?php foreach ($cinqMembresQuantite as $quantite) { ?>
        <tr>
          <td><?= $i; $i++; ?></td>
          <td><?= $quantite['prenom']; ?></td>
          <td><?= $quantite['nom']; ?></td>
          <td><?= $quantite['nbproduit']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php } if($cinqMembresPrix){ ?>
  <h2>Top 5 des membres dépensant le plus</h2>
  <table>
    <thead>
      <th></th>
      <th>Prénom</th>
      <th>Nom</th>
      <th>Total</th>
    </thead>
    <tbody>
      <?php foreach ($cinqMembresPrix as $total) { ?>
        <tr>
          <td><?= $i; $i++; ?></td>
          <td><?= $total['prenom']; ?></td>
          <td><?= $total['nom']; ?></td>
          <td><?= round($total['total'], 2); ?> €</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php } ?>
</div>
<?php } else { ?>
<p>Vous n'avez pas accès à cette page</p>
<?php } ?>
