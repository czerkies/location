<?php

class modelesDetails_commande extends modelesSuper {

  // ********** Insertion d'une commande en détails ********** //
  public function insertionDetails_commande($id_commande, $id_produit){

    $insertion = $this->connect_central_bdd()->prepare("INSERT INTO details_commande(id_commande, id_produit) VALUES(:id_commande, :id_produit)");

    $insertion->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $insertion->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);

    $insertion->execute();

  }

  // ********** Récupération détails d'une commande en détail (Client) ********** //
  public function detailsCommandeClient($id_commande){

    $commande = $this->connect_central_bdd()->query("SELECT nom, prenom, cp, adresse, ville FROM membre WHERE id_membre =(SELECT id_membre FROM commande WHERE id_commande = $id_commande);
    ");

    $client = $commande->fetch(PDO::FETCH_ASSOC);

    return $client;

  }

  // ********** Récupération détails d'une commande en détail (Infos) ********** //
  public function detailsCommandeInfos($id_commande){

    $commande = $this->connect_central_bdd()->query("SELECT montant, DATE_FORMAT(date, '%d/%m/%Y à %Hh%i') as date_commande FROM commande WHERE id_commande = $id_commande");

    $infos = $commande->fetch(PDO::FETCH_ASSOC);

    return $infos;

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

    $detailsProduits = $produits->fetchAll(PDO::FETCH_ASSOC);

    return $detailsProduits;

  }

  // ********** Affichage details d'une commande Admin ********** //
  public function detailsCommandeGestionAdmin($id_commande){

    $donnees = $this->connect_central_bdd()->query("SELECT p.id_produit, p.prix, DATE_FORMAT(p.date_arrivee, '%d/%m/%Y') as date_arrivee, DATE_FORMAT(p.date_depart, '%d/%m/%Y') as date_depart, s.id_salle, s.titre, s.ville
    FROM commande c, details_commande d, produit p, salle s
    WHERE c.id_commande = d.id_commande
    AND d.id_produit = p.id_produit
    AND p.id_salle = s.id_salle
    AND c.id_commande = $id_commande
    ");

    $detailsCommandeGestion = $donnees->fetchAll(PDO::FETCH_ASSOC);

    return $detailsCommandeGestion;

  }

}
