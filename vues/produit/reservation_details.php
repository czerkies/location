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

</div>
<div id="details_avis">
  <h2>Avis</h2>
  <?php while ($donnees = $affichageAvis->fetch(PDO::FETCH_ASSOC)) {
    echo $donnees['commentaire'].'<br>';
    echo $donnees['prenom'];
    echo "<hr>";
  } ?>
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
<div id="dateils_sugg">
<h2>Autres suggestion</h2>
</div>
