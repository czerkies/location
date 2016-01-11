<?php if($userConnectAdmin){ ?>
<div id="gestion_salles">
  <h2>Gestion des salles</h2>
  <ul class="sous-menu-admin">
    <li><a class="bouton-a <?php if($title['menu_admin'] === 100) echo 'active'; ?>" href="<?= RACINE_SITE; ?>admin/gestion-salles/#gestion_salles">Affichage des salles</a></li>
    <li><a class="bouton-a <?php if($title['menu_admin'] === 101) echo 'active'; ?>" href="<?= RACINE_SITE; ?>admin/gestion-salles/ajouter/#gestion_salles">Ajouter une salle</a></li>
  </ul>
  <?php include '../vues/dialogue.php'; ?>
  <?php if($ajouter){ ?>
    <h2>Gestion d'une salle</h2>
    <form class="" action="#gestion_salles" method="post" enctype="multipart/form-data">
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
        <label for="photo"><img src="<?= RACINE_SITE; ?>pict/img.png" alt="Photo">Photo</label>
        <?php if(isset($recupPourModif['photo']) && !empty($recupPourModif['photo'])){ ?>
          <img src="<?= RACINE_SITE.$recupPourModif['photo']; ?>">
          <input type="hidden" name="photoBDD" value="<?= $recupPourModif['photo']; ?>">
        <?php } elseif (isset($recupPourModif['photo']) && empty($recupPourModif['photo'])) { ?>
          <p>Il n'y a pas de photo.</p>
      </div>
      <div class="form-group">
        <label for="photo">Photo</label>
        <?php } ?>
        <input type="file" id="photo" name="photo" accept="image/jpeg">
        <em>Photo au format JPG.</em>
      </div>
      <input type="submit" name="name" value="Valider la saisie">
    </form>
    <?php } if($salles) { ?>
    <h2>Afficher les salles</h2>
    <?php if($dialogue) { ?>
    <div class="form-group erreur large">
      <label><img src="<?= RACINE_SITE; ?>pict/info.png" alt="Erreur"> Attention</label>
      <p>Cette salle est utilisé pour des produits. Êtes-vous sur de vouloir la supprimer ?
        <a class="bouton-a" href="<?= RACINE_SITE; ?>admin/gestion-salles/suppression/oui/<?= $_GET['supp']; ?>#gestion_salles">Oui</a>
        <a class="bouton-a" href="<?= RACINE_SITE; ?>admin/gestion-salles/#gestion_salles">Non</a>
      </p>
    </div>
    <?php } ?>
    <div class="tableau large">
      <div class="head">
        <div class="title wp5">ID</div>
        <div class="title wp15">Titre</div>
        <div class="title wp15">Photo</div>
        <div class="title wp15">Situation</div>
        <div class="title wp20">Description</div>
        <div class="title wp10">Capacité</div>
        <div class="title wp10">Catégorie</div>
        <div class="title wp10">Actions</div>
      </div>
      <ul class="body">
        <?php foreach($salles as $donnees){ ?>
        <li>
          <a href="<?= RACINE_SITE; ?>admin/gestion-salles/modification/<?= $donnees['id_salle']; ?>#gestion_salles">
            <p class="cel wp5"><?= $donnees['id_salle']; ?></p>
            <p class="cel wp15"><?= $donnees['titre']; ?></p>
            <?php if(!empty($donnees['photo']) && file_exists(RACINE_SERVER.RACINE_SITE.$donnees['photo'])) { ?>
            <p class="cel wp15 wpimg">
              <img src="<?= RACINE_SITE.$donnees['photo']; ?>" alt="<?= $donnees['titre']; ?>">
            </p>
            <?php } else { ?>
            <p class="cel wp15">Pas de photo</p>
            <?php } ?>
            <p class="cel wp15"><?= $donnees['ville']; ?></p>
            <p class="cel wp20"><?= substr($donnees['description'], 0, 100); ?>...</p>
            <p class="cel wp10"><?= $donnees['capacite']; ?></p>
            <p class="cel wp10"><?= ucfirst($donnees['categorie']); ?></p>
            <p class="cel wp5 pict"><img src="<?= RACINE_SITE; ?>pict/mod.png" alt="Modifier"></p>
          </a>
          <a href="<?= RACINE_SITE; ?>admin/gestion-salles/suppression/<?= $donnees['id_salle']; ?>#gestion_salles">
            <p class="cel wp5 pict"><img src="<?= RACINE_SITE; ?>pict/supp.png" alt="Supprimer"></p>
          </a>
        </li>
        <?php } ?>
      </ul>
    </div>
  <?php } ?>
</div>
<?php } else { ?>
<p>Vous n'avez pas accès à cette page</p>
<?php } ?>
