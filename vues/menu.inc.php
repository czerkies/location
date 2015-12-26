<ul class="menu_userAdmin">
  <li><a href="routeur.php?controleurs=salles&action=gestionSalles" <?php if($title['menu'] === 8) echo 'class="active" '; ?>>Gestion des salles</a></li>
  <li><a href="routeur.php?controleurs=produitAdmin&action=afficherProduits" <?php if($title['menu'] === 9) echo 'class="active" '; ?>>Gestion des produits</a></li>
  <li><a href="routeur.php?controleurs=membreAdmin&action=gestionMembres" <?php if($title['menu'] === 10) echo 'class="active" '; ?>>Gestion des membres</a></li>
  <li><a href="routeur.php?controleurs=commande&action=gestionCommandes" <?php if($title['menu'] === 11) echo 'class="active" '; ?>>Gestion des commandes</a></li>
  <li><a href="routeur.php?controleurs=avis&action=gestionAvis" <?php if($title['menu'] === 12) echo 'class="active" '; ?>>Gestion des avis</a></li>
  <li><a href="routeur.php?controleurs=promotion&action=afficherPromotion" <?php if($title['menu'] === 13) echo 'class="active" '; ?>>Gestion codes promo</a></li>
  <li><a href="routeur.php?controleurs=statistiques&action=affichageStatistiques" <?php if($title['menu'] === 14) echo 'class="active" '; ?>>Statistiques</a></li>
  <li><a href="routeur.php?controleurs=newsletter&action=envoiNews" <?php if($title['menu'] === 15) echo 'class="active" '; ?>>Envoyer la newsletter</a></li>
</ul>
