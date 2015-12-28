<h2>S'inscrire à la newsletter</h2>
  <?= $msg; ?>
<div id="envoi_newsletter">
  <?php if($userConnect){
  if($affichage){ ?>
    <a class="bouton-a" href="<?= RACINE_SITE; ?>newsletter/inscription/">Je souhaite m'abonner à la newsletter et recevoir les actualités de LOKISALLE</a>
  <?php } else { ?>
    <div class="form-group ok large">
      <label>Confirmation</label>
      <p>Vous êtes inscrit à la newsletter.</p>
    </div>
  <?php }
  } else { ?>
    <a class="bouton-a" href="<?= RACINE_SITE; ?>connexion/">Veuillez vous inscrire pour recevoir la newsletter.</a>
<?php } ?>
</div>
