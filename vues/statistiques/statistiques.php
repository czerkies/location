<?php if($userConnectAdmin){ ?>
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
    <tbody>
      <?php foreach ($cinqNotes as $value) { ?>
        <tr>
          <td><?= $value['id_salle']; ?></td>
          <td><?= $value['titre']; ?></td>
          <td><?= $value['note']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php } //if($cinqVendues){ ?>
  <h2>Top 5 des salles les plus vendues</h2>

  <?php //} if($cinqMembresQuantite){ ?>
  <h2>Top 5 des membres qui achète le plus</h2>

  <?php //} if($cinqMembresPrix){ ?>
  <h2>Top 5 des membres qui achète le plus cher</h2>

  <?php //} ?>
</div>
<?php } else { ?>
<p>Vous n'avez pas accès à cette page</p>
<?php } ?>
