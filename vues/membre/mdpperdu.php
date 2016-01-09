<h2>Inscription</h2>
<?php
  if($userConnect){ ?>
    <div class="form-group erreur large">
      <label><img src="<?= RACINE_SITE; ?>pict/info.png" alt="Erreur"> Erreur(s)</label>
      <p>Vous êtes déjà connecté.</p>
    </div>
  <? } else { ?>
<div id="inscription">
  <?php if(!empty($msg)) { ?>
    <div class="form-group erreur large">
      <label><img src="<?= RACINE_SITE; ?>pict/info.png" alt="Erreur"> Erreur(s)</label>
      <p>
        <?= $msg; ?>
      </p>
    </div>
  <?php } if($confirmation) { ?>
    <div class="form-group ok large">
      <label><img src="<?= RACINE_SITE; ?>pict/info.png" alt="Information"> Confirmation</label>
      <p>Vous avez reçus un email avec votre nouveau mot de passe à l'adresse suivante : <?= $_POST['email']; ?></p>
    </div>
    <?php } ?>
  <form action="" method="post">
    <div class="form-group large">
      <label for="mdpperdu">Adresse email correspondant à votre compte</label>
      <input type="email" id="mdpperdu" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="Email" required>
      <em>Vous recevrez par email votre nouveau mot de passe.</em>
    </div>
    <input type="submit" value="Recevoir mon nouveau mot de passe">
  </form>
</div>
<?php } ?>
