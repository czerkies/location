<div class="form_recherche">
  <h2>Zone de recherche</h2>
  <form class="" action="" method="post">
    <?= $date->champs_date('recherche_date', '', NULL); ?>
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
    <input type="text" name="keyword" id="keyword" placeholder="Mot clef" value="<?php if(isset($_POST['keyword'])) echo $_POST['keyword']; ?>" autofocus>
    <input type="submit" value="Rechercher">
  </form>
  <div class="reponse-recherche">
  <?php if($produits){ ?>
    <p>Nombres de résultats : <?= $produits['nbProduits']; ?>
    <?php if(!$produits['nbProduits']) { ?>
    <p>Aucun produit ne correspond à votre recherche.</p>
    <? } else { ?>
    <?php foreach ($produits['listeProduits'] as $value) { ?>
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
  <?php }
      } ?>
  </div>
</div>
