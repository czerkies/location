<div class="form-group">
  <label for="pseudo">Pseudo</label>
  <input type="text" id="pseudo" name="pseudo" value="<?php if(isset($_POST['pseudo'])) {echo $_POST['pseudo'];} ?>" placeholder="Pseudo" required>
  <em>Veuillez inscrire un speudo, sans espace.</em>
</div>
<div class="form-group">
  <label for="mdp">Mot de passe</label>
  <input type="password" id="mdp" name="mdp" value="" placeholder="Mot de passe" required>
  <em>Votre mot de passe doit comporter au moins une majuscule ou un chiffre.</em>
</div>
<div class="form-group">
  <label for="nom">Nom</label>
  <input type="text" id="nom" name="nom" value="<?php if(isset($_POST['nom'])) {echo $_POST['nom'];} ?>" placeholder="Nom" required>
  <em>Votre Nom est nécésaire pour la facturation de vos commandes.</em>
</div>
<div class="form-group">
  <label for="prenom">Prénom</label>
  <input type="text" id="prenom" name="prenom" value="<?php if(isset($_POST['prenom'])) {echo $_POST['prenom'];} ?>" placeholder="Prénom" required>
  <em>Votre Prénom est nécésaire pour la facturation de vos commandes.</em>
</div>
<div class="form-group">
  <label for="email">Email</label>
  <input type="email" id="email" name="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>" placeholder="Email" required>
  <em>Vous permet de recevoir newsletter ou reçus après commande.</em>
</div>
<div class="form-group">
  <label for="">Sexe</label>
  <div class="form-group__radio">
    <input type="radio" name="sexe" value="m" id="m" <?php
      if(isset($_POST['sexe']) && $_POST['sexe'] === 'm') {
        echo "checked";
      } else {
        echo "checked";
      }?>><label for="m">Homme</label>
    <input type="radio" name="sexe" value="f" id="f" <?php
    if(isset($_POST['sexe']) && $_POST['sexe'] === 'f') {
      echo "checked";
    }?>><label for="f">Femme</label>
  </div>
  <em></em>
</div>
<div class="form-group">
  <label for="ville">Ville</label>
  <input type="text" id="ville" name="ville" value="<?php if(isset($_POST['ville'])) {echo $_POST['ville'];} ?>" placeholder="Ville" required>
  <em>Votre Ville est nécésaire pour la facturation de vos commandes.</em>
</div>
<div class="form-group">
  <label for="cp">Code postal</label>
  <input type="text" id="cp" name="cp" value="<?php if(isset($_POST['cp'])) {echo $_POST['cp'];} ?>" placeholder="Code Postal" required>
  <em>Code postal à 5 chiffres.</em>
</div>
<div class="form-group large">
  <label for="adresse">Adresse</label>
  <textarea name="adresse" id="adresse" placeholder="Adresse" required><?php if(isset($_POST['adresse'])) {echo $_POST['adresse'];} ?></textarea>
  <em>Entrez votre adresse complète.</em>
</div>
