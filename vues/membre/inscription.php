<h1>Inscription</h1>
<?php
  if($userConnect){
    echo "Vous êtes déjà inscrit.";
  } else {
?>
<?= $msg; ?>
<div class="inscription">
  <form class="" action="" method="post">
    <input type="text" name="pseudo" value="<?php if(isset($_POST['pseudo'])) {echo $_POST['pseudo'];} ?>" placeholder="Pseudo" required>
    <input type="password" name="mdp" value="" placeholder="Mot de passe" required>
    <input type="text" name="nom" value="<?php if(isset($_POST['nom'])) {echo $_POST['nom'];} ?>" placeholder="Nom" required>
    <input type="text" name="prenom" value="<?php if(isset($_POST['prenom'])) {echo $_POST['prenom'];} ?>" placeholder="Prénom" required>
    <input type="email" name="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>" placeholder="Email" required>
    <input type="radio" name="sexe" value="m" id="m" <?php
      if(isset($_POST['sexe']) && $_POST['sexe'] === 'm') {
        echo "checked";
      }
    ?>
    ><label for="m">Homme</label>
    <input type="radio" name="sexe" value="f" id="f" <?php
      if(isset($_POST['sexe']) && $_POST['sexe'] === 'f') {
        echo "checked";
      }
    ?>
    ><label for="f">Femme</label>
    <input type="text" name="ville" value="<?php if(isset($_POST['ville'])) {echo $_POST['ville'];} ?>" placeholder="Ville" required>
    <input type="text" name="cp" value="<?php if(isset($_POST['cp'])) {echo $_POST['cp'];} ?>" placeholder="Code Postal" required>
    <textarea name="adresse" placeholder="Adresse" required><?php if(isset($_POST['adresse'])) {echo $_POST['adresse'];} ?></textarea>
    <input type="submit" value="Inscription">
  </form>
</div>
<?php
  }
?>
