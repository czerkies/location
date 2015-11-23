<?php

class modelesAvis extends modelesSuper {

  // ********** Récupere les avis de la salle du produit ********** //
  public function recuperationAvisSalle($id_salle){

    $recupById = $this->connect_central_bdd();
    $avis = $recupById->query("SELECT a.commentaire, a.note,
      DATE_FORMAT(a.date, '%d %M %Y') AS date, m.prenom
      FROM avis a, membre m
      WHERE a.id_membre = m.id_membre
      AND a.id_salle = $id_salle
    ");
    //$avis = $recupById->query("SELECT * FROM avis WHERE id_salle IN(SELECT id_salle FROM salle WHERE id_salle IN(SELECT id_salle FROM produit WHERE id_salle = $id_salle))");
    return $avis;

  }

  // ********** Insertion avis par id_produit ********** //
  public function insertionAvisParID($id_membre, $id_salle, $commentaire, $note){

    $select = $this->connect_central_bdd();

    $insertion = $select->prepare("INSERT INTO avis(id_membre, id_salle, commentaire, note, date) VALUES(:id_membre, :id_salle, :commentaire, :note, NOW())");

    $insertion->bindValue(':id_membre', $id_membre, PDO::PARAM_INT);
    $insertion->bindValue(':id_salle', $id_salle, PDO::PARAM_INT);
    $insertion->bindValue(':commentaire', $commentaire, PDO::PARAM_STR);
    $insertion->bindValue(':note', $note, PDO::PARAM_INT);

    $insertion->execute();

  }

  // ********** Vérification présence avis ********* //
  public function verifAvisProduit($id_salle, $id_membre){

      $pdo = $this->connect_central_bdd();

      $nbAvis = $pdo->query("SELECT id_avis, id_membre FROM avis WHERE id_salle = $id_salle AND id_membre = $id_membre");

      return $nbAvis;

  }

}
