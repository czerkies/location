<h1>Reservation en détails</h1>
<div id="details_salle">
  <h2>Nom de la salle</h2>
  <?php if($userConnect) { ?>
  <a href="/lokisalle/www/routeur.php?controleurs=panier&action=affichagePanier&id_produit=<?= $ProduitIDSalle['id_produit']; ?>">Ajouter au panier</a>
<?php } else { ?>
  <a href="<?= RACINE_SITE; ?>connexion/">Connectez vous pour l'ajouter au panier</a>
<?php } ?>
  </div>
<div id="datails_complémentaire">
  <h2>Informations complémentaires</h2>
  <?= $ProduitIDSalle['titre'].' | '.$ProduitIDSalle['capacite'].' | '.$ProduitIDSalle['categorie']; ?>
  <?= $ProduitIDSalle['adresse'].' - '.$ProduitIDSalle['cp'].' - '.$ProduitIDSalle['ville'].' <br> '.$ProduitIDSalle['pays'];?>
  <img src="<?= $ProduitIDSalle['photo'] ?>" alt="<?= $ProduitIDSalle['titre']; ?>">
  Prix : <?= $ProduitIDSalle['prix'] = $ProduitIDSalle['prix'] * 1.2; ?> € TTC.
  Date : Du <?= $ProduitIDSalle['date_arrivee']; ?> au <?= $ProduitIDSalle['date_depart']; ?>.
</div>
<div id="details_avis">
  <h2>Avis</h2>
  <?php foreach($affichageAvis as $donnees) { ?>
    <div class="un_avis">
      <p class="un_avis_note"><?= $donnees['note']; ?>/10</p>
      <p class="un_avis_commentaire"><?= $donnees['commentaire']; ?></p>
      <p class="un_avis_prenom">
      <?php if($donnees['id_membre'] === NULL){ ?>
        Posté le <?= ucwords($donnees['date']); ?>.
      <?php } else { ?>
        Posté par <?= $donnees['prenom']; ?> le <?= ucwords($donnees['date']); ?>.
      <?php } ?>
      </p>
    <div>
  <?php } ?>
  <?php
  if($userConnect){
    if($form){
    echo $msg;
    ?>
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
      <?php
      }
    } else { ?>
      <p><a href="<?= RACINE_SITE; ?>connexion/">Il faut être connecté pour pouvoir déposer un commentaire</a></p>
    <?php } ?>
  </form>
</div>
<div id="details_sugg">
  <h2>Autres suggestion</h2>
  <?php foreach ($suggestions as $value) { ?>
    <div class="suggestion">
      <?= $value['titre']; ?>
      <?= $value['ville']; ?>
      <?= $value['date_arrivee']; ?> | <?= $value['date_depart']; ?>
    </div>
  <?php } ?>
</div>
