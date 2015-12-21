<h1>Contacter un administateur</h1>
<?= $msg ?>
<div id="inscription">
  <form class="" action="" method="post">
    <label for="sujet">Sujet :</label>
    <input type="text" name="sujet" value="<?php if(isset($_POST['sujet'])) {echo $_POST['sujet'];} ?>" id="sujet" placeholder="Sujet" minlength="4" maxlength="30" required>
    <?php if(!$userConnect){ ?>
    <label for="email">Votre Email :</label>
    <input type="email" name="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>" id="email" placeholder="Email" minlength="4" maxlength="50" required>
    <?php } ?>
    <textarea name="message" rows="8" cols="40" minlength="10" maxlength="4000" placeholder="Votre message" required><?php if(isset($_POST['message'])) {echo $_POST['message'];} ?></textarea>
    <input type="submit" value="Envoie">
  </form>
</div>
