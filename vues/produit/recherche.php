<h1>Recherche</h1>
<div class="form_recherche">
  <h2>Zone de recherche</h2>
  <form class="" action="" method="post">
    <?= controleursProduit::champs_date('recherche_date', '', NULL); ?>
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
        <p><?= $value['ville']; ?></p>
        <p><?= $value['capacite']; ?></p>
        <p><?= $value['date_arrivee']; ?></p>
        <p><?= $value['date_depart']; ?></p>
        <p><img src="<?= $value['date_arrive']; ?>"></p>
      </div>
      <hr>
    <?php } ?>

  <?php }
      } ?>
  </div>
</div>
