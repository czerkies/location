<div class="form_recherche">
  <h2>Zone de recherche</h2>
  <form action="" method="post">
    <div class="form-group date">
      <?= $date->champs_date('recherche_date', '', NULL, 'Recherche par date'); ?>
    </div>
    <div class="form-group">
      <label for="categorie">Rechercher par categorie</label>
      <select id="categorie" name="categorie">
        <option value="all">Toutes categories</option>
        <?php foreach ($listeCategories as $value) { ?>
          <option value="<?= $value; ?>" <?php if(isset($_POST['categorie']) && $_POST['categorie'] === $value) echo 'selected'?>>
            <?= ucfirst($value); ?>
          </option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group large">
      <label for="keyword">Mot clef :</label>
      <input type="text" name="keyword" id="keyword" placeholder="Mot clef" value="<?php if(isset($_POST['keyword'])) echo $_POST['keyword']; ?>" autofocus>
    </div>
    <input type="submit" value="Rechercher">
  </form>
  <div class="reponse-recherche">
  <?php if($produits){ ?>
    <h2>Nombres de résultats : <?= $produits['nbProduits']; ?></h2>
    <?php if(!$produits['nbProduits']) { ?>
    <h3>Aucun produit ne correspond à votre recherche.</h3>
    <? } else { ?>
    <?php foreach ($produits['listeProduits'] as $produitFiche) {
        include 'produitFiche.php';
        }
      }
    } ?>
  </div>
</div>
