<h2>Se connecter</h2>
<?php if($userConnect){ ?>
  <meta http-equiv="refresh" content="0; URL=<?= RACINE_SITE; ?>">
<?php } else { ?>
<div id="connexion">
  <?php if(!empty($msg)) { ?>
    <div class="form-group erreur large">
      <label>Erreur(s)</label>
      <p>
        <?= $msg; ?>
      </p>
    </div>
  <?php } ?>
  <form action="" method="post">
    <div class="form-group">
      <label for="pseudo">Pseudo</label>
      <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" value="<?php if(isset($_POST['pseudo'])) {echo $_POST['pseudo'];} elseif(isset($_COOKIE['pseudo'])) {echo $_COOKIE['pseudo'];} ?>" required>
    </div>
    <div class="form-group">
      <label for="mdp">Mot de passe</label>
      <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" required>
      <em></em>
    </div>
    <div class="form-group__inlabel">
      <input type="checkbox" name="sauv_session" id="sauv_session"><label for="sauv_session">Se souvenir de moi</label>
    </div>
    <input type="submit" name="connexion" value="Connexion">
  </form>
</div>
<h2>Je n'ai pas d'identifiants</h2>
<div class="infos_2">
  <h3>Pas encore membre ?</h3>
  <p><a href="<?= RACINE_SITE; ?>inscription/">Je souhaite créer un compte</a></p>
</div>
<div class="infos_2">
  <h3>Vous avez perdu votre mot de passe ?</h3>
  <p><a href="<?= RACINE_SITE; ?>connexion/mot-de-passe-perdu/">Je souhaite réinitialiser mon mot de passe</a></p>
</div>
<?php } ?>
