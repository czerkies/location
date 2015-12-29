  <?php if(!empty($msg)) { ?>
    <div class="form-group erreur large">
      <label>Erreur(s)</label>
      <p>
        <?= $msg; ?>
      </p>
    </div>
  <?php } if($confirmation) { ?>
    <div class="form-group ok large">
      <label>Confirmation</label>
      <p>Votre avis a bien été posté.</p>
    </div>
  <?php } ?>
<div id="details_produit">
  <h2>Détails du produit</h2>
    <div class="produit">
    <h3><?= $ProduitIDSalle['titre']; ?></h3>
    <p><?= $ProduitIDSalle['capacite'].' | '.$ProduitIDSalle['categorie']; ?>
    <?= $ProduitIDSalle['adresse'].' - '.$ProduitIDSalle['cp'].' - '.$ProduitIDSalle['ville'].' <br> '.$ProduitIDSalle['pays'];?>
    <img src="<?= $ProduitIDSalle['photo'] ?>" alt="<?= $ProduitIDSalle['titre']; ?>">
    Prix : <?= $ProduitIDSalle['prix'] = $ProduitIDSalle['prix'] * 1.2; ?> € TTC.
    Date : Du <?= $ProduitIDSalle['date_arrivee']; ?> au <?= $ProduitIDSalle['date_depart']; ?>.</p>
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
  <?php foreach($affichageAvis as $donnees) { ?>
  <div class="tableau">
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
        <p class="cel"><?= $donnees['commentaire']; ?></p>
      </li>
    </ul>
  </div>
  <?php } ?>
  <?php if($userConnect){
    if($form){
    echo $msg; ?>
    <form class="" action="" method="post">
      <label for="commentaire">Ajouter un commentaire</label>
      <textarea name="commentaire" id="commentaire" placeholder="Laissez votre avis sur la salle..."></textarea>
      <label for="note">Note</label>
      <select name="note" id="note">
      <option disabled>Note</option>
      <?php for($i=0;$i<=10;$i++) { ?>
        <option value="<?= $i; ?>"<?php
          if(isset($_POST['note']) && $_POST['note'] == $i) echo ' selected';
        ?>><?= $i; ?></option>
      <?php } ?>
      </select>
      <input type="submit" name="avis" value="Envoyer mon avis">
      <?php }
    } else { ?>
      <p><a href="<?= RACINE_SITE; ?>connexion/">Il faut être connecté pour pouvoir déposer un commentaire</a></p>
    <?php } ?>
  </form>
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
