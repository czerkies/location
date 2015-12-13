<?php if($userConnectAdmin){ ?>
<?= $msg; ?>
<h1>Gestion des salles</h1>
<div class="menu_page_active">
  <ul>
    <li><a href="http://localhost/lokisalle/www/routeur.php?controleurs=salles&action=ajouterSalle">Ajouter une salle</a></li>
    <li><a href="http://localhost/lokisalle/www/routeur.php?controleurs=salles&action=gestionSalles">Affichage des salles</a></li>
  </ul>
</div>
<?php if($ajouter){ ?>
  <h2>Ajouter une salle</h2>
  <form class="" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_salle" id="id_salle" value="<?php if(isset($recupPourModif['id_salle'])) { echo $recupPourModif['id_salle'];} ?>" />
    <label for="pays">Pays</label>
    <input type="text" name="pays" id="pays" value="<?php if(isset($_POST['pays'])) {echo $_POST['pays'];} elseif(isset($recupPourModif['pays'])) {echo $recupPourModif['pays'];} ?>" placeholder="Pays" required>
    <label for="ville">Ville</label>
    <input type="text" name="ville" id="ville" value="<?php if(isset($_POST['ville'])) {echo $_POST['ville'];} elseif(isset($recupPourModif['ville'])) {echo $recupPourModif['ville'];} ?>" placeholder="Ville" required>
    <label for="adresse">Adresse</label>
    <input type="text" name="adresse" id="adresse" value="<?php if(isset($_POST['adresse'])) {echo $_POST['adresse'];} elseif(isset($recupPourModif['adresse'])) {echo $recupPourModif['adresse'];} ?>" placeholder="Adresse" required>
    <label for="cp">Code Postale</label>
      <input type="text" name="cp" id="cp" value="<?php if(isset($_POST['cp'])) {echo $_POST['cp'];} elseif(isset($recupPourModif['cp'])) {echo $recupPourModif['cp'];} ?>" placeholder="Code Postale" required>
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre" value="<?php if(isset($_POST['titre'])) {echo $_POST['titre'];} elseif(isset($recupPourModif['titre'])) {echo $recupPourModif['titre'];} ?>" placeholder="Titre" required>
    <label for="description">Description</label>
    <textarea name="description" id="description" placeholder="Description" required><?php if(isset($_POST['description'])) {echo $_POST['description'];} elseif(isset($recupPourModif['description'])) {echo $recupPourModif['description'];} ?></textarea>
    <label for="capacite">Capacité</label>
    <input type="text" name="capacite" id="capacite" value="<?php if(isset($_POST['capacite'])) {echo $_POST['capacite'];} elseif(isset($recupPourModif['capacite'])) {echo $recupPourModif['capacite'];} ?>" placeholder="Capacité" required>
    <label for="categorie">Catégorie</label>
    <select id="categorie" name="categorie">
      <option disabled>Toutes categories</option>
      <?php foreach ($listeCategories as $value) { ?>
        <option value="<?= $value; ?>" <?php if(isset($_POST['categorie']) && $_POST['categorie'] === $value) {echo 'selected'; } elseif(isset($recupPourModif['categorie']) && $recupPourModif['categorie'] === $value) {echo 'selected';}?>>
          <?= ucfirst($value); ?>
        </option>
      <?php } ?>
    </select>

    <label for="photo">Photo</label>
    <?php if(isset($recupPourModif['photo']) && !empty($recupPourModif['photo'])){ ?>
      <img src="<?= $recupPourModif['photo']; ?>">
      <input type="hidden" name="photoBDD" value="<?= $recupPourModif['photo']; ?>">
    <?php } elseif (isset($recupPourModif['photo']) && empty($recupPourModif['photo'])) { ?>
    <p>Il n'y a pas de photo.</p>
    <label for="photo">Photo</label>
    <?php } ?>
    <input type="file" id="photo" name="photo" accept="image/jpeg" required>
    <input type="submit" name="name" value="Valider la saisie">
  </form>
  <?php } if($salles) { ?>
  <h2>Afficher les salles</h2>
  <table class="affichageSalles">
    <thead>
      <tr>
        <th>Photo</th>
        <th>Pays</th>
        <th>Ville</th>
        <th>Adresse</th>
        <th>Code postale</th>
        <th>Description</th>
        <th>Capacité</th>
        <th>Catégorie</th>
        <th>Modifier</th>
        <th>Supprimer</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($salles as $donnees){ ?>
      <tr>
        <td><img src="<?= $donnees['photo']; ?>" alt="<?= $donnees['titre']; ?>"></td>
        <td><?= $donnees['pays']; ?></td>
        <td><?= $donnees['ville']; ?></td>
        <td><?= $donnees['cp']; ?></td>
        <td><?= $donnees['titre']; ?></td>
        <td><?= $donnees['description']; ?></td>
        <td><?= $donnees['capacite']; ?> Personnes</td>
        <td><?= ucfirst($donnees['categorie']); ?></td>
        <td><a href="http://localhost/lokisalle/www/routeur.php?controleurs=salles&action=gestionSalles&modif=<?= $donnees['id_salle']; ?>">Modifier</a></td>
        <td><a href="http://localhost/lokisalle/www/routeur.php?controleurs=salles&action=gestionSalles&supp=<?= $donnees['id_salle']; ?>">Supprimer</a></td>
      </tr>
      <? } ?>
    </tbody>
  </table>
  <?php } ?>
<?php } else { ?>
<p>Vous n'avez pas accès à cette page</p>
<?php
  }
?>
