<?php if($userConnect){ ?>
<h1>Votre profil</h1>
<div id="profil">
  <h2>Voici vos informations</h2>
  <?= $msg; ?>
  <?php if(isset($_GET['modif']) == 'true'){ ?>
  <form class="" action="" method="post">
    <label for="pseudo">Votre Pseudo :</label> <input type="text" name="pseudo" id="pseudo" value="<?php if(isset($_POST['pseudo'])) {echo $_POST['pseudo'];} else {echo $_SESSION['membre']['pseudo'];} ?>">
    <label for="email">Votre Email est :</label> <input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} else {echo $_SESSION['membre']['email'];} ?>">
    <label for="nom">Votre Nom :</label> <input type="text" name="nom" id="nom" value="<?php if(isset($_POST['nom'])) {echo $_POST['nom'];} else {echo $_SESSION['membre']['nom'];} ?>">
    <label for="prenom">Votre Prénom :</label> <input type="text" name="prenom" id="prenom" value="<?php if(isset($_POST['prenom'])) {echo $_POST['prenom'];} else {echo $_SESSION['membre']['prenom'];} ?>">
    <input type="radio" name="sexe" value="m" id="m" <?php
      if(isset($_POST['sexe']) && $_POST['sexe'] === 'm') {
        echo "checked";
      } elseif ($_SESSION['membre']['sexe'] === 'm'){
        echo "checked";
      }
    ?>
    ><label for="m">Homme</label>
    <input type="radio" name="sexe" value="f" id="f" <?php
      if(isset($_POST['sexe']) && $_POST['sexe'] === 'f') {
        echo "checked";
      } elseif ($_SESSION['membre']['sexe'] === 'f'){
        echo "checked";
      }
    ?>
    ><label for="f">Femme</label>
    <label for="ville">Votre ville est :</label> <input type="text" name="ville" id="ville" value="<?php if(isset($_POST['ville'])) {echo $_POST['ville'];} else {echo $_SESSION['membre']['ville'];} ?>">
    <label for="cp">Votre Code Postal est :</label> <input type="text" name="cp" id="cp" value="<?php if(isset($_POST['cp'])) {echo $_POST['cp'];} else {echo $_SESSION['membre']['cp'];} ?>">
    <label for="adresse">Votre adresse est :</label> <textarea name="adresse" name="adresse" id="adresse"><?php if(isset($_POST['adresse'])) {echo $_POST['adresse'];} else {echo $_SESSION['membre']['adresse'];} ?></textarea>
    <input type="submit" value="Enregistrer les informations">
  </form>
    <?php } else { ?>
  <label for="pseudo">Votre Pseudo :</label> <p><?= $_SESSION['membre']['pseudo']; ?></p>
  <label for="email">Votre Email est :</label> <p><?= $_SESSION['membre']['email']; ?></p>
  <label for="nom">Votre Nom :</label> <p><?= $_SESSION['membre']['nom']; ?></p>
  <label for="prenom">Votre Prénom :</label> <p><?= $_SESSION['membre']['prenom']; ?></p>
  <label for="ville">Votre ville est :</label> <p><?= $_SESSION['membre']['ville']; ?></p>
  <label for="cp">Votre Code Postal est :</label> <p><?= $_SESSION['membre']['cp']; ?></p>
  <label for="adresse">Votre adresse est :</label> <p><?= $_SESSION['membre']['adresse']; ?></p>
  <a href="routeur.php?controleurs=membre&action=profilMembre&modif=true">Mettre à jour mes informations</a>
  <?php } ?>
</div>
<div id="last_commande">
  <h2>Vos 6 dernières commandes</h2>
  <?php if(!$commandes){ ?>
    <p>Vous n'avez encore jamais passé de commande.</p>
  <?php } else { ?>
  <table border="1">
    <thead>
      <tr>
        <th>Numéro de commande</th>
        <th>Date de la commande</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($commandes as $value) { ?>
        <tr>
          <td><?= $value['id_commande']; ?></td>
          <td><?= $value['date_commande']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php } ?>
</div>
<?php } ?>
