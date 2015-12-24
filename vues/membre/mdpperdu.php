<h1>Inscription</h1>
<?php
  if($userConnect){
    echo "Vous êtes déjà inscrit.";
  } else {
?>
<?= $msg; ?>
<div id="inscription">
  <form action="" method="post">
    <label for="mdpperdu">Afin de pouvoir réinitialiser votre mot de passe, vous devez nous fournir votre adresse email :</label>
    <input type="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="Email" required>
    <input type="submit" value="Valider">
  </form>
</div>
<?php
  }
?>
