<?php

class modelesNewsletter extends modelesSuper {

  // *********** Vérification si déjà abonné à la newsletter ********** //
  public function verifNewsletter($id_membre){

    $verifNews = $this->connect_central_bdd()->query("SELECT * FROM newsletter WHERE id_membre = $id_membre");

    return $verif = $verifNews->rowCount();

  }

  // ********** Insertion d'un nouveau membre ********** //
  public function insertMembre($id_membre){

    $insertion = $this->connect_central_bdd()->prepare("INSERT INTO newsletter(id_membre) VALUES(:id_membre)");

    $insertion->bindValue(':id_membre', $id_membre, PDO::PARAM_INT);

    $insertion->execute();

    return TRUE;

  }

  // ********** Suppréssion membre newsletter ********** //
  public function suppNews($id_membre){

    $supprimer = $this->connect_central_bdd()->prepare("DELETE FROM newsletter WHERE id_membre = $id_membre");

    $supprimer->execute();

    return TRUE;

  }

  // ********** Requete pour récupérer adresse mail des membres inscrit ********** //
  public function recupMailMembre(){

    $mailMembre = $this->connect_central_bdd()->query("SELECT m.email FROM membre m, newsletter n WHERE m.id_membre = n.id_membre");

    $donneesNews['mailAbonne'] = $mailMembre->fetchAll(PDO::FETCH_ASSOC);

    $donneesNews['nbMail'] = $mailMembre->rowCount();

    return $donneesNews;

  }

}
