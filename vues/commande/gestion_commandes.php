<?php if($userConnectAdmin){ ?>
<h2>Gestions des commandes</h2>
<?php if($detailsCommandeDisplay){ ?>
  <div id="details-commandes">
    <div class="tableau large">
      <div class="head">
        <p class="title wp100 wpl">Commande <?php if(isset($_GET['details_commande'])) echo $_GET['details_commande']; ?></p>
      </div>
      <ul class="body">
        <?php if($client) { ?>
        <li>
          <p class="cel wp100">Client : <?= strtoupper($client['nom']); ?> <?= ucfirst($client['prenom']); ?>.</p>
        </li>
        <li>
          <p class="cel wp100">Adresse : <?= $client['adresse']; ?>, <?= $client['cp']; ?> <?= $client['ville']; ?>.</p>
        </li>
        <?php } if($infos){ ?>
        <li>
          <p class="cel wp100">Commande passé le <?= $infos['date_commande']; ?>.</p>
        </li>
        <li>
          <p class="cel wp100">Montant : <?= $infos['montant']; ?> € TTC.</p>
        </li>
        <?php } ?>
      </ul>
    </div>
    <div class="tableau large">
      <div class="head">
        <p class="title wp15">ID Produit</p>
        <p class="title wp10">ID Salle</p>
        <p class="title wp15">Titre</p>
        <p class="title wp20">Ville</p>
        <p class="title wp15">Montant</p>
        <p class="title wp25">Date</p>
      </div>
      <ul class="body">
        <?php foreach ($detailsCommandeID as $value) { ?>
          <li>
            <p class="cel wp15"><?= $value['id_produit']; ?></p>
            <p class="cel wp10"><?= $value['id_salle']; ?></p>
            <p class="cel wp15"><?= $value['titre']; ?></p>
            <p class="cel wp20"><?= $value['ville']; ?></p>
            <p class="cel wp15"><?= $value['prix']*= 1.20; ?> € TTC</p>
            <p class="cel wp25">Du <?= $value['date_arrivee']; ?> au <?= $value['date_depart']; ?></p>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
<?php } ?>
<div class="tableau large">
  <div class="head">
    <p class="title wp25">Numéro de commande</p>
    <p class="title wp25">Membre</p>
    <p class="title wp25">Montant</p>
    <p class="title wp25">Action</p>
  </div>
  <ul class="body">
    <?php foreach ($listeCommandes as $value) { ?>
        <li>
          <a href="<?= RACINE_SITE; ?>admin/gestion-commandes/details-commandes/<?= $value['id_commande']; ?>#details-commandes">
          <p class="cel wp25"><?= $value['id_commande']; ?></p>
          <p class="cel wp25">
            <?php if($value['id_membre'] != NULL) {echo $value['id_membre']; } else {echo '<em>Membre supprimé</em>';} ?>
          </p>
          <p class="cel wp25"><?= $value['montant']; ?> €</p>
          <p class="cel wp25 pict"><img src="<?= RACINE_SITE; ?>pict/det.png" alt="Voir la commande en détails"></p>
        </a>
      </li>
    <?php } ?>
  </ul>
</div>
<div class="form-group ok large">
  <label>Le chiffre d'affaires (CA) de notre société est de :</label>
  <p><b><?= $totalCA; ?> €</b></p>
</div>
<?php } ?>
