<?php if($userConnectAdmin){ ?>
<h2>Gestions des membres</h2>
<?php if($dialogue) { ?>
<div class="form-group erreur large">
  <label>Attention</label>
  <p>Ce membre est associé à une commande.<br>Si vous le supprimez, vous perdrez ses coordonnées mais pas sa commande.
  Êtes-vous sur de vouloir le supprimer ?
    <a class="bouton-a" href="<?= RACINE_SITE; ?>.php?controleurs=membreAdmin&action=gestionMembres&suppMembre=<?= $_GET['suppMembre']; ?>/oui">Oui</a>
    <a class="bouton-a" href="<?= RACINE_SITE; ?>admin/gestion-membres/">Non</a>
  </p>
</div>
<?php } ?>
<div class="tableau large">
  <div class="head">
    <p class="title wp5">ID</p>
    <p class="title wp15">Pseudo</p>
    <p class="title wp15">Nom</p>
    <p class="title wp15">Prénom</p>
    <p class="title wp25">Email</p>
    <p class="title wp5">Sexe</p>
    <p class="title wp10">Statut</p>
    <p class="title wp10">Actions</p>
  </div>
  <ul class="body">
    <?php foreach ($listeMembres as $value) { ?>
      <li>
        <p class="cel wp5"><?= $value['id_membre']; ?></p>
        <p class="cel wp15"><?= $value['pseudo']; ?></p>
        <p class="cel wp15"><?= strtoupper($value['nom']); ?></p>
        <p class="cel wp15"><?= ucfirst($value['prenom']); ?></p>
        <p class="cel wp25"><?= $value['email']; ?></p>
        <p class="cel wp5"><?= $value['sexe']; ?></p>
        <p class="cel wp10"><?= $value['statut']; ?></p>
        <?php if($value['statut'] == 0) { ?>
        <p class="cel wp10 pict">
          <a href="<?= RACINE_SITE; ?>admin/gestion-membres/suppression/<?= $value['id_membre']; ?>"><img src="<?= RACINE_SITE; ?>/pict/supp.png" alt="Supprimer"></a>
        </p>
        <?php } else { ?>
        <p class="cel wp10">
          Admin
        </p>
        <?php } ?>
      </li>
    <?php } ?>
  </ul>
</div>
<a class="bouton-a" href="<?= RACINE_SITE; ?>admin/gestion-membres/ajouter-admin/#nouvel-admin">Création d'un compte admin</a>
<?php if($ajouterMembre){ ?>
  <div id="nouvel-admin">
  <?php include '../vues/dialogue.php'; ?>
    <form class="" action="#nouvel-admin" method="post">
      <?php include '../vues/inscription.php'; ?>
      <input type="submit" value="Inscription">
    </form>
  </div>
<?php } ?>
<?php } ?>
