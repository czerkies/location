<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?= $title; ?> | Lokisalle</title>
    <meta name="description" content="Lokisalle | Réservez vos salle avec un service clef en main.">
    <link rel="stylesheet" href="<?= RACINE_SITE; ?>css/style.css" charset="utf-8">
  </head>
  <body>
    <div id="nav">
      <ul>
        <li><a href="<?= RACINE_SITE; ?>accueil/">Accueil</a></li>
        <li><a href="<?= RACINE_SITE; ?>routeur.php?controleurs=produit&action=produitReservation">Réservations</a></li>
        <li><a href="<?= RACINE_SITE; ?>routeur.php?controleurs=produit&action=rechercheProduit">Recherche</a></li>
        <li><a href="<?= RACINE_SITE; ?>routeur.php?controleurs=membre&action=connexionMembre">Connexion</a></li>
        <?php if($userConnect || $userConnectAdmin){ ?>
        <li><a href="<?= RACINE_SITE; ?>routeur.php?controleurs=membre&action=profilMembre">Profil</a></li>
        <li><a href="<?= RACINE_SITE; ?>routeur.php?controleurs=panier&action=affichagePanier">Mon panier</a></li>
        <li><a onclick="confirmationDeco()" href="#">Se déconnecter</a></li>
        <?php } ?>
      </ul>
      <?php if($userConnectAdmin){
        include_once 'menu.inc.php';
      } ?>
    </div>
    <div id="cont">
      <?= $buffer; ?>
    </div>
    <footer>
      <ul>
        <li>Mentions légales</li>
        <li>C.G.V</li>
        <li>Plan du site</li>
        <li><a href="#" onclick="javascript:window.print()">Imprimer la page</a></li>
        <li><a href="<?= RACINE_SITE; ?>routeur.php?controleurs=newsletter&action=inscriptionMembre">S'inscrire à la newsletter</a></li>
        <li><a href="<?= RACINE_SITE; ?>routeur.php?controleurs=membre&action=contactMembre">Contact</a></li>
      </ul>
    </footer>
  </body>
  <script type="text/javascript">
    function confirmationDeco() {
      if (confirm("Êtes vous sûr de vouloir vous déconnecter ?")) {
        window.location.href = "<?= RACINE_SITE; ?>routeur.php?controleurs=membre&action=deconnexionMembre&deconnexion=oui";
      }
    }
  </script>
</html>
