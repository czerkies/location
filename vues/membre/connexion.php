<?= $connect; ?>
<h1>Connexion</h1>
<?php
  if($userConnect){
    echo "Bonjour ". $_SESSION['membre']['prenom'];
  } else {
?>
<div id="connexion">
  <form action="" method="post">
    <input type="text" name="pseudo" placeholder="Pseudo" value="<?php if(isset($_COOKIE['pseudo'])) {echo $_COOKIE['pseudo'];} ?>"><br>
    <input type="password" name="mdp" placeholder="Mot de passe"><br>
    <input type="checkbox" name="sauv_session" id="sauv_session"><label for="sauv_session">Se souvenir de moi</label><br>
    <input type="submit" name="connexion" value="Connexion">
    <p><a href="http://localhost/lokisalle/www/routeur.php?controleurs=membre&action=mdpperduMembre">J'ai perdu mon mot de passe</a></p>
  </form>
</div>
<div class="bloc_2">
  <p>Pas encore membre ?</p>
  <p><a href="http://localhost/lokisalle/www/routeur.php?controleurs=membre&action=ajoutMembre">Créer un compte</a></p>
</div>
<?php
  }
?>
