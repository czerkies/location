<h2>Contacter <span>LOKI</span>Salle</h2>
<div id="inscription">
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
      <p>Votre email a bien été envoyé.</p>
    </div>
  <?php } ?>
  <form class="large" action="" method="post">
    <div class="form-group">
      <label for="sujet">Sujet</label>
      <input type="text" name="sujet" value="<?php if(isset($_POST['sujet'])) {echo $_POST['sujet'];} ?>" id="sujet" placeholder="Sujet" minlength="4" maxlength="30" required>
      <em>Merci de nous indiquer l'objet de votre demande.</em>
    </div>
    <?php if(!$userConnect){ ?>
    <div class="form-group">
      <label for="email">Votre Email</label>
      <input type="email" id="email" name="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>" id="email" placeholder="Email" minlength="4" maxlength="50" required>
      <em>Nous vous répondrons via cette addrese email.</em>
    </div>
    <?php } ?>
    <div class="form-group large">
      <label for="message">Message</label>
      <textarea name="message" rows="8" cols="40" minlength="10" maxlength="4000" placeholder="Votre message" required><?php if(isset($_POST['message'])) {echo $_POST['message'];} ?></textarea>
      <em>Précisez votre demande</em>
    </div>
    <input type="submit" value="Envoie">
  </form>
</div>
