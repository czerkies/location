<h2>Toutes nos offres</h2>
<div id="reservation">
  <?php if($lesProduits){
    foreach ($lesProduits as $produitFiche) {
      include 'produitFiche.php';
    }
  } else { ?>
    <h3>Aucune salle n'est disponible.</h3>
  <?php } ?>
</div>
