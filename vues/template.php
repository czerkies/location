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
        <li><a href="http://localhost/lokisalle/www/routeur.php?controleurs=produit&action=produitACC">Accueil</a></li>
        <li><a href="http://localhost/lokisalle/www/routeur.php?controleurs=produit&action=produitReservation">Réservations</a></li>
        <li><a href="http://localhost/lokisalle/www/routeur.php?controleurs=produit&action=rechercheProduit">Recherche</a></li>
        <li><a href="http://localhost/lokisalle/www/routeur.php?controleurs=membre&action=connexionMembre">Connexion</a></li>
        <?php if($userConnect || $userConnectAdmin){ ?>
        <li><a href="http://localhost/lokisalle/www/routeur.php?controleurs=membre&action=profilMembre">Profil</a></li>
        <li><a href="http://localhost/lokisalle/www/routeur.php?controleurs=panier&action=affichagePanier">Mon panier</a></li>
        <li><a onclick="confirm('Voulez-vous vraiment vous déconnecter ?');" href="http://localhost/lokisalle/www/routeur.php?controleurs=membre&action=deconnexionMembre&deconnexion=true">Se déconnecter</a></li>
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
        <li><a href="routeur.php?controleurs=newsletter&action=inscriptionMembre">S'inscrire à la newsletter</a></li>
        <li><a href="http://localhost/lokisalle/www/routeur.php?controleurs=membre&action=contactMembre">Contact</a></li>
      </ul>
    </footer>
  </body>
</html>
