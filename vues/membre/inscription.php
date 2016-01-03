<h2>Inscription</h2>
<?php if($userConnect){ ?>
  <div class="form-group erreur large">
    <label>Erreur(s)</label>
    <p>Vous êtres déjà connecté et inscrit.</p>
  </div>
<?php } else { ?>
<div class="inscription">
  <?php if(!empty($msg)) { ?>
    <div class="form-group erreur large">
      <label>Erreur(s)</label>
      <p>
        <?= $msg; ?>
      </p>
    </div>
  <?php } if($confirmation) { ?>
    <div class="form-group ok large">
      <label>Confirmation</label>
      <p>
        Votre inscription a bien été pris en compte.<br>
        Vous pouvez maintenant vous connecter.
      </p>
    </div>
  <?php } else { ?>
  <form class="large" action="" method="post">
    <?php include '../vues/inscription.php'; ?>
    <input type="submit" value="Inscription">
  </form>
  <?php } ?>
</div>
<?php } ?>
