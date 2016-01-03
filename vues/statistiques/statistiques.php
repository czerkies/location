<?php if($userConnectAdmin){ $i=1; ?>
<h2>Statisques</h2>
<ul class="sous-menu-admin">
  <li><a class="bouton-a <?php if($title['menu_admin'] === 700) echo 'active'; ?>" href="<?= RACINE_SITE; ?>admin/statistiques/salles-mieux-notes/#statistiques">Top 5 des salles les mieux notés</a></li>
  <li><a class="bouton-a <?php if($title['menu_admin'] === 701) echo 'active'; ?>" href="<?= RACINE_SITE; ?>admin/statistiques/salles-plus-vendues/#statistiques">Top 5 des salles les plus vendues</a></li>
  <li><a class="bouton-a <?php if($title['menu_admin'] === 702) echo 'active'; ?>" href="<?= RACINE_SITE; ?>admin/statistiques/membre-quantite/#statistiques">Top 5 des membres qui achète le plus</a></li>
  <li><a class="bouton-a <?php if($title['menu_admin'] === 703) echo 'active'; ?>" href="<?= RACINE_SITE; ?>admin/statistiques/membre-prix/#statistiques">Top 5 des membres qui achète le plus cher</a></li>
</ul>
<div id="statistiques">
  <?php if($cinqNotes){ ?>
  <h2>Top 5 des salles les mieux notés</h2>
  <div class="tableau large">
    <div class="head">
      <p class="title wp10"></p>
      <p class="title wp30">ID Salle</p>
      <p class="title wp30">Titre</p>
      <p class="title wp30">Note</p>
    </div>
    <ul class="body">
      <?php foreach($cinqNotes as $note) { ?>
      <li>
        <p class="cel wp10"><b><?= $i; $i++; ?></b></p>
        <p class="cel wp30"><?= $note['id_salle']; ?></p>
        <p class="cel wp30"><?= $note['titre']; ?></p>
        <p class="cel wp30"><?= round($note['note'], 2); ?></p>
      </li>
      <?php } ?>
    </ul>
  </div>
  <?php } if($cinqVendues){ ?>
  <h2>Top 5 des salles les plus vendues</h2>
  <div class="tableau large">
    <div class="head">
      <p class="title wp10"></p>
      <p class="title wp30">Titre de la salle</p>
      <p class="title wp30">ID Salle</p>
      <p class="title wp30">Nombre commandé</p>
    </div>
    <ul class="body">
      <?php foreach ($cinqVendues as $vendues) { ?>
      <li>
        <p class="cel wp10"><b><?= $i; $i++; ?></b></p>
        <p class="cel wp30"><?= $vendues['id_salle']; ?></p>
        <p class="cel wp30"><?= $vendues['titre']; ?></p>
        <p class="cel wp30"><?= $vendues['nbcommande']; ?></p>
      </li>
      <?php } ?>
    </ul>
  </div>
  <?php } if($cinqMembresQuantite){ ?>
  <h2>Top 5 des membres qui achète le plus</h2>
  <div class="tableau large">
    <div class="head">
      <p class="title wp10"></p>
      <p class="title wp30">Prénom</p>
      <p class="title wp30">Nom</p>
      <p class="title wp30">Nombre de produits achetés</p>
    </div>
    <ul class="body">
      <?php foreach ($cinqMembresQuantite as $quantite) { ?>
      <li>
        <p class="cel wp10"><b><?= $i; $i++; ?></b></p>
        <p class="cel wp30"><?= $quantite['prenom']; ?></p>
        <p class="cel wp30"><?= strtoupper($quantite['nom']); ?></p>
        <p class="cel wp30"><?= $quantite['nbproduit']; ?></p>
      </li>
      <?php } ?>
    </ul>
  </div>
  <?php } if($cinqMembresPrix){ ?>
  <h2>Top 5 des membres dépensant le plus</h2>
  <div class="tableau large">
    <div class="head">
      <p class="title wp10"></p>
      <p class="title wp30">Prénom</p>
      <p class="title wp30">Nom</p>
      <p class="title wp30">Total</p>
    </div>
    <ul class="body">
      <?php foreach ($cinqMembresPrix as $total) { ?>
      <li>
        <p class="cel wp10"><b><?= $i; $i++; ?></b></p>
        <p class="cel wp30"><?= $total['prenom']; ?></p>
        <p class="cel wp30"><?= strtoupper($total['nom']); ?></p>
        <p class="cel wp30"><?= round($total['total'], 2); ?> €</p>
      </li>
      <?php } ?>
    </ul>
  </div>
  <?php } ?>
</div>
<?php } ?>
