<?php if($userConnectAdmin){ ?>
<h2>Gestion des promotions</h2>
<div id="gestion_promotion">
  <ul class="sous-menu-admin">
    <li><a class="bouton-a <?php if($title['menu_admin'] === 600) echo 'active'; ?>" href="<?= RACINE_SITE; ?>admin/gestion-promotions/">Affichage des codes promos</a></li>
    <li><a class="bouton-a <?php if($title['menu_admin'] === 601) echo 'active'; ?>" href="<?= RACINE_SITE; ?>admin/gestion-promotions/ajouter/">Ajouter un code promotion</a></li>
  </ul>
  <?php include '../vues/dialogue.php'; ?>
    <?php if($donnees){ ?>
      <div id="gestion-promos">
        <?php if($dialogue) { ?>
        <div class="form-group erreur large">
          <label>Attention</label>
          <p>Cette salle est utilisé pour des produits. Êtes-vous sur de vouloir la supprimer ?
            <a class="bouton-a" href="<?= RACINE_SITE; ?>admin/gestion-promotions/supprimer/oui/<?= $_GET['supprimer']; ?>">Oui</a>
            <a class="bouton-a" href="<?= RACINE_SITE; ?>admin/gestion-promotions/">Non</a>
          </p>
        </div>
        <?php } ?>
        <div class="tableau large">
          <div class="head">
            <p class="title wp40">Code Promotion</p>
            <p class="title wp40">Réduction</p>
            <p class="title wp20">Suppréssion</p>
          </div>
          <ul class="body">
            <?php foreach ($donnees as $value) { ?>
              <li>
                <p class="cel wp40"><?= $value['code_promo']; ?></p>
                <p class="cel wp40"><?= $value['reduction']; ?> €</p>
                <p class="cel wp20 pict"><a href="<?= RACINE_SITE; ?>admin/gestion-promotions/supprimer/<?= $value['id_promo']; ?>#gestion-promos"><img src="<?= RACINE_SITE; ?>/pict/supp.png" alt="Supprimer"></a></p>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    <?php } ?>
    <?php if($ajouter){ ?>
      <div class="gestion_produit_ajouter">
        <form class="" action="" method="post">
          <div class="form-group">
            <label for="code_promo">Code promotion</label>
            <input type="text" name="code_promo" id="code_promo" value="<?php if(isset($_POST['code_promo'])) {echo $_POST['code_promo'];} ?>" placeholder="Code promotion" minlength="4" maxlength="6" required>
            <em>Le code promo doit contenir entre 4 et 6 carractères.</em>
          </div>
          <div class="form-group">
            <label for="reduction">Réduction</label>
            <input type="number" name="reduction" id="reduction" min="1" value="<?php if(isset($_POST['reduction'])) {echo $_POST['reduction'];} ?>" placeholder="0000" required>
            <em>La réduction est appliqué en euros (HT).</em>
          </div>
          <input type="submit" value="Créer le code promotion">
        </form>
      </div>
    <?php } ?>
</div>
<?php } ?>
