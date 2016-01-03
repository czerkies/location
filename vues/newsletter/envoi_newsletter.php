<?php if($userConnectAdmin){ ?>
<?php include '../vues/dialogue.php'; ?>
<h2>Envoyer la newsletter</h2>
<div id="envoi_newsletter">
  <h3>Nombre d'abonné à la newsletter : <b><?= $nbAbonne; ?></b></h3>
  <form class="" action="" method="post">
    <div class="form-group">
      <label for="expediteur">Expéditeur :</label>
      <input type="text" name="expediteur" value="<?php if(isset($_POST['expediteur'])) {echo $_POST['expediteur'];} else {echo $mailAdmin;} ?>" id="expediteur" placeholder="Expediteur" required>
      <em>Mail que l'expéditeur recevra.</em>
    </div>
    <div class="form-group">
      <label for="sujet">Sujet :</label>
      <input type="text" name="sujet" value="<?php if(isset($_POST['sujet'])) {echo $_POST['sujet'];} ?>" id="sujet" placeholder="Sujet" required>
      <em></em>
    </div>
    <div class="form-group large">
      <label for="message">La Newsletter</label>
      <textarea name="message" id="message" placeholder="Votre message"><?php if(isset($_POST['message'])) {echo $_POST['message'];} ?></textarea>
      <em>Le contenu de votre Newsletter.</em>
    </div>
    <input type="submit" value="Envoi de la newsletter aux membre">
  </form>
</div>
<?php } ?>
