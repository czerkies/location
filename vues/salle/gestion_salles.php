<?php if($userConnectAdmin){ ?>
<h2>Gestion des salles</h2>
<ul class="menu_page_active">
  <li><a href="<?= RACINE_SITE; ?>admin/gestion-salles/">Affichage des salles</a></li>
  <li><a href="<?= RACINE_SITE; ?>admin/gestion-salles/ajouter/">Ajouter une salle</a></li>
</ul>
<?php if($ajouter){ ?>
  <h2>Ajouter une salle</h2>
  <?php if(!empty($msg)) { ?>
    <div class="form-group erreur large">
      <label>Erreur(s)</label>
      <p>
        <?= $msg; ?>
      </p>
    </div>
  <?php } if($confirmation) { ?>
    <div class="form-group ok large">
      <label>Confirmation</label>
      <p>Votre salle a bien été ajouté.</p>
    </div>
  <?php } ?>
  <form class="" action="" method="post" enctype="multipart/form-data">
    <?php if($recupPourModif){ ?>
      <input type="hidden" name="id_salle" id="id_salle" value="<?php if(isset($recupPourModif['id_salle'])) { echo $recupPourModif['id_salle'];} ?>" required>
    <?php } ?>
    <div class="form-group">
      <label for="pays">Pays</label>
      <input type="text" name="pays" id="pays" value="<?php if(isset($_POST['pays'])) {echo $_POST['pays'];} elseif(isset($recupPourModif['pays'])) {echo $recupPourModif['pays'];} ?>" placeholder="Pays" required>
      <em></em>
    </div>
    <div class="form-group">
      <label for="ville">Ville</label>
      <input type="text" name="ville" id="ville" value="<?php if(isset($_POST['ville'])) {echo $_POST['ville'];} elseif(isset($recupPourModif['ville'])) {echo $recupPourModif['ville'];} ?>" placeholder="Ville" required>
      <em></em>
    </div>
    <div class="form-group">
      <label for="titre">Titre</label>
      <input type="text" name="titre" id="titre" value="<?php if(isset($_POST['titre'])) {echo $_POST['titre'];} elseif(isset($recupPourModif['titre'])) {echo $recupPourModif['titre'];} ?>" placeholder="Titre" required>
      <em>Titre de la salle qui sera affiché à chaque produit.</em>
    </div>
    <div class="form-group">
      <label for="cp">Code Postale</label>
      <input type="text" name="cp" id="cp" value="<?php if(isset($_POST['cp'])) {echo $_POST['cp'];} elseif(isset($recupPourModif['cp'])) {echo $recupPourModif['cp'];} ?>" placeholder="Code Postal" required>
      <em>Code postal à 5 chiffres.</em>
    </div>
    <div class="form-group">
      <label for="adresse">Adresse</label>
      <textarea name="adresse" id="adresse" placeholder="Adresse" required><?php if(isset($_POST['adresse'])) {echo $_POST['adresse'];} elseif(isset($recupPourModif['adresse'])) {echo $recupPourModif['adresse'];} ?></textarea>
      <em>Entrez une adresse complète.</em>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea name="description" id="description" placeholder="Description" required><?php if(isset($_POST['description'])) {echo $_POST['description'];} elseif(isset($recupPourModif['description'])) {echo $recupPourModif['description'];} ?></textarea>
      <em>Description de la salle entre 4 et 400 carractères.</em>
    </div>
    <div class="form-group">
      <label for="capacite">Capacité</label>
      <input type="number" min="1" max="9999999999999" name="capacite" id="capacite" value="<?php if(isset($_POST['capacite'])) {echo $_POST['capacite'];} elseif(isset($recupPourModif['capacite'])) {echo $recupPourModif['capacite'];} ?>" placeholder="Capacité" required>
      <em>Capacité de la salle en nombre de places.</em>
    </div>
    <div class="form-group">
      <label for="categorie">Catégorie</label>
      <select id="categorie" name="categorie">
        <option disabled>Toutes categories</option>
        <?php foreach ($listeCategories as $value) { ?>
          <option value="<?= $value; ?>" <?php if(isset($_POST['categorie']) && $_POST['categorie'] === $value) {echo 'selected'; } elseif(isset($recupPourModif['categorie']) && $recupPourModif['categorie'] === $value) {echo 'selected';}?>>
            <?= ucfirst($value); ?>
          </option>
        <?php } ?>
      </select>
      <em>Catégorie de la salle.</em>
    </div>
    <div class="form-group">
      <label for="photo">Photo</label>
      <?php if(isset($recupPourModif['photo']) && !empty($recupPourModif['photo'])){ ?>
        <img src="<?= $recupPourModif['photo']; ?>">
        <input type="hidden" name="photoBDD" value="<?= $recupPourModif['photo']; ?>">
        <em>Photo au format JPG.</em>
      <?php } elseif (isset($recupPourModif['photo']) && empty($recupPourModif['photo'])) { ?>
        <p>Il n'y a pas de photo.</p>
    </div>
    <div class="form-group">
      <label for="photo">Photo</label>
      <?php } ?>
      <input type="file" id="photo" name="photo" accept="image/jpeg" required>
      <em>Photo au format JPG.</em>
    </div>
    <input type="submit" name="name" value="Valider la saisie">
  </form>
  <?php } if($salles) { ?>
  <h2>Afficher les salles</h2>
  <?php if($dialogue) { ?>
  <div class="dialogue">
    <p>
      Cette salle est utilisé pour des produits,<br>
      Êtes-vous sur de vouloir la supprimer ?<br>
      <a href="<?= RACINE_SITE; ?>admin/gestion-salles/suppression/<?= $_GET['supp']; ?>/oui">Oui</a> | <a href="<?= RACINE_SITE; ?>admin/gestion-salles/">Non</a>
    </p>
  </div>
  <?php } ?>
  <table class="affichageSalles">
    <thead>
      <tr>
        <th>ID Salle</th>
        <th>Photo</th>
        <th>Pays</th>
        <th>Ville</th>
        <th>Code postal</th>
        <th>Titre</th>
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
        <td><?= $donnees['id_salle']; ?></td>
        <td><img src="<?= $donnees['photo']; ?>" alt="<?= $donnees['titre']; ?>"></td>
        <td><?= $donnees['pays']; ?></td>
        <td><?= $donnees['ville']; ?></td>
        <td><?= $donnees['cp']; ?></td>
        <td><?= $donnees['titre']; ?></td>
        <td><?= $donnees['description']; ?></td>
        <td><?= $donnees['capacite']; ?> Personnes</td>
        <td><?= ucfirst($donnees['categorie']); ?></td>
        <td><a href="<?= RACINE_SITE; ?>admin/gestion-salles/modification/<?= $donnees['id_salle']; ?>">Modifier</a></td>
        <td><a href="<?= RACINE_SITE; ?>admin/gestion-salles/suppression/<?= $donnees['id_salle']; ?>">Supprimer</a></td>
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
