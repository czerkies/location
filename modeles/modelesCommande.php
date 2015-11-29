<?php

class modelesCommande extends modelesSuper {

  // ********** Insertion d'une commande ********** //
  public function insertionCommande($montant, $id_membre){

    $pdo = $this->connect_central_bdd();

    $insertion = $pdo->prepare("INSERT INTO commande(montant, id_membre, date) VALUES(:montant, :id_membre, NOW())");

    $insertion->bindValue(':montant', $montant, PDO::PARAM_INT);
    $insertion->bindValue(':id_membre', $id_membre, PDO::PARAM_INT);

    $insertion->execute();

  }

  // ********** Affichage produit offres pages d'accueil ********** //
  /* public function affichageACC(){

    $pdo = $this->connect_central_bdd();

    $produitACC = $pdo->query("SELECT s.titre, s.photo, s.ville, s.capacite,
      DATE_FORMAT(p.date_arrivee, '%d/%m/%Y') AS date_arrivee,
      DATE_FORMAT(p.date_depart, '%d/%m/%Y') AS date_depart,
      p.prix, p.id_produit
      FROM salle s, produit p
      WHERE s.id_salle = p.id_salle
      AND p.etat = 0
      AND p.date_arrivee >= NOW()
      LIMIT 0,3
    ");

    return $produitACC;

  }

  // ********** Insertion d'un produit depuis l'admin ********** //
  public function InsertionProduitAdmin($id_salle, $date_arrivee, $date_depart, $prix, $id_promo){

    $select = $this->connect_central_bdd();

    $insertion = $select->prepare("INSERT INTO produit(date_arrivee, date_depart, id_salle, id_promo, prix) VALUES(:date_arrivee, :date_depart, :id_salle, :id_promo, :prix)");

    $insertion->bindValue(':date_arrivee', $date_arrivee, PDO::PARAM_STR);
    $insertion->bindValue(':date_depart', $date_depart, PDO::PARAM_STR);
    $insertion->bindValue(':id_salle', $id_salle, PDO::PARAM_INT);
    $insertion->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
    $insertion->bindValue(':prix', $prix, PDO::PARAM_INT);

    $insertion->execute();

  }

  // ********** Suppréssion d'un produit Administrateur ********** //
  public function suppressionProduitAdmin($id_produit){

    $del_sql = $this->connect_central_bdd();
    $del = $del_sql->prepare("DELETE FROM produit WHERE id_produit = $id_produit");
    $del->execute();

  }

  // ********** Mondification d'un Produit par Admin ********** //
  public function updateProduitAdmin($id_salle, $date_arrivee, $date_depart, $prix, $id_promo, $id_produit){

    $pdo = $this->connect_central_bdd();

    $insertion = $pdo->prepare("UPDATE produit SET id_salle = :id_salle, date_arrivee = :date_arrivee, date_depart = :date_depart, prix = :prix, id_promo = :id_promo WHERE id_produit = $id_produit");

    $insertion->bindValue(':id_salle', $id_salle, PDO::PARAM_INT);
    $insertion->bindValue(':date_arrivee', $date_arrivee, PDO::PARAM_STR);
    $insertion->bindValue(':date_depart', $date_depart, PDO::PARAM_STR);
    $insertion->bindValue(':prix', $prix, PDO::PARAM_INT);
    $insertion->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);

    $insertion->execute();

  } */

}
