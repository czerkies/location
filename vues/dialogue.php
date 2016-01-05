<?php if(!empty($msg)) { ?>
<div class="form-group erreur large">
  <label><img src="<?= RACINE_SITE; ?>pict/info.png" alt="Erreur">Erreur(s)</label>
  <p>
    <?= $msg; ?>
  </p>
</div>
<?php } if(!empty($confirmation)) { ?>
<div class="form-group ok large">
  <label><img src="<?= RACINE_SITE; ?>pict/info.png" alt="Information"> Confirmation</label>
  <p>
    <?= $confirmation; ?>
  </p>
</div>
<?php } ?>
