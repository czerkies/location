<div id="details_produit">
  <h2>Détails du produit</h2>
    <div class="produit">
      <h3><?= $ProduitIDSalle['titre']; ?></h3>
      <p class="image_overflow">
        <img src="<?= RACINE_SITE.$ProduitIDSalle['photo'] ?>" alt="<?= $ProduitIDSalle['titre']; ?>">
      </p>
      <p class="description"><?= $ProduitIDSalle['description']; ?></p>
      <p class="adresse"><span>Adresse :</span> <?= $ProduitIDSalle['adresse']; ?>, <?= $ProduitIDSalle['ville'].'. '.strtoupper($ProduitIDSalle['pays']); ?>.</p>
      <p class="categorie"><span>Categorie :</span> <?= ucfirst($ProduitIDSalle['categorie']); ?>.</p>
      <p class="date_arrivee"><span>Date d'arrivée :</span> <?= $ProduitIDSalle['date_arrivee']; ?>.</p>
      <p class="date_depart"><span>Date de départ :</span> <?= $ProduitIDSalle['date_depart']; ?>.</p>
      <p class="capacite"><span>Capacité :</span> <?= $ProduitIDSalle['capacite']; ?> places.</p>
      <p class="prix"><span>Prix :</span> <?= $ProduitIDSalle['prix']; /*= $ProduitIDSalle['prix'] * 1.2;*/ ?> € HT</p>
      <p class="panier">
      <?php if($userConnect) { ?>
        <a href="<?= RACINE_SITE; ?>panier/ajouter/<?= $ProduitIDSalle['id_produit']; ?>">Ajouter au panier</a>
      <?php } else { ?>
        <a href="<?= RACINE_SITE; ?>connexion/">Connectez vous pour l'ajouter au panier</a>
      <?php } ?>
      </p>
    </div>
</div>
<div id="avis_produit">
  <h2>Avis</h2>
  <div class="autoscoll">
  <?php if($userConnect){
    if(!empty($msg)) { ?>
      <div class="form-group erreur large">
        <label><img src="<?= RACINE_SITE; ?>pict/info.png" alt="Erreur"> Erreur(s)</label>
        <p>
          <?= $msg; ?>
        </p>
      </div>
    <?php } if($confirmation) { ?>
      <div class="form-group ok large">
        <label><img src="<?= RACINE_SITE; ?>pict/info.png" alt="Information">Confirmation</label>
        <p>Votre avis a bien été posté.</p>
      </div>
    <?php } if($form){ ?>
    <form class="" action="#avis_produit" method="post">
      <div class="form-group large">
        <label for="commentaire">Ajouter un avis</label>
        <textarea name="commentaire" id="commentaire" placeholder="Laissez votre avis sur la salle..."></textarea>
        <em>Votres avis doit comporter entre 4 et 450 carractères.</em>
      </div>
      <div class="form-group large">
        <label for="note">Note</label>
        <select name="note" id="note">
        <option disabled>Note</option>
        <?php for($i=0;$i<=10;$i++) { ?>
          <option value="<?= $i; ?>"<?php
            if(isset($_POST['note']) && $_POST['note'] == $i) echo ' selected';
          ?>><?= $i; ?></option>
        <?php } ?>
        </select>
      </div>
      <input type="submit" name="avis" value="Envoyer mon avis">
    </form>
    <?php }
    } else { ?>
    <p><a href="<?= RACINE_SITE; ?>connexion/">Il faut être connecté pour pouvoir déposer un avis.</a></p>
    <?php } ?>
    <?php foreach($affichageAvis as $donnees) { ?>
    <div class="tableau large">
      <div class="head">
        <div class="title wp80">
          <?php if($donnees['id_membre'] === NULL){ ?>
            Le <?= ucwords($donnees['date']); ?>.
          <?php } else { ?>
            <?= $donnees['prenom']; ?>, le <?= ucwords($donnees['date']); ?>.
          <?php } ?>
        </div>
        <div class="title wp20"><?= $donnees['note']; ?>/10</div>
      </div>
      <ul class="body">
        <li>
          <p class="cel wp100a"><?= $donnees['commentaire']; ?></p>
        </li>
      </ul>
    </div>
    <?php } ?>
  </div>
</div>
<div id="details_sugg">
  <h2>Autres suggestion</h2>
  <?php foreach ($suggestions as $value) { ?>
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
