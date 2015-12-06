<?php

class modelesAvis extends modelesSuper {

  // ********** Récupere tout les les avis ********** //
  public function lesAvis(){

    $donnees = $this->connect_central_bdd()->query("SELECT a.commentaire, a.note, a.id_salle,
      DATE_FORMAT(a.date, '%d %M %Y à %Hh%i') AS date, m.prenom
      FROM avis a, membre m
      WHERE a.id_membre = m.id_membre
    ");

    $lesAvis = $donnees->fetchAll(PDO::FETCH_ASSOC);

    return $lesAvis;

  }

  // ********** Récupere les avis de la salle du produit ********** //
  public function recuperationAvisSalle($id_salle){

    $donnees = $this->connect_central_bdd()->query("SELECT a.commentaire, a.note,
      DATE_FORMAT(a.date, '%d %M %Y') AS date, m.prenom
      FROM avis a, membre m
      WHERE a.id_membre = m.id_membre
      AND a.id_salle = $id_salle
    ");

    $avis = $donnees->fetchAll(PDO::FETCH_ASSOC);

    return $avis;

  }

  // ********** Insertion avis par id_produit ********** //
  public function insertionAvisParID($id_membre, $id_salle, $commentaire, $note){

    $insertion = $this->connect_central_bdd()->prepare("INSERT INTO avis(id_membre, id_salle, commentaire, note, date) VALUES(:id_membre, :id_salle, :commentaire, :note, NOW())");

    $insertion->bindValue(':id_membre', $id_membre, PDO::PARAM_INT);
    $insertion->bindValue(':id_salle', $id_salle, PDO::PARAM_INT);
    $insertion->bindValue(':commentaire', $commentaire, PDO::PARAM_STR);
    $insertion->bindValue(':note', $note, PDO::PARAM_INT);

    $insertion->execute();

  }

  // ********** Vérification présence avis ********* //
  public function verifAvisProduit($id_salle, $id_membre){

      $donnees = $this->connect_central_bdd()->query("SELECT id_avis, id_membre FROM avis WHERE id_salle = $id_salle AND id_membre = $id_membre");

      $nbAvis = $donnees->rowCount();

      return $nbAvis;

  }

}
