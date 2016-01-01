<?php if($userConnect){ ?>
<div id="profil">
  <h2>Votre profil</h2>
  <?php if(isset($_GET['modif']) == 'true'){ ?>
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
      <p>Votre profil a bien été mis à jour.</p>
    </div>
  <?php } ?>
  <form class="large" action="" method="post">
    <div class="form-group large">
      <label for="pseudo">Pseudo</label>
      <input type="text" name="pseudo" id="pseudo" value="<?php if(isset($_POST['pseudo'])) {echo $_POST['pseudo'];} else {echo $_SESSION['membre']['pseudo'];} ?>" required>
      <em>Veuillez inscrire un speudo, sans espace.</em>
    </div>
    <div class="form-group large">
      <label for="nom">Nom</label>
      <input type="text" name="nom" id="nom" value="<?php if(isset($_POST['nom'])) {echo $_POST['nom'];} else {echo $_SESSION['membre']['nom'];} ?>" required>
      <em>Votre nom pour l'enregistrement de vos commandes.</em>
    </div>
    <div class="form-group large">
      <label for="prenom">Prénom</label>
      <input type="text" name="prenom" id="prenom" value="<?php if(isset($_POST['prenom'])) {echo $_POST['prenom'];} else {echo $_SESSION['membre']['prenom'];} ?>" required>
      <em>Votre prénom pour l'enregistrement de vos commandes.</em>
    </div>
    <div class="form-group large">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} else {echo $_SESSION['membre']['email'];} ?>" required>
      <em>Votre mot de passe doit compter au moins une majuscule ou un chiffre.</em>
    </div>
    <div class="form-group large">
      <label for="">Sexe</label>
      <div class="form-group__radio">
        <input type="radio" name="sexe" value="m" id="m" <?php
          if(isset($_POST['sexe']) && $_POST['sexe'] === 'm') {
            echo "checked";
          } elseif ($_SESSION['membre']['sexe'] === 'm'){
            echo "checked";
          }?>><label for="m">Homme</label>
        <input type="radio" name="sexe" value="f" id="f" <?php
          if(isset($_POST['sexe']) && $_POST['sexe'] === 'f') {
            echo "checked";
          } elseif ($_SESSION['membre']['sexe'] === 'f'){
            echo "checked";
          }?>><label for="f">Femme</label>
      </div>
    </div>
    <div class="form-group large">
      <label for="ville">Ville</label>
      <input type="text" name="ville" id="ville" value="<?php if(isset($_POST['ville'])) {echo $_POST['ville'];} else {echo $_SESSION['membre']['ville'];} ?>" required>
    </div>
    <div class="form-group large">
      <label for="cp">Code postal</label>
      <input type="text" name="cp" id="cp" value="<?php if(isset($_POST['cp'])) {echo $_POST['cp'];} else {echo $_SESSION['membre']['cp'];} ?>" required>
    </div>
    <div class="form-group large">
      <label for="adresse">Adresse</label>
      <textarea name="adresse" name="adresse" id="adresse" required><?php if(isset($_POST['adresse'])) {echo $_POST['adresse'];} else {echo $_SESSION['membre']['adresse'];} ?></textarea>
    </div>
      <input type="submit" class="" value="Enregistrer les informations">
  </form>
    <?php } else { ?>
  <div class="form-group large">
    <label for="pseudo">Votre Pseudo :</label>
    <p><?= $_SESSION['membre']['pseudo']; ?></p>
  </div>
  <div class="form-group large">
    <label for="email">Votre Email est :</label>
    <p><?= $_SESSION['membre']['email']; ?></p>
  </div>
  <div class="form-group large">
    <label for="nom">Votre Nom :</label>
    <p><?= $_SESSION['membre']['nom']; ?></p>
  </div>
  <div class="form-group large">
    <label for="prenom">Votre Prénom :</label>
    <p><?= $_SESSION['membre']['prenom']; ?></p>
  </div>
  <div class="form-group large">
    <label for="ville">Votre ville est :</label>
    <p><?= $_SESSION['membre']['ville']; ?></p>
  </div>
  <div class="form-group large">
    <label for="cp">Votre Code Postal est :</label>
    <p><?= $_SESSION['membre']['cp']; ?></p>
  </div>
  <div class="form-group large">
    <label for="adresse">Votre adresse est :</label>
    <p><?= $_SESSION['membre']['adresse']; ?></p>
  </div>
  <a class="bouton-a" href="<?= RACINE_SITE; ?>mon-profil/modification/">Mettre à jour mes informations</a>
  <?php } ?>
</div>
<div id="last_commande">
  <?php if(!$commandes['nbCommandes']){ ?>
  <h2>Aucune commande</h2>
  <?php } else { ?>
  <h2><?= $commandes['nbCommandes']; ?> dernières commandes</h2>
    <div class="tableau mid">
      <div class="head">
        <div class="title">Numéro de commande</div>
        <div class="title">Date de la commande</div>
      </div>
      <ul class="body">
      <?php foreach ($commandes['donnees'] as $value) { ?>
          <li>
            <p class="cel"><?= $value['id_commande']; ?></p>
            <p class="cel"><?= $value['date_commande']; ?></p>
          </li>
      <?php } ?>
      </ul>
    </div>
  <?php } ?>
</div>
<?php } ?>
