<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?= $title['name']; ?> | Lokisalle</title>
    <meta name="description" content="Lokisalle | Réservez vos salle avec un service clef en main.">
    <link rel="stylesheet" href="<?= RACINE_SITE; ?>css/style.css" charset="utf-8">
  </head>
  <body>
    <div id="nav">
      <ul class="menu_user">
        <li><a href="<?= RACINE_SITE; ?>accueil/" <?php if($title['menu'] === 1) echo 'class="active" '; ?>>Accueil</a></li>
        <li><a href="<?= RACINE_SITE; ?>nos-salles/" <?php if($title['menu'] === 2) echo 'class="active" '; ?>>Réservations</a></li>
        <li><a href="<?= RACINE_SITE; ?>recherche/" <?php if($title['menu'] === 3) echo 'class="active" '; ?>>Recherche</a></li>
        <?php if(!$userConnect || !$userConnectAdmin){ ?>
        <li><a href="<?= RACINE_SITE; ?>connexion/">Connexion</a></li>
        <?php } if($userConnect || $userConnectAdmin){ ?>
        <li><a href="<?= RACINE_SITE; ?>mon-profil/">Profil</a></li>
        <li><a href="<?= RACINE_SITE; ?>panier/">Mon panier</a></li>
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
      <ul class="menu_footer">
        <li><a href="#">Mentions légales</a></li>
        <li><a href="#">C.G.V</a></li>
        <li><a href="#">Plan du site</a></li>
        <li><a href="#" onclick="javascript:window.print()">Imprimer la page</a></li>
        <li><a href="<?= RACINE_SITE; ?>newsletter/">S'inscrire à la newsletter</a></li>
        <li><a href="<?= RACINE_SITE; ?>contact/">Contact</a></li>
      </ul>
    </footer>
  </body>
  <script type="text/javascript">
    function confirmationDeco() {
      if (confirm("Êtes vous sûr de vouloir vous déconnecter ?")) {
        window.location.href = "<?= RACINE_SITE; ?>deconnexion/a-bientot/";
      }
    }
  </script>
</html>
