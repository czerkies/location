<?php

class modelesProduit extends modelesSuper {

  // ********** Affichage produit offres pages d'accueil ********** //
  public function affichageACC(){

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

  // ********** Affichage produit toutes nos offres ********** //
  public function affichageReservation(){

    $pdo = $this->connect_central_bdd();

    $produitOffre = $pdo->query("SELECT s.titre, s.photo, s.ville, s.capacite,
      DATE_FORMAT(p.date_arrivee, '%d/%m/%Y') AS date_arrivee,
      DATE_FORMAT(p.date_depart, '%d/%m/%Y') AS date_depart,
      p.prix, p.id_produit
      FROM salle s, produit p
      WHERE s.id_salle = p.id_salle
      AND p.etat = 0
      AND p.date_arrivee >= NOW()
    ");

    return $produitOffre;

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

  // *********** Affichage produit administateur ********** //
  public function affichageProduitsAdmin(){

    $recupProduitsAdmin = $this->connect_central_bdd();

    $produitsAdmin = $recupProduitsAdmin->query("SELECT p.id_produit,
      DATE_FORMAT(p.date_arrivee, '%d/%m/%Y') AS date_arrivee,
      DATE_FORMAT(p.date_depart, '%d/%m/%Y') AS date_depart,
      p.prix, p.id_produit, p.etat, s.id_salle, s.ville, s.pays, o.code_promo
      FROM produit p
      LEFT JOIN promotion o
      ON p.id_promo = o.id_promo
      LEFT JOIN salle s
      ON s.id_salle = p.id_salle
    ");

    return $produitsAdmin;

  }

  // ********** Affichage produit administateur par date_arrivee DESC ********** //
  public function affichageProduitsAdminTypeOrder($type, $order){

    $recupProduitsAdmin = $this->connect_central_bdd();

    $typeOrder = $recupProduitsAdmin->query("SELECT p.id_produit,
      DATE_FORMAT(p.date_arrivee, '%d/%m/%Y') AS date_arrivee,
      DATE_FORMAT(p.date_depart, '%d/%m/%Y') AS date_depart,
      p.prix, p.id_produit, p.etat, s.id_salle, s.ville, s.pays, o.code_promo
      FROM produit p
      LEFT JOIN promotion o
      ON p.id_promo = o.id_promo
      LEFT JOIN salle s
      ON s.id_salle = p.id_salle
      ORDER BY p.$type $order
    ");

    return $typeOrder;

  }

  // ********** Suppréssion d'un produit Administrateur ********** //
  public function suppressionProduitAdmin($id_produit){

    $del_sql = $this->connect_central_bdd();
    $del = $del_sql->prepare("DELETE FROM produit WHERE id_produit = $id_produit");
    $del->execute();

  }

  // ********** Récupération produit par ID Administrateur ********** //
  public function recupProduitParID($id_produit){ // Récupérer les secondes SVP !

    $recupProduitParID = $this->connect_central_bdd();

    $produitID = $recupProduitParID->query("SELECT s.*,
      DATE_FORMAT(p.date_arrivee, '%d/%m/%Y %H:%i') AS date_arrivee,
      DATE_FORMAT(p.date_depart, '%d/%m/%Y %H:%i') AS date_depart,
      p.prix, p.id_produit, p.etat, p.id_promo
      FROM produit p, salle s
      WHERE s.id_salle = p.id_salle
      AND p.id_produit = $id_produit
    ");

    return $produitID;

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

  }

}
