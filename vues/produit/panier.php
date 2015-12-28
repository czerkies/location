<?php if($userConnect){ ?>
<h2>Panier</h2>
<?= $msg; ?>
<?php if($userCart){ ?>
<table class="panier">
  <thead>
  <tr><th colspan="10">Votre Panier</th></tr>
  <tr>
    <th>Produit</th>
    <th>Salle</th>
    <th>Photo</th>
    <th>Ville</th>
    <th>Capacité</th>
    <th>Date Arrivée</th>
    <th>Date Départ</th>
    <th>Supprimer</th>
    <th>Prix HT</th>
    <th>TVA</th>
  </tr>
    <?php for($i=0;$i<count($_SESSION['panier']['id_produit']);$i++){ ?>
      <tr>
        <td><?= $_SESSION['panier']['id_produit'][$i]; ?></td>
        <td><?= $_SESSION['panier']['titre'][$i]; ?></td>
        <td><img src="<?= $_SESSION['panier']['photo'][$i]; ?>" alt="<?= $_SESSION['panier']['photo'][$i]; ?>"></td>
        <td><?= $_SESSION['panier']['ville'][$i]; ?></td>
        <td><?= $_SESSION['panier']['capacite'][$i]; ?></td>
        <td><?= $_SESSION['panier']['date_arrivee'][$i]; ?></td>
        <td><?= $_SESSION['panier']['date_depart'][$i]; ?></td>
        <td><a href="<?= RACINE_SITE; ?>panier/supprimer/<?= $_SESSION['panier']['id_produit'][$i]; ?>">X</a></td>
        <td><?= $_SESSION['panier']['prix'][$i]; ?> €</td>
        <td>20 %</td>
      </tr>
    <?php } ?>
      <tr>
        <th colspan="8">Prix Total TTC :</th>
        <th colspan="2"><?= $prixTotal; ?> €</th>
      </tr>
      <?php if($prixTotalReduit != 0) { ?>
        <tr>
          <th colspan="8">Prix avec le code promotion :</th>
          <th colspan="2"><?= $prixTotalReduit; ?> € </th>
        </tr>
        <tr>
          <th colspan="8">Économie de :</th>
          <th colspan="2"><?= $diffTotalPromo; ?> € </th>
        </tr>
        <tr>
          <th colspan="8">Soit :</th>
          <th colspan="2"><?= $pourcentageTotalPromo; ?> %</th>
        </tr>
      <?php } ?>
    <tr>
      <td colspan="8">
        <form class="" action="<?= RACINE_SITE; ?>panier/" method="post">
          <label for="code_promo">Utiliser un code de promotion :</label>
          <input id="code_promo" type="text" name="code_promo" value="<?php if(isset($_POST['code_promo'])) {echo $_POST['code_promo'];}?>" placeholder="Code promo">
          <input type="submit" name="promo" value="Appliquer mon code promotion">
        </form>
        <form class="" action="<?= RACINE_SITE; ?>panier/" method="post">
          <label for="cgv">J'accepte les conditions générales de vente (<a href="#">Voir</a>)</label>
          <input id="cgv" type="checkbox" name="cgv">
        </td>
        <td colspan="2">
          <input type="hidden" name="reduction" value="<?php if(isset($_POST['code_promo'])) echo $_POST['code_promo']; ?>">
          <input type="submit" name="payer" value="Payer">
        </td>
      </form>
      </td>
    </tr>
    <tr>
      <td colspan="10">
          <a href="<?= RACINE_SITE; ?>panier/supprimer/panier">Vider mon panier</a>
      </td>
    </tr>
</table>
<?php } else { ?>
  <p>Votre panier est vide.</p>
<?php } ?>
<?php } ?>
