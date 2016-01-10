<div class="produit">
    <a href="<?= RACINE_SITE; ?>nos-salles/reservation-en-details/<?= $produitFiche['id_produit']; ?>">
    <h3><?= $produitFiche['titre']; ?></h3>
    <p class="image_overflow"><img src="<?= RACINE_SITE.$produitFiche['photo']; ?>" alt="<?= $produitFiche['titre']; ?>"></p>
    <p class="adresse"><img class="pict" src="<?= RACINE_SITE; ?>pict/localisation.png" alt="Localisation"><?= $produitFiche['ville']; ?>, <?= $produitFiche['pays']; ?>.</p>
    <p class="date_arrivee"><span>Disponible du</span> <?= $produitFiche['date_arrivee']; ?></p>
    <p class="date_depart"><span>au</span> <?= $produitFiche['date_depart']; ?>.</p>
    <p class="date_arrivee"><span>Catégorie :</span> <?= ucfirst($produitFiche['categorie']); ?>.</p>
    <p class="capacite"><span>Capacité :</span> <?= $produitFiche['capacite']; ?> places.</p>
    <p class="prix"><span>Prix :</span> <?= $produitFiche['prix']; ?> € HT</p>
  </a>
  <p class="panier">
    <?php if($userConnect){ ?>
    <a href="<?= RACINE_SITE; ?>panier/ajouter/<?= $produitFiche['id_produit']; ?>"><img src="<?= RACINE_SITE; ?>pict/cart.png" alt="Panier">Ajouter au panier</a>
    <?php } else { ?>
    <a href="<?= RACINE_SITE; ?>connexion/">Se connecter pour l'ajouter au panier</a>
    <?php } ?>
  </p>
</div>
