<?php if($userConnectAdmin){ ?>
<h2>Gestion des produits</h2>
<div id="gestion_produit">
  <ul class="sous-menu-admin">
    <li><a class="bouton-a <?php if($title['menu_admin'] === 201) echo 'active'; ?>" href="<?= RACINE_SITE; ?>admin/gestion-produits/">Affichage des produits</a></li>
    <li><a class="bouton-a <?php if($title['menu_admin'] === 200) echo 'active'; ?>" href="<?= RACINE_SITE; ?>admin/gestion-produits/ajouter/">Ajouter un produit</a></li>
  </ul>
  <?php include '../vues/dialogue.php'; ?>
  <?php if($ajouter || $idProduitModif){ ?>
    <div class="gestion_produit_modifier">
      <form class="" action="" method="post">
        <div class="form-group">
          <label for="id_salle">Salle</label>
          <select id="id_salle" name="id_salle">
            <?php foreach ($affichageSalles as $donneesSalles) { ?>
              <option value="<?= $donneesSalles['id_salle']; ?>" <?php if(isset($_POST['id_salle']) && $_POST['id_salle'] == $donneesSalles['id_salle']) {echo 'selected';}
              elseif(isset($idProduitModif['id_salle']) && $idProduitModif['id_salle'] == $donneesSalles['id_salle']) {echo 'selected';} ?>><?= $donneesSalles['titre'].' - '.$donneesSalles['pays'];?></option>
            <?php } ?>
          </select>
          <em>Sélectionné une salle pour ce produit.</em>
        </div>
        <div class="form-group">
          <label for="code_promo">Code promo</label>
          <select id="code_promo" name="id_promo">
            <option disabled>Choisissez votre code promo</option>
            <option value="0">Aucun code promo</option>
            <?php foreach ($affichagePromo as $promos) { ?>
              <option value="<?= $promos['id_promo']; ?>" <?php if(isset($_POST['id_promo']) && $_POST['id_promo'] == $promos['id_promo']) {echo 'selected';}
              elseif(isset($idProduitModif['id_promo']) && $idProduitModif['id_promo'] == $promos['id_promo']) {echo 'selected';} ?>>Code : <?= $promos['code_promo'].' | Réduction : '.$promos['reduction'];?> €</option>
            <?php } ?>
          </select>
          <em>Code promo facultatif</em>
        </div>
        <div class="form-group date">
          <?= $date->champs_date('date_arrivee', 'date_arrivee', $datebdd = (isset($idProduitModif)) ? $idProduitModif['date_arrivee'] : NULL, 'Date d\'arrivée'); ?>
          <em>Disponibilité du produit</em>
        </div>
        <div class="form-group date">
          <?= $date->champs_date('date_depart', 'date_depart', $datebdd = (isset($idProduitModif)) ? $idProduitModif['date_depart'] : NULL, 'Date de départ'); ?>
          <em>Disponibilité du produit</em>
        </div>
        <div class="form-group">
          <label for="prix">Prix</label>
          <input type="number" name="prix" id="prix" value="<?php if(isset($_POST['prix'])) {echo $_POST['prix'];} elseif(isset($idProduitModif['prix'])) {echo $idProduitModif['prix'];} ?>" placeholder="Prix" required>
          <em>Prix en Euros HT</em>
        </div>
        <?php if($idProduitModif){ ?>
        <input type="hidden" name="id_produit" value="<?= $idProduitModif['id_produit']; ?>">
        <input type="submit" value="Modifier">
        <?php } else { ?>
        <input type="submit" value="Enregistrer">
        <?php } ?>
      </form>
    </div>
  <?php } if($affichageProduitsAdmin) { ?>
    <div class="tableau large">
      <div class="head">
        <p class="title wp5">ID</p>
        <p class="title wp20">Salle</p>
        <p class="title wp15">Arrivée
          <a href="<?= RACINE_SITE; ?>admin/gestion-produits/ordre/date_arrivee/asc#gestion_produit"><img class="order" src="<?= RACINE_SITE; ?>/pict/drop.png" alt="Date arrivée croissante"></a>
          <a href="<?= RACINE_SITE; ?>admin/gestion-produits/ordre/date_arrivee/desc#gestion_produit"><img class="order desc" src="<?= RACINE_SITE; ?>/pict/drop.png" alt="Date arrivée décroissante"></a>
        </p>
        <p class="title wp15">Départ
          <a href="<?= RACINE_SITE; ?>admin/gestion-produits/ordre/date_depart/asc#gestion_produit"><img class="order" src="<?= RACINE_SITE; ?>/pict/drop.png" alt="Date départ croissante"></a>
          <a href="<?= RACINE_SITE; ?>admin/gestion-produits/ordre/date_depart/desc#gestion_produit"><img class="order desc" src="<?= RACINE_SITE; ?>/pict/drop.png" alt="Date départ croissante"></a>
        </p>
        <p class="title wp15">Code promo</p>
        <p class="title wp15">Prix
          <a href="<?= RACINE_SITE; ?>admin/gestion-produits/ordre/prix/asc#gestion_produit"><img class="order" src="<?= RACINE_SITE; ?>/pict/drop.png" alt="Prix croissant"></a>
          <a href="<?= RACINE_SITE; ?>admin/gestion-produits/ordre/prix/desc#gestion_produit"><img class="order desc" src="<?= RACINE_SITE; ?>/pict/drop.png" alt="Prix décroissant"></a>
        </p>
        <p class="title wp5">Etat</p>
        <p class="title wp10">Actions</p>
      </div>
      <ul class="body">
        <?php foreach ($affichageProduitsAdmin as $value) { ?>
          <li>
            <a href="<?= RACINE_SITE; ?>admin/gestion-produits/modification/<?= $value['id_produit']; ?>#gestion_produit">
              <p class="cel wp5"><?= $value['id_produit']; ?></p>
            </a>
            <a href="<?= RACINE_SITE; ?>admin/gestion-salles/modification/<?= $value['id_salle']; ?>#gestion_produit">
              <p class="cel wp20"><?= $value['id_salle']; ?> | <?= $value['titre']; ?></p>
            </a>
            <a href="<?= RACINE_SITE; ?>admin/gestion-produits/modification/<?= $value['id_produit']; ?>#gestion_produit">
              <p class="cel wp15"><?= $value['date_arrivee']; ?></p>
              <p class="cel wp15"><?= $value['date_depart']; ?></p>
              <?php if($value['code_promo'] == NULL){ ?>
              <p class="cel wp15"><em>Aucun</em></p>
              <?php } else { ?>
              <p class="cel wp15"><?= $value['code_promo']; ?></td>
              <?php } ?>
              <p class="cel wp15"><?= $value['prix']; ?> €</p>
              <p class="cel wp5"><?= $value['etat']; ?></p>
              <p class="cel wp5 pict"><img src="<?= RACINE_SITE; ?>/pict/mod.png" alt="Modifier"></p>
            </a>
            <a href="<?= RACINE_SITE; ?>admin/gestion-produits/suppression/<?= $value['id_produit']; ?>#gestion_produit">
              <p class="cel wp5 pict"><img src="<?= RACINE_SITE; ?>/pict/supp.png" alt="Supprimer"></p>
            </a>
          </li>
        <?php } ?>
      </ul>
    </div>
  <?php } ?>
</div>
<?php } else { ?>
  <p>Vous n'avez pas accès à cette page.</p>
<?php } ?>
