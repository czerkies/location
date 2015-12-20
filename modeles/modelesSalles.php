<?php

class modelesSalles extends modelesSuper {

  // ********** AffichageSalles ********* //
  public function affichageSalles(){

    $donnees = $this->connect_central_bdd()->query("SELECT * FROM salle");

    $salles = $donnees->fetchAll(PDO::FETCH_ASSOC);

    return $salles;

  }

  // ********** Récupération salle par ID pour modification ********** //
  public function modifSalleID($id_salle){

    $donnees = $this->connect_central_bdd()->query("SELECT * FROM salle WHERE id_salle = $id_salle");

    $modifRecup = $donnees->fetch(PDO::FETCH_ASSOC);

    return $modifRecup;

  }

  // ********** Insertion d'une nouvelle salle ********* //
  public function ajouterSalle($pays, $ville, $adresse, $cp, $titre, $description, $photo, $capacite, $categorie){

    $insertion = $this->connect_central_bdd()->prepare("INSERT INTO salle(pays, ville, adresse, cp, titre, description, photo, capacite, categorie) VALUES(:pays, :ville, :adresse, :cp, :titre, :description, :photo, :capacite, :categorie)");

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

    $insertion = $this->connect_central_bdd()->prepare("UPDATE salle SET pays = :pays, ville = :ville, adresse = :adresse, cp = :cp, titre = :titre, description = :description, photo = :photo, capacite = :capacite, categorie = :categorie WHERE id_salle = $id_salle");

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

  // ********** Vérification produit existant pour modeles ********** //
  public function VerifSalleProduit($id_salle){

    $donnees = $this->connect_central_bdd()->query("SELECT id_produit FROM produit WHERE etat = 1 AND id_salle =(SELECT id_salle FROM salle WHERE id_salle = $id_salle)");

    $produitAssoc = $donnees->rowCount();

    return $produitAssoc;

  }

  // ********** Vérification si une salle est rattachée à un produit ********** //
  public function verifSuppSalle($id_salle){

    $donnees = $this->connect_central_bdd()->query("SELECT id_produit FROM produit WHERE id_salle =(SELECT id_salle FROM salle WHERE id_salle = $id_salle)");

    return $suppSalle = $donnees->rowCount();

  }

  // ********** Suppréssion d'une salle ********** //
  public function suppressionSalle($id_salle){

    $del = $this->connect_central_bdd()->prepare("DELETE FROM salle WHERE id_salle = $id_salle");

    $del->execute();

  }

  // *********** Récupération des categories de salles ********** //
  public function categoriesSalle(){

    $donnees = $this->connect_central_bdd()->query("SHOW COLUMNS FROM salle LIKE 'categorie'");

    $categories = $donnees->fetch(PDO::FETCH_ASSOC);

    preg_match('/enum\(\'(.*)\'\)$/', $categories['Type'], $matches);
    $values = explode('\',\'', $matches[1]);

    return $values;

  }

}
