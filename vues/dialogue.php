<?php if(!empty($msg)) { ?>
<div class="form-group erreur large">
  <label>Erreur(s)</label>
  <p>
    <?= $msg; ?>
  </p>
</div>
<?php } if(!empty($confirmation)) { ?>
<div class="form-group ok large">
  <label>Confirmation</label>
  <p>
    <?= $confirmation; ?>
  </p>
</div>
<?php } ?>
