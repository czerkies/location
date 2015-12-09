<div class="">
  <?php if($userConnectAdmin){ ?>
  <h1>Gestions des membres</h1>
  <?= $msg; ?>
  <table border="1">
    <thead>
      <th>ID Membre</th>
      <th>Pseudo</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Statut</th>
      <th>Sexe</th>
      <th>Supprimer</th>
    </thead>
    <tbody>
      <?php foreach ($listeMembres as $value) { ?>
        <tr>
          <td><?= $value['id_membre']; ?></td>
          <td><?= $value['pseudo']; ?></td>
          <td><?= strtoupper($value['nom']); ?></td>
          <td><?= ucfirst($value['prenom']); ?></td>
          <td><?= $value['statut']; ?></td>
          <td><?= $value['sexe']; ?></td>
          <td><?php if($value['statut'] == 0) { ?>
            <a href="routeur.php?controleurs=membre&action=gestionMembres&suppMembre=<?= $value['id_membre']; ?>">X</a>
          <?php } ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="">
    <p><a href="routeur.php?controleurs=membre&action=gestionMembres&ajouter=membre">Création d'un compte admin</a></p>
    <?php if($ajouterMembre){ ?>
      <div class="inscription">
        <form class="" action="" method="post">
          <input type="text" name="pseudo" value="<?php if(isset($_POST['pseudo'])) {echo $_POST['pseudo'];} ?>" placeholder="Pseudo" required>
          <input type="password" name="mdp" value="" placeholder="Mot de passe" required>
          <input type="text" name="nom" value="<?php if(isset($_POST['nom'])) {echo $_POST['nom'];} ?>" placeholder="Nom" required>
          <input type="text" name="prenom" value="<?php if(isset($_POST['prenom'])) {echo $_POST['prenom'];} ?>" placeholder="Prénom" required>
          <input type="email" name="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>" placeholder="Email" required>
          <input type="radio" name="sexe" value="m" id="m" <?php
            if(isset($_POST['sexe']) && $_POST['sexe'] === 'm') {
              echo "checked";
            }
          ?>
          ><label for="m">Homme</label>
          <input type="radio" name="sexe" value="f" id="f" <?php
            if(isset($_POST['sexe']) && $_POST['sexe'] === 'f') {
              echo "checked";
            }
          ?>
          ><label for="f">Femme</label>
          <input type="text" name="ville" value="<?php if(isset($_POST['ville'])) {echo $_POST['ville'];} ?>" placeholder="Ville" required>
          <input type="text" name="cp" value="<?php if(isset($_POST['cp'])) {echo $_POST['cp'];} ?>" placeholder="Code Postal" required>
          <textarea name="adresse" placeholder="Adresse" required><?php if(isset($_POST['adresse'])) {echo $_POST['adresse'];} ?></textarea>
          <input type="submit" value="Inscription">
        </form>
      </div>
    <?php } ?>
  </div>
  <?php } ?>
</div>
