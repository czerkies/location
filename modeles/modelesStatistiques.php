<?php

class modelesStatistiques extends modelesSuper {

  // *********** Top 5 des salles les mieux notés ********** //
  public function dataCinqNotes(){

    $donnees = $this->connect_central_bdd()->query("
      SELECT AVG(a.note) as note, s.id_salle, s.titre
      FROM avis a, salle s
      WHERE a.id_salle = s.id_salle
      GROUP BY s.id_salle
      ORDER BY note DESC
      LIMIT 5;
    ");

    $cinqNotes = $donnees->fetchAll(PDO::FETCH_ASSOC);

    return $cinqNotes;

  }

  // *********** Top 5 des salles les plus vendues ********** //
  public function dataCinqVendues(){

    $donnees = $this->connect_central_bdd()->query("
      SELECT COUNT(c.id_commande) as nbcommande, s.id_salle, s.titre
      FROM commande c, details_commande d, produit p, salle s
      WHERE c.id_commande = d.id_commande
      AND d.id_produit = p.id_produit
      AND p.id_salle = s.id_salle
      GROUP BY s.id_salle
      ORDER BY nbcommande DESC
      LIMIT 5
    ");

    $cinqVendues = $donnees->fetchAll(PDO::FETCH_ASSOC);

    return $cinqVendues;

  }

  // *********** Top 5 des membres qui en ont acheté le plus ********** //
  public function dataCinqMembresQuantite(){

    $donnees = $this->connect_central_bdd()->query("
      SELECT COUNT(p.id_produit) as nbproduit, m.prenom, m.nom
      FROM commande c, produit p, membre m, details_commande d
      WHERE p.id_produit = d.id_produit
      AND d.id_commande = c.id_commande
      AND c.id_membre = m.id_membre
      GROUP BY m.id_membre
      ORDER BY nbproduit DESC
      LIMIT 5;
    ");

    $cinqMembresQuantite = $donnees->fetchAll(PDO::FETCH_ASSOC);

    return $cinqMembresQuantite;

  }

}
