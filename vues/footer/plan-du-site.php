<div>
  <h2>Plan du site</h2>
  <h3>Visiteurs</h3>
  <p><a href="<?= RACINE_SITE; ?>">Accueil</a></p>
  <p><a href="<?= RACINE_SITE; ?>nos-salles/">Réservations</a></p>
  <p><a href="<?= RACINE_SITE; ?>recherche/">Recherche</a></p>
  <p><a href="<?= RACINE_SITE; ?>connexion/">Connexion</a></p>
  <p><a href="<?= RACINE_SITE; ?>inscription/">Créer un compte</a></p>
  <p><a href="<?= RACINE_SITE; ?>mentions-legales/">Mentions Légales</a></p>
  <p><a href="<?= RACINE_SITE; ?>conditions-generales-de-ventes/">Conditions générales de ventes</a></p>
  <p><a href="<?= RACINE_SITE; ?>plan-du-site/">Connexion</a></p>
  <p><a href="<?= RACINE_SITE; ?>newsletter/">S'inscrire à la Newsletter</a></p>
  <p><a href="<?= RACINE_SITE; ?>contact/">Contacter Lokisalle</a></p>
  <?php if($userConnect || $userConnectAdmin){ ?>
  <h3>Membres</h3>
  <p><a href="<?= RACINE_SITE; ?>mon-profil/">Votre profil</a></p>
  <p><a href="<?= RACINE_SITE; ?>mon-profil/modification/">Modifier votre profil</a></p>
  <p><a href="<?= RACINE_SITE; ?>panier/">Votre panier</a></p>
  <p><a onclick="confirmationDeco()" href="#">Se déconnecter</a></p>
  <?php } ?>
</div>
