<?php

class modelesDetails_commande extends modelesSuper {

  // ********** Insertion d'une commande en détails ********** //
  public function insertionDetails_commande($id_commande, $id_produit){

    $insertion = $this->connect_central_bdd()->prepare("INSERT INTO details_commande(id_commande, id_produit) VALUES(:id_commande, :id_produit)");

    $insertion->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $insertion->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);

    $insertion->execute();

  }

  // ********** Récupération détails d'une commande en détail ********** //
  public function detailsCommande($id_commande){

    $client = $this->connect_central_bdd()->query("SELECT c.id_membre, c.id_commande, c.montant, m.*, DATE_FORMAT(c.date, '%d/%m/%Y à %Hh%i') as date_commande
    FROM commande c, membre m
    WHERE c.id_membre = m.id_membre
    AND c.id_commande = $id_commande
    ");

    return $client;

  }

  // ********** Récupération produits d'une commande en détail ********** //
  public function detailsCommandeProduits($id_commande){

    $produits = $this->connect_central_bdd()->query("SELECT p.id_produit, p.prix, DATE_FORMAT(p.date_arrivee, '%d/%m/%Y à %Hh%i') as date_arrivee, DATE_FORMAT(p.date_depart, '%d/%m/%Y à %Hh%i') as date_depart, s.photo, s.capacite, s.titre, s.ville
    FROM commande c, details_commande d, produit p, salle s
    WHERE c.id_commande = d.id_commande
    AND d.id_produit = p.id_produit
    AND p.id_salle = s.id_salle
    AND c.id_commande = $id_commande
    ");

    return $produits;

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
