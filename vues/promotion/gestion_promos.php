<?php if($userConnectAdmin){ ?>
<h1>Gestion des promotions</h1>
<div id="gestion_promotion">
  <?= $msg; ?>
  <ul>
    <li><a href="<?= RACINE_SITE; ?>admin/gestion-promotions/ajouter/">Ajouter un code promotion</a></li>
    <li><a href="<?= RACINE_SITE; ?>admin/gestion-promotions/">Affichage des codes promos</a></li>
  </ul>
    <?php if($donnees){ ?>
      <div class="gestion_produit_afficher">
        <table border="1">
          <thead>
            <tr>
              <th>Code Promo</th>
              <th>Reduction</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($donnees as $value) { ?>
            <tr>
              <td><?= $value['code_promo']; ?></td>
              <td><?= $value['reduction']; ?></td>
              <td><a href="<?= RACINE_SITE; ?>admin/gestion-promotions/supprimer/<?= $value['id_promo']; ?>">Supprimer</a></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <?php if($dialogue) { ?>
      <div class="dialogue">
        <p>
          Ce code promo est associés à des produits,<br>
          Êtes-vous sur de vouloir le supprimer ?<br>
          <a href="r<?= RACINE_SITE; ?>admin/gestion-promotions/supprimer/<?= $_GET['supprimer']; ?>/confirmer/oui">Oui</a> | <a href="<?= RACINE_SITE; ?>admin/gestion-promotions/">Non</a>
        </p>
      </div>
      <?php } ?>
    <?php } ?>
    <?php if($ajouter){ ?>
      <div class="gestion_produit_ajouter">
        <form class="" action="" method="post">
          <label for="code_promo">Code promotion :</label>
          <input type="text" name="code_promo" id="code_promo" value="<?php if(isset($_POST['code_promo'])) {echo $_POST['code_promo'];} ?>" placeholder="Code promotion" minlength="4" maxlength="6" required>
          <label for="reduction">Réduction :</label>
          <input type="number" name="reduction" id="reduction" min="1" value="<?php if(isset($_POST['reduction'])) {echo $_POST['reduction'];} ?>" placeholder="0000" required>
          <input type="submit" value="Créer le code promotion">
        </form>
      </div>
    <?php } ?>
</div>
<?php } else {
  echo "Vous n'avez pas accès à cette page.";
}?>
