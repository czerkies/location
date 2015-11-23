<h1>S'inscrire à la newsletter</h1>
<?php if($userConnect){ ?>
  <?= $msg; ?>
<div id="envoi_newsletter">
  <?php if($affichage){ ?>
  <a href="http://localhost/lokisalle/www/routeur.php?controleurs=newsletter&action=inscriptionMembre&inscription=ok">Je souhaite m'abonner à la newsletter et recevoir les actualités de LOKISALLE</a>
  <?php } else { ?>
  <p>Vous êtes déjà abonné à la newsletter</p>
  <?php } ?>
</div>
<?php
} else {
  echo "Veuillez vous inscrire pour recevoir la newsletter.";
}
?>
