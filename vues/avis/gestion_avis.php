<?php if($userConnectAdmin){ ?>
<h2>Gestions des avis</h2>
<?php include '../vues/dialogue.php'; ?>
<div class="tableau large">
  <div class="head">
    <p class="title wp10">ID Salle</p>
    <p class="title wp15">Pseudo</p>
    <p class="title wp50">Commentaire</p>
    <p class="title wp5">Note</p>
    <p class="title wp15">Date de l'avis</p>
    <p class="title wp5">Supp.</p>
  </div>
  <ul class="body">
    <?php foreach ($listeAvis as $value) { ?>
      <li>
        <p class="cel wp10"><?= $value['id_salle']; ?></p>
        <p class="cel wp15"><?php if($value['id_membre'] === NULL){ ?>
          Ancien membre
          <?php } else { ?>
          <?= $value['prenom']; ?>
          <?php } ?>
        </p>
        <p class="cel wp50"><?= substr($value['commentaire'], 0, 60); ?>...</p>
        <p class="cel wp5"><?= $value['note']; ?>/10</p>
        <p class="cel wp15"><?= $value['date']; ?></p>
        <p class="cel wp5 pict"><a href="<?= RACINE_SITE; ?>admin/gestion-avis/<?= $value['id_avis']; ?>"><img src="<?= RACINE_SITE; ?>pict/supp.png" alt="Supprimer"></a></p>
      </li>
    <?php } ?>
  </ul>
</div>
<?php } ?>
