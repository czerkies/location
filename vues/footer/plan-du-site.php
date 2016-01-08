<div id="plan-du-site">
  <h2>Plan du site</h2>
  <div class="tableau">
    <div class="head">
      <p class="title wp100">Visiteur</p>
    </div>
    <ul class="body">
      <li><a href="<?= RACINE_SITE; ?>"><p class="cel wp100">Accueil</p></a></li>
      <li><p class="cel wp100"><a href="<?= RACINE_SITE; ?>nos-salles/">Réservations</a></p></li>
      <li><p class="cel wp100"><a href="<?= RACINE_SITE; ?>recherche/">Recherche</a></p></li>
      <?php if(!($userConnect || $userConnectAdmin)){ ?>
      <li><p class="cel wp100"><a href="<?= RACINE_SITE; ?>connexion/">Connexion</a></p></li>
      <li><p><a href="<?= RACINE_SITE; ?>inscription/">Créer un compte</a></p></li>
      <?php } ?>
      <li><p class="cel wp100"><a href="<?= RACINE_SITE; ?>mentions-legales/">Mentions Légales</a></p></li>
      <li><p class="cel wp100"><a href="<?= RACINE_SITE; ?>conditions-generales-de-ventes/">Conditions générales de ventes</a></p></li>
      <li><p class="cel wp100"><a href="<?= RACINE_SITE; ?>newsletter/">S'inscrire à la Newsletter</a></p></li>
      <li><p class="cel wp100"><a href="<?= RACINE_SITE; ?>contact/">Nous contacter</a></p></li>
    </ul>
  </div>
  <?php if($userConnect || $userConnectAdmin){ ?>
  <div class="form-group">
    <label>Membres</label>
    <ul class="body">
      <li><p class="cel"><a href="<?= RACINE_SITE; ?>mon-profil/">Votre profil</a></p><li>
      <p><a href="<?= RACINE_SITE; ?>mon-profil/modification/">Modifier votre profil</a></p>
      <p><a href="<?= RACINE_SITE; ?>panier/">Votre panier</a></p>
      <p><a onclick="confirmationDeco()" href="#">Se déconnecter</a></p>
    </ul>
  </div>
  <?php } ?>
</div>
