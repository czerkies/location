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

}
