<div class="infos_1">
  <h2>À propos de <span>Loki</span>salle</h2>
  <div class="slide">
    <img class="img1" src="<?= RACINE_SITE; ?>photoslide/location_salle_1.jpg" alt="Lokisalle - Location de salle">
    <img class="img2" src="<?= RACINE_SITE; ?>photoslide/location_salle_2.jpg" alt="Lokisalle - Location de salle">
    <img class="img3" src="<?= RACINE_SITE; ?>photoslide/location_salle_3.jpg" alt="Lokisalle - Location de salle">
    <img class="img4" src="<?= RACINE_SITE; ?>photoslide/location_salle_4.jpg" alt="Lokisalle - Location de salle">
  </div>
  <p>Lokisalle est un service de location de salles, clef en main. Les meilleures salles vous sont proposées pour un prix imbattable. Elles vous seront utiles pour vos réunions, conférences ou formation que vous soyez particuliers ou professionnels.<br><br>
  Situés au centre des plus grandes villes de France, nous avons les grandes salles pour tous types d’événements.<br><br>
  Pour choisir votre salle, nous avons mis en place un système de recherche pour vous permettre de trouver votre salle à la date d’arrivée que vous souhaitez, par catégorie ou par mot-clef.<br><br>
  Lokisalle facilite grandement la réservation de salle, rapide et efficace.<br><br>
  Si vous avez des questions ou autres demande, <a href="<?= RACINE_SITE; ?>contact/">contactez-nous</a> !</p>
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
