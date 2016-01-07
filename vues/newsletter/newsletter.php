<h2>S'inscrire à la newsletter</h2>
  <?= $msg; ?>
<div id="envoi_newsletter">
  <?php if($userConnect){
  if($affichage){ ?>
    <a class="bouton-a" href="<?= RACINE_SITE; ?>newsletter/inscription/">Je souhaite m'abonner à la newsletter LokiSalle</a>
  <?php } else { ?>
    <div class="form-group ok large">
      <label><img src="<?= RACINE_SITE; ?>pict/info.png" alt="Information"> Confirmation</label>
      <p>Vous êtes inscrit à la newsletter.</p>
    </div>
    <a class="bouton-a" href="<?= RACINE_SITE; ?>newsletter/desinscription/">Je souhaite me désabonner de la newsletter LOKISALLE</a>
  <?php }
  } else { ?>
    <a class="bouton-a" href="<?= RACINE_SITE; ?>connexion/">Veuillez vous inscrire pour recevoir la newsletter.</a>
<?php } ?>
</div>
