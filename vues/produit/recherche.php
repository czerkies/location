<h1>Recherche</h1>
<div class="form_recherche">
  <h2>Zone de recherche</h2>
  <form class="" action="" method="post">
    <?php controleursProduit::champs_date('recherche_date', '', NULL); ?>
    <input type="submit" name="name" value="Rechercher">
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
