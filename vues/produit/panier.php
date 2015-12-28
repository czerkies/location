<?php if($userConnect){ ?>
  <h2>Panier</h2>
  <div id="panier">
  <?php if(!empty($msg)) { ?>
    <div class="form-group ok large">
      <label>Information(s)</label>
      <p>
        <?= $msg; ?>
      </p>
    </div>
    <?php } if($userCart){ ?>
    <div class="tableau large">
      <div class="head">
        <div class="title wp10">Référence</div>
        <div class="title wp20">Nom</div>
        <div class="title wp20">Arrivée</div>
        <div class="title wp20">Départ</div>
        <div class="title wp10">Capacité</div>
        <div class="title wp10">Prix</div>
        <div class="title wp5">TVA</div>
        <div class="title wp5">Supp.</div>
      </div>
      <ul class="body">
      <?php for($i=0;$i<count($_SESSION['panier']['id_produit']);$i++){ ?>
        <li>
          <a href="<?= RACINE_SITE; ?>nos-salles/reservation-en-details/<?= $_SESSION['panier']['id_produit'][$i]; ?>">
            <p class="cel wp10"><?= $_SESSION['panier']['id_produit'][$i]; ?></p>
            <p class="cel wp20"><?= $_SESSION['panier']['titre'][$i]; ?></p>
            <p class="cel wp20"><?= $_SESSION['panier']['date_arrivee'][$i]; ?></p>
            <p class="cel wp20"><?= $_SESSION['panier']['date_depart'][$i]; ?></p>
            <p class="cel wp10"><?= $_SESSION['panier']['capacite'][$i]; ?></p>
            <p class="cel wp10"><?= $_SESSION['panier']['prix'][$i]; ?> €</p>
            <p class="cel wp5">20%</p>
          </a>
          <p class="cel wp5"><a href="<?= RACINE_SITE; ?>panier/supprimer/<?= $_SESSION['panier']['id_produit'][$i]; ?>">X</a></p>
        </li>
      <?php } ?>
        <li>
          <p class="cel wp80">Total TTC :</p>
          <p class="cel wp20l"><?= $prixTotal; ?> €</p>
        </li>
      </ul>
    </div>
    <form class="mid" action="<?= RACINE_SITE; ?>panier/" method="post">
      <div class="form-group large">
        <label for="code_promo">Utiliser un code de promotion :</label>
        <input id="code_promo" type="text" name="code_promo" value="<?php if(isset($_POST['code_promo'])) {echo $_POST['code_promo'];}?>" placeholder="Code promo">
        <em>Entrez votre code promotion et appliquez le.</em>
      </div>
      <input class="large" type="submit" name="promo" value="Appliquer mon code promotion">
    </form>
    <div id="economie">
      <?php if($prixTotalReduit != 0) { ?>
      <div class="tableau mid">
        <div class="head">
          <div class="title wp100">Après application de la promotion</div>
        </div>
        <ul class="body">
          <li>
            <p class="cel wp50">Total TTC :</p>
            <p class="cel wp50"><?= $prixTotalReduit; ?> €</p>
          </li>
          <li>
            <p class="cel wp50">Économie de :</p>
            <p class="cel wp50"><?= $diffTotalPromo; ?> €</p>
          </li>
          <li>
            <p class="cel wp50">Soit :</p>
            <p class="cel wp50"><?= $pourcentageTotalPromo; ?> %</p>
          </li>
        </ul>
      </div>
      <?php } ?>
    </div>
    <form class="" action="<?= RACINE_SITE; ?>panier/" method="post">
      <div class="form-group large">
        <label for="cgv">Conditions générales de vente</label>
        <div class="form-group__radio">
          <input id="cgv" type="checkbox" name="cgv">
          <label for="cgv">J'accepte les conditions générales de vente (<a href="#">Voir</a>)</label>
        </div>
        <em>Il est obligé d'accepter les CGV.</em>
      <input type="hidden" name="reduction" value="<?php if(isset($_POST['code_promo'])) echo $_POST['code_promo']; ?>">
      <input type="submit" name="payer" value="Payer">
    </form>
  </div>
  <?php } else { ?>
  <div class="form-group ok large">
    <label>Votre panier est vide</label>
    <p><a href="<?= RACINE_SITE; ?>nos-salles/">Voir le catalogues de toutes les salles proposées par <b>LOKI</b>SALLE.</a></p>
  </div>
  <?php } ?>
<?php } ?>
