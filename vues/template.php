<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?= $title['name']; ?> | Lokisalle</title>
    <meta name="description" content="Lokisalle | Réservez vos salle avec un service clef en main.">
    <link rel="stylesheet" href="<?= RACINE_SITE; ?>css/style.css" charset="utf-8">
  </head>
  <body>
    <div id="header">
      <a href="<?= RACINE_SITE; ?>">
        <h1>Loki<span>salle</span></h1>
        <p>Service de location de salles, simple et rapide.</p>
      </a>
    </div>
    <div id="nav">
      <ul class="menu_user <?php if(!($userConnect || $userConnectAdmin)) echo 'menu_visiteur'; ?>">
        <li><a href="<?= RACINE_SITE; ?>" <?php if($title['menu'] === 1) echo 'class="active" '; ?>>Accueil</a></li>
        <li><a href="<?= RACINE_SITE; ?>nos-salles/" <?php if($title['menu'] === 2) echo 'class="active" '; ?>>Réservations</a></li>
        <li><a href="<?= RACINE_SITE; ?>recherche/" <?php if($title['menu'] === 3) echo 'class="active" '; ?>>Recherche</a></li>
        <?php if(!($userConnect || $userConnectAdmin)){ ?>
        <li><a href="<?= RACINE_SITE; ?>connexion/" <?php if($title['menu'] === 4) echo 'class="active" '; ?>>Connexion</a></li>
        <?php } if($userConnect || $userConnectAdmin){ ?>
        <li><a href="<?= RACINE_SITE; ?>mon-profil/" <?php if($title['menu'] === 5) echo 'class="active" '; ?>>Profil</a></li>
        <li><a href="<?= RACINE_SITE; ?>panier/" <?php if($title['menu'] === 6) echo 'class="active" '; ?>>Mon panier</a></li>
        <li><a onclick="confirmationDeco()" href="#" <?php if($title['menu'] === 7) echo 'class="active" '; ?>>Se déconnecter</a></li>
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
        <li><a href="<?= RACINE_SITE; ?>mentions-legales/" <?php if($title['menu'] === 16) echo 'class="active" '; ?>>Mentions légales</a></li>
        <li><a href="<?= RACINE_SITE; ?>conditions-generales-de-ventes/" <?php if($title['menu'] === 17) echo 'class="active" '; ?>>C.G.V</a></li>
        <li><a href="<?= RACINE_SITE; ?>plan-du-site/" <?php if($title['menu'] === 18) echo 'class="active" '; ?>>Plan du site</a></li>
        <li><a href="#" onclick="javascript:window.print()">Imprimer la page</a></li>
        <li><a href="<?= RACINE_SITE; ?>newsletter/" <?php if($title['menu'] === 19) echo 'class="active" '; ?>>S'inscrire à la newsletter</a></li>
        <li><a href="<?= RACINE_SITE; ?>contact/" <?php if($title['menu'] === 20) echo 'class="active" '; ?>>Contact</a></li>
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
