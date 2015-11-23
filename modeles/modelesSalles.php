<?php

class modelesSalles extends modelesSuper {

  // ********** AffichageSalles ********* //
  public function affichageSalles(){

    $pdo = $this->connect_central_bdd();

    $salles = $pdo->query("SELECT * FROM salle");

    return $salles;

  }

  // ********** Récupération salle par ID pour modification ********** //
  public function modifSalleID($id_salle){

    $pdo = $this->connect_central_bdd();

    $modifRecup = $pdo->query("SELECT * FROM salle WHERE id_salle = $id_salle");

    return $modifRecup;

  }

  // ********** Insertion d'une nouvelle salle ********* //
  public function ajouterSalle($pays, $ville, $adresse, $cp, $titre, $description, $photo, $capacite, $categorie){

    $select = $this->connect_central_bdd();

    $insertion = $select->prepare("INSERT INTO salle(pays, ville, adresse, cp, titre, description, photo, capacite, categorie) VALUES(:pays, :ville, :adresse, :cp, :titre, :description, :photo, :capacite, :categorie)");

    $insertion->bindValue(':pays', $pays, PDO::PARAM_STR);
    $insertion->bindValue(':ville', $ville, PDO::PARAM_STR);
    $insertion->bindValue(':adresse', $adresse, PDO::PARAM_STR);
    $insertion->bindValue(':cp', $cp, PDO::PARAM_INT);
    $insertion->bindValue(':titre', $titre, PDO::PARAM_STR);
    $insertion->bindValue(':description', $description, PDO::PARAM_STR);
    $insertion->bindValue(':photo', $photo, PDO::PARAM_INT);
    $insertion->bindValue(':capacite', $capacite, PDO::PARAM_INT);
    $insertion->bindValue(':categorie', $categorie, PDO::PARAM_STR);

    $insertion->execute();

  }


  // ********** Modification d'une salle ********** //
  public function modificationSalle($id_salle, $pays, $ville, $adresse, $cp, $titre, $description, $photo, $capacite, $categorie){

    $pdo = $this->connect_central_bdd();

    $insertion = $pdo->prepare("UPDATE salle SET pays = :pays, ville = :ville, adresse = :adresse, cp = :cp, titre = :titre, description = :description, photo = :photo, capacite = :capacite, categorie = :categorie WHERE id_salle = $id_salle");

    $insertion->bindValue(':pays', $pays, PDO::PARAM_STR);
    $insertion->bindValue(':ville', $ville, PDO::PARAM_STR);
    $insertion->bindValue(':adresse', $adresse, PDO::PARAM_STR);
    $insertion->bindValue(':cp', $cp, PDO::PARAM_INT);
    $insertion->bindValue(':titre', $titre, PDO::PARAM_STR);
    $insertion->bindValue(':description', $description, PDO::PARAM_STR);
    $insertion->bindValue(':photo', $photo, PDO::PARAM_STR);
    $insertion->bindValue(':capacite', $capacite, PDO::PARAM_INT);
    $insertion->bindValue(':categorie', $categorie, PDO::PARAM_STR);

    $insertion->execute();

    return $insertion;

  }

  // ********** Suppréssion d'une salle ********** //
  public function suppressionSalle($id_salle){

    $del_sql = $this->connect_central_bdd();
    $del = $del_sql->prepare("DELETE FROM salle WHERE id_salle = $id_salle");
    $del->execute();

  }

}
