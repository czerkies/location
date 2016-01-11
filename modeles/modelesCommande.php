<?php

class modelesCommande extends modelesSuper {

  // ********** Insertion d'une commande ********** //
  public function insertionCommande($montant, $id_membre){

    $insertion = $this->connect_central_bdd()->prepare("INSERT INTO commande(montant, id_membre, date) VALUES(:montant, :id_membre, NOW())");

    $insertion->bindValue(':montant', $montant, PDO::PARAM_INT);
    $insertion->bindValue(':id_membre', $id_membre, PDO::PARAM_INT);

    $insertion->execute();

  }

  // ********** Numéro de commande en cours *********** //
  public function idCommande($id_membre){

    $idCommande = $this->connect_central_bdd()->query("SELECT id_commande FROM commande WHERE id_membre = $id_membre ORDER BY id_commande DESC LIMIT 1");

    $numeroCommande = $idCommande->fetch(PDO::FETCH_ASSOC);

    return $numeroCommande;

  }

  // ********** Commandes à afficher sur le profil d'un membre ********** //
  public function commandesMembres($id_membre){

    $donnees = $this->connect_central_bdd()->query("SELECT id_commande, DATE_FORMAT(date, '%d/%m/%Y') as date_commande FROM commande WHERE id_membre = $id_membre AND id_membre IS NOT NULL ORDER BY date DESC LIMIT 20");

    $commandes['donnees'] = $donnees->fetchAll(PDO::FETCH_ASSOC);
    $commandes['nbCommandes'] = $donnees->rowCount();

    return $commandes;

  }

  // ********** Affichages de toutes les commandes Admin ********** //
  public function lesCommandesAdmin(){

    $donnees = $this->connect_central_bdd()->query("SELECT * FROM commande ORDER BY id_commande DESC");

    $commandes = $donnees->fetchAll(PDO::FETCH_ASSOC);

    return $commandes;

  }

}
