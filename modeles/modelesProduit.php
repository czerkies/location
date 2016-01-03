<?php

class modelesProduit extends modelesSuper {

  // ********** Vérification existance produit par ID ********** //
  public function verifExistanceIDProduit($id_produit){

    $donnees = $this->connect_central_bdd()->query("SELECT id_produit FROM produit WHERE id_produit = '$id_produit'");

    return $idExist = ($donnees->rowCount() === 1) ? TRUE : FALSE;

  }

  // ********** Affichage produit offres pages d'accueil ********** //
  public function affichageACC(){

    $produitACC = $this->connect_central_bdd()->query("SELECT s.titre, s.photo, s.ville, s.pays, s.capacite,
      DATE_FORMAT(p.date_arrivee, '%d/%m/%Y') AS date_arrivee,
      DATE_FORMAT(p.date_depart, '%d/%m/%Y') AS date_depart,
      p.prix, p.id_produit
      FROM salle s, produit p
      WHERE s.id_salle = p.id_salle
      AND p.etat = 0
      AND p.date_arrivee >= NOW()
      ORDER BY id_produit ASC
      LIMIT 3
    ");

    $produitsAccFetch = $produitACC->fetchAll(PDO::FETCH_ASSOC);

    return $produitsAccFetch;

  }

  // ********** Affichage produit toutes nos offres ********** //
  public function affichageReservation(){

    $produitOffre = $this->connect_central_bdd()->query("SELECT s.titre, s.photo, s.ville, s.pays, s.capacite,
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
  public function insertionProduitAdmin($id_salle, $date_arrivee, $date_depart, $prix, $id_promo){

    $insertion = $this->connect_central_bdd()->prepare("INSERT INTO produit(date_arrivee, date_depart, id_salle, id_promo, prix) VALUES(:date_arrivee, :date_depart, :id_salle, :id_promo, :prix)");

    $insertion->bindValue(':date_arrivee', $date_arrivee, PDO::PARAM_STR);
    $insertion->bindValue(':date_depart', $date_depart, PDO::PARAM_STR);
    $insertion->bindValue(':id_salle', $id_salle, PDO::PARAM_INT);
    $insertion->bindValue(':id_promo', $id_promo, PDO::PARAM_STR);
    $insertion->bindValue(':prix', $prix, PDO::PARAM_INT);

    $resultInsertionProduit = $insertion->execute();

    return $resultInsertionProduit;

  }

  // *********** Affichage produit administateur ********** //
  public function affichageProduitsAdmin(){

    $produitsAdmin = $this->connect_central_bdd()->query("SELECT p.id_produit,
      DATE_FORMAT(p.date_arrivee, '%d/%m/%Y') AS date_arrivee,
      DATE_FORMAT(p.date_depart, '%d/%m/%Y') AS date_depart,
      p.prix, p.id_produit, p.etat, s.id_salle, s.titre, o.code_promo
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

    $typeOrder = $this->connect_central_bdd()->query("SELECT p.id_produit,
      DATE_FORMAT(p.date_arrivee, '%d/%m/%Y') AS date_arrivee,
      DATE_FORMAT(p.date_depart, '%d/%m/%Y') AS date_depart,
      p.prix, p.id_produit, p.etat, s.id_salle, s.titre, o.code_promo
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

    $del = $this->connect_central_bdd()->prepare("DELETE FROM produit WHERE id_produit = $id_produit");

    $del->execute();

  }

  // ********** Récupération produit par ID Administrateur ********** //
  public function recupProduitParID($id_produit){

    $produitID = $this->connect_central_bdd()->query("SELECT s.*,
      DATE_FORMAT(p.date_arrivee, '%d/%m/%Y à %Hh%i') AS date_arrivee,
      DATE_FORMAT(p.date_depart, '%d/%m/%Y à %Hh%i') AS date_depart,
      DATE_FORMAT(p.date_arrivee, '%Y-%m-%d') AS date_arriveeSQL,
      DATE_FORMAT(p.date_depart, '%Y-%m-%d') AS date_departSQL,
      p.prix, p.id_produit, p.etat, p.id_promo
      FROM produit p, salle s
      WHERE s.id_salle = p.id_salle
      AND p.id_produit = $id_produit
    ");

    $recupProduitParID = $produitID->fetch(PDO::FETCH_ASSOC);

    return $recupProduitParID;

  }

  // ********** Mondification d'un Produit par Admin ********** //
  public function updateProduitAdmin($id_salle, $date_arrivee, $date_depart, $prix, $id_promo, $id_produit){

    $insertion = $this->connect_central_bdd()->prepare("UPDATE produit SET id_salle = :id_salle, date_arrivee = :date_arrivee, date_depart = :date_depart, prix = :prix, id_promo = :id_promo WHERE id_produit = $id_produit");

    $insertion->bindValue(':id_salle', $id_salle, PDO::PARAM_INT);
    $insertion->bindValue(':date_arrivee', $date_arrivee, PDO::PARAM_STR);
    $insertion->bindValue(':date_depart', $date_depart, PDO::PARAM_STR);
    $insertion->bindValue(':prix', $prix, PDO::PARAM_INT);
    $insertion->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);

    $resultSQL = $insertion->execute();

    return $resultSQL;

  }

  // ********** Affichage Suggestion sur un Détail Produit ********** //
  public function searchSuggestionProduit($id_produit, $ville, $date_arrivee, $date_depart){

    $recherche = $this->connect_central_bdd()->query("SELECT s.*,
      DATE_FORMAT(p.date_arrivee, '%d/%m/%Y') AS date_arrivee,
      DATE_FORMAT(p.date_depart, '%d/%m/%Y') AS date_depart,
      p.prix, p.id_produit, p.etat, p.id_promo
      FROM produit p, salle s
      WHERE s.id_salle = p.id_salle
      AND p.etat = 0
      AND p.id_produit != $id_produit
      AND (s.ville = '$ville'
      OR p.date_arrivee BETWEEN '$date_arrivee' AND '$date_depart'
      OR p.date_depart BETWEEN '$date_arrivee' AND '$date_depart')
      ");

    return $suggestionsProduits = $recherche->fetchAll(PDO::FETCH_ASSOC);

  }

  // ********** Mise a jour "Etat" du produit après validation du panier ********** //
  public function majEtatProduit($id_produit){

    $insertion = $this->connect_central_bdd()->prepare("UPDATE produit SET etat = 1 WHERE id_produit = $id_produit");

    $insertion->execute();

  }

  // ********** Recherche de produits ********** //
  public function requeteRecherche($date, $keyword, $categorie){

    $req = "SELECT s.*,
      DATE_FORMAT(p.date_arrivee, '%d/%m/%Y') AS date_arrivee,
      DATE_FORMAT(p.date_depart, '%d/%m/%Y') AS date_depart,
      p.prix, p.id_produit
      FROM salle s, produit p
      WHERE s.id_salle = p.id_salle
      AND p.etat = 0
      AND p.date_arrivee >= NOW()
      AND p.date_arrivee >= '$date'";

      if($keyword){
        $req .= " AND (s.ville LIKE '%$keyword%'
        OR s.titre LIKE '%$keyword%'
        OR s.pays LIKE '%$keyword%')";
      }

      if($categorie){
        $req .= " AND categorie = '$categorie'";
      }

    $req .= " ORDER BY p.date_arrivee";


    $donnees = modelesSuper::connect_central_bdd()->prepare($req);
    $donnees->execute();

    $produits['listeProduits'] = $donnees->fetchAll(PDO::FETCH_ASSOC);
    $produits['nbProduits'] = $donnees->rowCount();

    return $produits;

  }

  // ********** Verification date d'une creation ou modification d'un produit ********** //
  public function verifDateBDD($date_arrivee, $date_depart, $id_salle, $id_produit){

    $req = "SELECT id_produit FROM produit WHERE
      (date_arrivee >= '$date_arrivee' OR '$date_arrivee' BETWEEN date_arrivee AND date_depart)
      AND (date_depart <= '$date_depart' OR '$date_depart' BETWEEN date_arrivee AND date_depart)";

    if($id_produit){
      $req .= " AND id_produit != $id_produit";
    }

    $req .= " AND id_salle IN(SELECT id_salle FROM salle WHERE id_salle = $id_salle)";

    $donnees = modelesSuper::connect_central_bdd()->query($req);

    return $verifDateProduit = ($donnees->rowCount() != 0) ? FALSE : TRUE;

  }

  // ********** Pour ne pas supprimer un produit en etat 1 ********** //
  public function produitEtatUn($id_produit_supp){

    $donnees = modelesSuper::connect_central_bdd()->query("SELECT id_produit FROM produit WHERE id_produit = $id_produit_supp AND etat = 1");

    return $nbProduitsVerif = $donnees->rowCount();

  }

}
