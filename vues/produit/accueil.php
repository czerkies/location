<div class="infos_1">
  <h2>À propos de <span>Loki</span>salle</h2>
  <div class="slide">
    <img class="img1" src="<?= RACINE_SITE; ?>photoslide/location_salle_1.jpg" alt="Lokisalle - Location de salle">
    <img class="img2" src="<?= RACINE_SITE; ?>photoslide/location_salle_2.jpg" alt="Lokisalle - Location de salle">
    <img class="img3" src="<?= RACINE_SITE; ?>photoslide/location_salle_3.jpg" alt="Lokisalle - Location de salle">
    <img class="img4" src="<?= RACINE_SITE; ?>photoslide/location_salle_4.jpg" alt="Lokisalle - Location de salle">
  </div>
  <p>Lokisalle est un service de location de salle, clef en main. Les meilleurs salle de réunions vous sont proposées pour un prix imbattable. Sont service de location rapide et efficace vous permettra de réserver votre salle en toutes simplicités.</p>
</div>
<div id="last3offres">
  <h2>Nos 3 dernières offres</h2>
  <?php
  if($lesProduits){
    foreach ($lesProduits as $produitFiche) {
      include 'produitFiche.php';
    }
  } else { ?>
    <h3>Aucune salle n'est disponible</h3>
  <?php } ?>
</div>
