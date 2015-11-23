<?php if($userConnectAdmin){ ?>
<h1>Envoyer la newsletter</h1>
<?= $msg; ?>
<div id="envoi_newsletter">
  <p>Nombre d'abonné à la newsletter : <?= $nbAbonne ?></p>
  <form class="" action="" method="post">
    <label for="expediteur">Expéditeur :</label>
    <input type="text" name="expediteur" value="<?php if(isset($_POST['expediteur'])) {echo $_POST['expediteur'];} else {echo $mailAdmin;} ?>" id="expediteur" placeholder="Expediteur" required>
    <label for="sujet">Sujet :</label>
    <input type="text" name="sujet" value="<?php if(isset($_POST['sujet'])) {echo $_POST['sujet'];} ?>" id="sujet" placeholder="Sujet" required>
    <textarea name="message" rows="8" cols="40" placeholder="Votre message"><?php if(isset($_POST['message'])) {echo $_POST['message'];} ?></textarea>
    <input type="submit" value="Envoi de la newsletter aux membre">
  </form>
</div>
<?php
} else {
  echo "Vous devez être administrateur pour accéder à cette page.";
}
?>
