<div id="plan-du-site">
  <h2>Plan du site</h2>
  <div class="plan-du-site__visiteur">
    <div class="tableau">
      <div class="head">
        <p class="title wp100">Visiteur</p>
      </div>
      <ul class="body">
        <li><a href="<?= RACINE_SITE; ?>"><p class="cel wp100">Accueil</p></a></li>
        <li><a href="<?= RACINE_SITE; ?>nos-salles/"><p class="cel wp100">Réservations</p></a></li>
        <li><a href="<?= RACINE_SITE; ?>recherche/"><p class="cel wp100">Recherche</p></a></li>
        <?php if(!($userConnect || $userConnectAdmin)){ ?>
        <li><a href="<?= RACINE_SITE; ?>connexion/"><p class="cel wp100">Connexion</p></a></li>
        <li><a href="<?= RACINE_SITE; ?>inscription/"><p class="cel wp100">Créer un compte</p></a></li>
        <?php } ?>
        <li><a href="<?= RACINE_SITE; ?>mentions-legales/"><p class="cel wp100">Mentions Légales</p></a></li>
        <li><a href="<?= RACINE_SITE; ?>conditions-generales-de-ventes/"><p class="cel wp100">Conditions générales de ventes</p></a></li>
        <li><a href="<?= RACINE_SITE; ?>newsletter/"><p class="cel wp100">S'inscrire à la Newsletter</p></a></li>
        <li><a href="<?= RACINE_SITE; ?>contact/"><p class="cel wp100">Nous contacter</p></a></li>
      </ul>
    </div>
  </div>
  <?php if($userConnect || $userConnectAdmin){ ?>
  <div class="plan-du-site__admin">
    <div class="tableau">
      <div class="head">
        <p class="title wp100">Membre</p>
      </div>
      <ul class="body">
        <li><a href="<?= RACINE_SITE; ?>mon-profil/"><p class="cel wp100">Votre profil</p></a></li>
        <li><a href="<?= RACINE_SITE; ?>mon-profil/modification/"><p class="cel wp100">Modifier votre profil</p></a></li>
        <li><a href="<?= RACINE_SITE; ?>panier/"><p class="cel wp100">Votre panier</p></a></li>
        <li><a onclick="confirmationDeco()" href="#"><p class="cel wp100">Se déconnecter</p></a></li>
      </ul>
    </div>
  </div>
</div>
<?php } ?>
</div>
