<h2>Toutes nos offres</h2>
<div id="reservation">
  <?php foreach ($lesProduits as $value) { ?>
    <div class="produit">
      <a href="<?= RACINE_SITE ?>nos-salles/reservation-en-details/<?= $value['id_produit']; ?>">
        <h3><?= $value['titre']; ?></h3>
        <p class="image_overflow"><img src="<?= RACINE_SITE.$value['photo']; ?>" alt="<?= $value['titre']; ?>"></p>
        <p class="adresse"><?= $value['ville']; ?>, <?= $value['pays']; ?></p>
        <p class="date_arrivee">Date d'arrivée : <?= $value['date_arrivee']; ?></p>
        <p class="date_depart">Date de départ : <?= $value['date_depart']; ?></p>
        <p class="capacite">Capacité : <?= $value['capacite']; ?></p>
        <p class="prix">Prix : <?= $value['prix']; ?> € HT</p>
      </a>
      <p class="panier">
        <?php if($userConnect){ ?>
        <a href="<?= RACINE_SITE; ?>panier/ajouter/<?= $value['id_produit']; ?>">Ajouter au panier</a>
        <?php } else { ?>
        <a href="<?= RACINE_SITE; ?>connexion/">Se connecter pour l'ajouter au panier</a>
        <?php } ?>
      </p>
    </div>
  <?php } ?>
</div>
