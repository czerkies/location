<h1>Recherche</h1>
<div class="form_recherche">
  <h2>Zone de recherche</h2>
  <form class="" action="" method="post">
    <?= controleursProduit::champs_date('recherche_date', '', NULL); ?>
    <label for="categorie">Rechercher par categorie</label>
    <select id="categorie" name="categorie">
      <option value="all">Toutes categories</option>
      <?php foreach ($listeCategories as $value) { ?>
        <option value="<?= $value; ?>" <?php if(isset($_POST['categorie']) && $_POST['categorie'] === $value) echo 'selected'?>>
          <?= ucfirst($value); ?>
        </option>
      <?php } ?>
    </select>
    <label for="keyword">Affiner la recherche avec un mot clef :</label>
    <input type="text" name="keyword" id="keyword" placeholder="Mot clef" value="<?php if(isset($_POST['keyword'])) echo $_POST['keyword']; ?>">
    <input type="submit" value="Rechercher">
  </form>
  <div class="reponse-recherche">
  <?php if($produits){ ?>
    <p>Nombres de résultats : <?= $produits['nbProduits']; ?>
    <?php if(!$produits['nbProduits']) { ?>
    <p>Aucune produits de correspond à votre recherche.</p>
    <? } else { ?>
    <?php foreach ($produits['listeProduits'] as $value) { ?>
      <hr>
      <div class="une-salle">
        <p><?= $value['titre']; ?></p>
        <p><?= $value['ville']; ?> - <?= $value['pays']; ?></p>
        <p><?= $value['categorie']; ?></p>
        <p><?= $value['capacite']; ?></p>
        <p><?= $value['date_arrivee']; ?></p>
        <p><?= $value['date_depart']; ?></p>
        <p><img src="<?= $value["photo"]; ?>"></p>
        <?php if($userConnect){ ?>
          <p><a href="routeur.php?controleurs=produit&action=affichagePanier&id_produit=<?= $value['id_produit']; ?>">Ajouter au panier</a></p>
        <?php } else { ?>
          <p><a href="routeur.php?controleurs=membre&action=connexionMembre">Connectez vous pour l'ajouter au panier</a></p>
        <?php } ?>
      </div>
      <hr>
    <?php } ?>

  <?php }
      } ?>
  </div>
</div>
