<?php if($userConnectAdmin){ ?>
<h1>Gestion des produits</h1>
<div id="gestion_produit">
  <?= $msg; ?>
  <ul>
    <li><a href="/lokisalle/www/routeur.php?controleurs=produitAdmin&action=ajouterProduits">Ajouter un produit</a></li>
    <li><a href="/lokisalle/www/routeur.php?controleurs=produitAdmin&action=afficherProduits">Affichage des produits</a></li>
  </ul>
    <?php if($ajouter){ ?>
      <div class="gestion_produit_ajouter">
        <form class="" action="" method="post">
          <select name="id_salle">
            <?php foreach ($affichageSalles as $donneesSalles) { ?>
              <option value="<?= $donneesSalles['id_salle']; ?>" <?php if(isset($_POST['id_salle']) && $_POST['id_salle'] == $donneesSalles['id_salle']) {echo 'selected';} ?>><?= $donneesSalles['titre'].' - '.$donneesSalles['pays'];?></option>
            <?php } ?>
          </select>
          <label for="date_arrivee">Date d'arrivée :</label>
          <?= controleursProduitAdmin::champs_date('date_arrivee', 'date_arrivee', NULL); ?>
          <label for="date_arrivee">Date d'arrivée :</label>
          <?= controleursProduitAdmin::champs_date('date_depart', 'date_depart', NULL); ?>
          <label for="prix">Prix :</label>
          <input type="text" name="prix" id="prix" value="<?php if(isset($_POST['prix'])) {echo $_POST['prix'];} ?>" placeholder="Prix" required> €
          <label for="code_promo">Attribution remise parmi les codes promots existant : </label>
          <select name="id_promo">
            <option disabled>Choisissez votre code promo</option>
            <option value="NULL">Aucun code promo</option>
            <?php foreach ($affichagePromo as $value) { ?>
              <option value="<?= $value['id_promo']; ?>" <?php if(isset($_POST['id_promo']) && $_POST['id_promo'] == $value['id_promo']) {echo 'selected';} ?>>Code : <?= $value['code_promo'].' | Réduction : '.$value['reduction'];?> €</option>
            <?php } ?>
          </select>
          <input type="submit" value="Créer le produit">
        </form>
      </div>
    <?php } ?>
    <?php if($afficher){ ?>
      <div class="gestion_produit_afficher">
        <table border="1">
          <thead>
            <tr>
              <th>Produit</th>
              <th>Date arrivée
                <a href="/lokisalle/www/routeur.php?controleurs=produit&action=afficherProduits&type=date_arrivee&order=asc">^</a>
                <a href="/lokisalle/www/routeur.php?controleurs=produit&action=afficherProduits&type=date_arrivee&order=desc">v</a>
              </th>
              <th>Date départ
                <a href="/lokisalle/www/routeur.php?controleurs=produit&action=afficherProduits&type=date_depart&order=asc">^</a>
                <a href="/lokisalle/www/routeur.php?controleurs=produit&action=afficherProduits&type=date_depart&order=desc">v</a>
              </th>
              <th>Salle</th>
              <th>Promo</th>
              <th>Prix
                <a href="/lokisalle/www/routeur.php?controleurs=produit&action=afficherProduits&type=prix&order=asc">^</a>
                <a href="/lokisalle/www/routeur.php?controleurs=produit&action=afficherProduits&type=prix&order=desc">V</a>
              </th>
              <th>État</th>
              <th>Modifier</th>
              <th>Supprimer</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($affichageProduitsAdmin as $value) {
            ?>
            <tr>
              <td><?= $value['id_produit']; ?></td>
              <td><?= $value['date_arrivee']; ?></td>
              <td><?= $value['date_depart']; ?></td>
              <td><?= $value['id_salle']; ?></td>
              <?php if($value['code_promo'] == NULL){ ?>
              <td>Pas de promotion</td>
              <?php } else { ?>
              <td><?= $value['code_promo']; ?></td>
              <?php } ?>
              <td><?= $value['prix']; ?> €</td>
              <td><?= $value['etat']; ?></td>
              <td><a href="/lokisalle/www/routeur.php?controleurs=produit&action=afficherProduits&modif=<?= $value['id_produit']; ?>">Modifier</a></td>
              <td><a href="/lokisalle/www/routeur.php?controleurs=produit&action=afficherProduits&supp=<?= $value['id_produit']; ?>">Supprimer</a></td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
      <?php if($modifSalle){ ?>
        <div class="gestion_produit_modifier">
          <form class="" action="" method="post">
            <select name="id_salle">
              <?php foreach ($affichageSalles as $donneesSalles) { ?>
                <option value="<?= $donneesSalles['id_salle']; ?>" <?php if(isset($_POST['id_salle']) && $_POST['id_salle'] == $donneesSalles['id_salle']) {echo 'selected';}
                elseif(isset($idProduitModif['id_salle']) && $idProduitModif['id_salle'] == $donneesSalles['id_salle']) {echo 'selected';} ?>><?= $donneesSalles['titre'].' - '.$donneesSalles['pays'];?></option>
              <?php } ?>
            </select>
            <label for="date_arrivee">Date d'arrivée :</label>
            <?php var_dump($idProduitModif['date_arrivee']); // A SUPPRIMER EN PROD // ?>
            <?= controleursProduit::champs_date('date_arrivee', 'date_arrivee', $idProduitModif['date_arrivee']); ?>
            <label for="date_arrivee">Date d'arrivée :</label>
            <?= controleursProduit::champs_date('date_depart', 'date_depart', $idProduitModif['date_depart']); ?>
            <label for="prix">Prix :</label>
            <input type="text" name="prix" id="prix" value="<?php if(isset($_POST['prix'])) {echo $_POST['prix'];} elseif(isset($idProduitModif['prix'])) {echo $idProduitModif['prix'];} ?>" placeholder="Prix" required> €
            <label for="code_promo">Attribution remise parmi les codes promots existant : </label>
            <select name="id_promo">
              <option disabled>Choisissez votre code promo</option>
              <option value="NULL">Aucun code promo</option>
              <?php foreach ($affichagePromo as $value) { ?>
                <option value="<?= $value['id_promo']; ?>" <?php if(isset($_POST['id_promo']) && $_POST['id_promo'] == $value['id_promo']) {echo 'selected';}
                elseif(isset($idProduitModif['id_promo']) && $idProduitModif['id_promo'] == $value['id_promo']) {echo 'selected';} ?>>Code : <?= $value['code_promo'].' | Réduction : '.$value['reduction'];?> €</option>
              <?php } ?>
            </select>
            <input type="hidden" name="id_produit" value="<?= $idProduitModif['id_produit']; ?>">
            <input type="submit" value="Modifier le produit">
          </form>
        </div>
    <?php }
    } ?>
</div>
<?php } else { ?>
  <p>Vous n'avez pas accès à cette page.</p>
<?php } ?>
