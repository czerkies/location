<h1>Inscription</h1>
<?php
  if($userConnect){
    echo "Vous êtes déjà inscrit.";
  } else {
?>
<?= $msg ?>
<div id="inscription">
  <form class="" action="" method="post">
    <label for="mdpperdu">Afin de pouvoir réinitialiser votre mot de passe, vous devez nous fournir votre adresse email :</label>
    <input type="email" name="email" value="" placeholder="Email" required>
    <input type="submit" value="Valider">
  </form>
</div>
<?php
  }
?>
