<h1>Reservation en détails</h1>
<div id="details_salle">
  <h2>Nom de la salle</h2>
  <a href="/lokisalle/www/routeur.php?controleurs=produit&action=affichagePanier&id_produit=<?= $ProduitIDSalle['id_produit']; ?>">Ajouter au panier</a>
  </form>
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
  <?php while ($donnees = $affichageAvis->fetch(PDO::FETCH_ASSOC)) { ?>
    <div class="un_avis">
      <p class="un_avis_note"><?= $donnees['note']; ?>/10</p>
      <p class="un_avis_commentaire"><?= $donnees['commentaire']; ?></p>
      <p class="un_avis_prenom">Posté par <?= $donnees['prenom']; ?> le <?= $donnees['date']; ?>.</p>
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
      <?php for($i=0;$i<=10;$i++) {
        echo '<option value="'.$i.'">'.$i.'</option>';
      } ?>
      </select>
      <input type="submit" name="avis" value="Envoyer mon avis">
      <?php
      }
    } else { ?>
      <p><a href="/lokisalle/www/routeur.php?controleurs=membre&action=connexionMembre">Il faut être connecté pour pouvoir déposer un commentaire</a></p>
    <?php } ?>
  </form>
</div>
<div id="details_sugg">
  <h2>Autres suggestion</h2>
  <?php foreach ($suggestions as $value) { ?>
    <div class="suggestion">
      <?= $value['titre']; ?>
      <?= $value['ville']; ?>
      <?= $value['date_arrivee']; ?>
    </div>
  <?php } ?>
</div>
