<?= $msg; ?>
<h1>Connexion</h1>
<?php
  if($userConnect){
    echo "Bonjour ". $_SESSION['membre']['prenom'];
  } else {
?>
<div id="connexion">
  <form action="" method="post">
    <input type="text" name="pseudo" placeholder="Pseudo" value="<?php if(isset($_POST['pseudo'])) {echo $_POST['pseudo'];} elseif(isset($_COOKIE['pseudo'])) {echo $_COOKIE['pseudo'];} ?>" required>
    <input type="password" name="mdp" placeholder="Mot de passe" required>
    <input type="checkbox" name="sauv_session" id="sauv_session"><label for="sauv_session">Se souvenir de moi</label><br>
    <input type="submit" name="connexion" value="Connexion">
    <p><a href="<?= RACINE_SITE; ?>connexion/mot-de-passe-perdu/">J'ai perdu mon mot de passe</a></p>
  </form>
</div>
<div class="bloc_2">
  <p>Pas encore membre ?</p>
  <p><a href="<?= RACINE_SITE; ?>inscription/">Créer un compte</a></p>
</div>
<?php } ?>
