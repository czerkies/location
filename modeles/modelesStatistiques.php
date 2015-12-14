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

}
