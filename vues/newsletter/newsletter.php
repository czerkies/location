<h1>S'inscrire à la newsletter</h1>
  <?= $msg; ?>
<div id="envoi_newsletter">
  <?php if($userConnect){ ?>
  <?php if($affichage){ ?>
    <a href="<?= RACINE_SITE; ?>newsletter/inscription/">Je souhaite m'abonner à la newsletter et recevoir les actualités de LOKISALLE</a>
  <?php } else { ?>
    <p>Vous êtes déjà abonné à la newsletter</p>
  <?php }
  } else { ?>
    <p><a href="<?= RACINE_SITE; ?>connexion/">Veuillez vous inscrire pour recevoir la newsletter.</a></p>
<?php } ?>
</div>
