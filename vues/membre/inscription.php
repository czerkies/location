<h2>Inscription</h2>
<?php if($userConnect){ ?>
  <meta http-equiv="refresh" content="0; URL=<?= RACINE_SITE; ?>mon-profil/">
<?php } else { ?>
<div class="inscription">
  <?php if(!empty($msg)) { ?>
    <div class="form-group erreur large">
      <label><img src="<?= RACINE_SITE; ?>pict/info.png" alt="Erreur"> Erreur(s)</label>
      <p>
        <?= $msg; ?>
      </p>
    </div>
  <?php } ?>
  <form class="large" action="" method="post">
    <?php include '../vues/inscription.php'; ?>
    <input type="submit" value="Inscription">
  </form>
</div>
<?php } ?>
